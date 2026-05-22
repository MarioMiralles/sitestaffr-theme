/**
 * SiteStaffr Billing Hub — /manage page logic.
 *
 * State machine:
 *   loading → check URL params / sessionStorage
 *     → has token param?    → verify magic link → authenticated
 *     → has session in storage? → fetch account state → authenticated
 *     → neither?            → unauthenticated
 *
 * Views (toggled via data-view on #hub):
 *   loading | site-picker | unauthenticated | authenticated | error
 */
(function () {
  'use strict';

  var config = window.sitestaffrHub || {};
  var API_URL = config.apiUrl || '';

  var hub = document.getElementById('hub');
  var subtitleEl = document.getElementById('hubSubtitle');

  /* ---- Helpers ---- */

  function setView(view, subtitle) {
    hub.dataset.view = view;
    if (subtitleEl && subtitle !== undefined) {
      subtitleEl.textContent = subtitle;
    }
  }

  function getSession() {
    return sessionStorage.getItem('sitestaffr_session');
  }
  function setSession(token) {
    sessionStorage.setItem('sitestaffr_session', token);
  }
  function getInstallationId() {
    return sessionStorage.getItem('sitestaffr_installation_id');
  }
  function setInstallationId(id) {
    if (id) {
      sessionStorage.setItem('sitestaffr_installation_id', id);
      return;
    }
    sessionStorage.removeItem('sitestaffr_installation_id');
  }
  function getSites() {
    try {
      return JSON.parse(sessionStorage.getItem('sitestaffr_sites') || '[]');
    } catch (error) {
      return [];
    }
  }
  function setSites(sites) {
    sessionStorage.setItem('sitestaffr_sites', JSON.stringify(Array.isArray(sites) ? sites : []));
  }
  function clearSession() {
    sessionStorage.removeItem('sitestaffr_session');
    sessionStorage.removeItem('sitestaffr_email');
    sessionStorage.removeItem('sitestaffr_installation_id');
    sessionStorage.removeItem('sitestaffr_sites');
  }

  function apiCall(path, body, useAuth) {
    var headers = { 'Content-Type': 'application/json' };
    var requestBody = {};
    Object.keys(body || {}).forEach(function (key) {
      requestBody[key] = body[key];
    });

    if (useAuth) {
      var token = getSession();
      if (token) headers['Authorization'] = 'Bearer ' + token;
      var installationId = getInstallationId();
      if (installationId) requestBody.installation_id = installationId;
    }

    return fetch(API_URL + path, {
      method: 'POST',
      headers: headers,
      body: JSON.stringify(requestBody),
    }).then(function (res) {
      if (res.status === 401) {
        var previousEmail = sessionStorage.getItem('sitestaffr_email') || '';
        clearSession();
        showSessionExpired(previousEmail);
        throw new Error('session_expired');
      }
      return res.json().then(function (data) {
        if (!res.ok) throw new Error(data.error || 'request_failed');
        return data;
      });
    });
  }

  function cleanUrl() {
    var url = new URL(window.location.href);
    url.searchParams.delete('token');
    url.searchParams.delete('checkout');
    url.searchParams.delete('verify_email_token');
    window.history.replaceState({}, '', url.toString());
  }

  function displaySiteUrl(siteUrl) {
    return String(siteUrl || '')
      .replace(/^https?:\/\//i, '')
      .replace(/\/$/, '') || 'Untitled site';
  }

  function formatPlanLabel(planName) {
    var normalized = String(planName || 'trial').replace(/[_-]+/g, ' ').trim();
    if (!normalized) return 'Trial';
    return normalized.charAt(0).toUpperCase() + normalized.slice(1);
  }

  /* ---- Session expired ---- */

  function showSessionExpired(email) {
    var banner = document.getElementById('hubBanner');
    var emailValue = email || sessionStorage.getItem('sitestaffr_email') || '';
    banner.className = 'hub__banner hub__banner--expired';
    banner.textContent = 'Your session has expired. Request a new link to continue.';
    banner.hidden = false;

    setView('unauthenticated', 'Use your billing-access email to manage plans, minutes, and team access.');

    if (emailValue) {
      var emailInput = document.getElementById('magicLinkEmail');
      if (emailInput) emailInput.value = emailValue;
    }
  }

  /* ---- Unauthenticated: Send magic link ---- */

  var pendingEmail = '';

  function showPinEntry(email) {
    pendingEmail = email;
    var form = document.getElementById('magicLinkForm');
    var pinEntry = document.getElementById('pinEntry');
    var pinEmailEl = document.getElementById('pinEntryEmail');
    var pinCodeInput = document.getElementById('pinCode');
    var pinMsg = document.getElementById('pinMessage');

    form.hidden = true;
    pinEntry.hidden = false;
    pinEmailEl.textContent = email;
    pinCodeInput.value = '';
    pinMsg.className = 'form-message';
    pinMsg.textContent = '';
    pinCodeInput.focus();
  }

  function resetToEmailForm() {
    var form = document.getElementById('magicLinkForm');
    var pinEntry = document.getElementById('pinEntry');
    var submitBtn = document.getElementById('magicLinkSubmit');
    var messageEl = document.getElementById('magicLinkMessage');

    pinEntry.hidden = true;
    form.hidden = false;
    submitBtn.disabled = false;
    submitBtn.textContent = 'Send me a link';
    messageEl.className = 'form-message';
    messageEl.textContent = '';
    pendingEmail = '';
  }

  function initMagicLinkForm() {
    var form = document.getElementById('magicLinkForm');
    var submitBtn = document.getElementById('magicLinkSubmit');
    var messageEl = document.getElementById('magicLinkMessage');

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      form.querySelectorAll('.form-group--error').forEach(function (g) {
        g.classList.remove('form-group--error');
      });
      messageEl.className = 'form-message';

      var emailInput = form.querySelector('[name="email"]');
      if (!emailInput.value.trim() || !emailInput.checkValidity()) {
        emailInput.closest('.form-group').classList.add('form-group--error');
        return;
      }

      submitBtn.disabled = true;
      submitBtn.textContent = 'Sending\u2026';

      apiCall('/api/billing/send-magic-link', { email: emailInput.value.trim() })
        .then(function () {
          showPinEntry(emailInput.value.trim());
        })
        .catch(function (err) {
          if (err.message === 'session_expired') return;
          messageEl.className = 'form-message form-message--error';
          messageEl.textContent = 'Something went wrong. Please try again.';
          submitBtn.disabled = false;
          submitBtn.textContent = 'Send me a link';
        });
    });
  }

  function initPinEntry() {
    var verifyBtn = document.getElementById('pinVerifyBtn');
    var pinCodeInput = document.getElementById('pinCode');
    var pinMsg = document.getElementById('pinMessage');
    var resendBtn = document.getElementById('pinResend');
    var diffEmailBtn = document.getElementById('pinDifferentEmail');

    function doVerify() {
      var raw = pinCodeInput.value.replace(/\s/g, '');
      if (!/^\d{6}$/.test(raw)) {
        pinMsg.className = 'form-message form-message--error';
        pinMsg.textContent = 'Please enter a 6-digit code.';
        return;
      }

      verifyBtn.disabled = true;
      verifyBtn.textContent = 'Verifying\u2026';
      pinMsg.className = 'form-message';
      pinMsg.textContent = '';

      apiCall('/api/billing/verify-pin', { email: pendingEmail, code: raw })
        .then(function (data) {
          setSession(data.session_token);
          setInstallationId('');
          setSites(data.sites || []);

          var sites = getSites();
          if (sites.length === 0) {
            setView('error', '');
            var errorText = document.getElementById('hubErrorText');
            if (errorText) errorText.textContent = 'No sites found for this email.';
            return;
          }

          if (sites.length === 1) {
            setInstallationId(sites[0].installation_id);
            fetchAccountState();
            return;
          }

          renderSitePicker(sites);
        })
        .catch(function (err) {
          verifyBtn.disabled = false;
          verifyBtn.textContent = 'Verify';
          if (err.message === 'session_expired') return;

          if (err.message === 'rate_limit_exceeded') {
            pinMsg.className = 'form-message form-message--error';
            pinMsg.textContent = 'Too many attempts. Please request a new code.';
            return;
          }

          pinMsg.className = 'form-message form-message--error';
          pinMsg.textContent = 'Incorrect or expired code. Please try again.';
        });
    }

    verifyBtn.addEventListener('click', doVerify);

    pinCodeInput.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        doVerify();
      }
    });

    resendBtn.addEventListener('click', function () {
      if (!pendingEmail) return;
      resendBtn.disabled = true;
      resendBtn.textContent = 'Sending\u2026';
      pinMsg.className = 'form-message';
      pinMsg.textContent = '';

      apiCall('/api/billing/send-magic-link', { email: pendingEmail })
        .then(function () {
          pinMsg.className = 'form-message form-message--info';
          pinMsg.textContent = 'A new code has been sent.';
          pinCodeInput.value = '';
          pinCodeInput.focus();
          resendBtn.disabled = false;
          resendBtn.textContent = 'Didn\u2019t receive it? Resend code';
        })
        .catch(function (err) {
          resendBtn.disabled = false;
          resendBtn.textContent = 'Didn\u2019t receive it? Resend code';
          if (err.message === 'session_expired') return;
          if (err.message === 'rate_limit_exceeded') {
            pinMsg.className = 'form-message form-message--error';
            pinMsg.textContent = 'Too many requests. Please wait a while before trying again.';
            return;
          }
          pinMsg.className = 'form-message form-message--error';
          pinMsg.textContent = 'Could not resend. Please try again.';
        });
    });

    diffEmailBtn.addEventListener('click', function () {
      resetToEmailForm();
    });
  }

  /* ---- Checkout redirect banners ---- */

  function handleCheckoutRedirect() {
    var params = new URLSearchParams(window.location.search);
    var checkout = params.get('checkout');
    if (!checkout) return;

    var banner = document.getElementById('hubBanner');
    if (checkout === 'success') {
      banner.className = 'hub__banner hub__banner--success';
      banner.textContent = 'Payment successful! Your account has been updated.';
      banner.hidden = false;
    } else if (checkout === 'cancelled') {
      banner.className = 'hub__banner hub__banner--cancelled';
      banner.textContent = 'Checkout was cancelled. No charges were made.';
      banner.hidden = false;
    }
    cleanUrl();
  }

  /* ---- Magic link verification ---- */

  function verifyMagicLink(token) {
    setView('loading', 'Verifying your link...');

    apiCall('/api/billing/verify-magic-link', { token: token })
      .then(function (data) {
        setSession(data.session_token);
        setInstallationId('');
        setSites(data.sites || []);
        cleanUrl();

        var sites = getSites();
        if (sites.length === 0) {
          setView('error', '');
          var errorText = document.getElementById('hubErrorText');
          if (errorText) errorText.textContent = 'No sites found for this email.';
          return;
        }

        if (sites.length === 1) {
          setInstallationId(sites[0].installation_id);
          fetchAccountState();
          return;
        }

        renderSitePicker(sites);
      })
      .catch(function (err) {
        if (err.message === 'session_expired') return;
        cleanUrl();
        if (err.message === 'invalid_or_expired_token') {
          setView('unauthenticated', 'Use your billing-access email to manage plans, minutes, and team access.');
          var banner = document.getElementById('hubBanner');
          banner.className = 'hub__banner hub__banner--expired';
          banner.textContent = 'This link has expired or already been used. Request a new one below.';
          banner.hidden = false;
        } else {
          setView('error', '');
        }
      });
  }

  /* ---- Email change verification ---- */

  function verifyEmailChange(token) {
    setView('loading', 'Verifying your new email...');

    apiCall('/api/billing/verify-email-change', { token: token })
      .then(function () {
        cleanUrl();
        var banner = document.getElementById('hubBanner');
        banner.className = 'hub__banner hub__banner--success';
        banner.textContent = 'Your primary billing email has been updated successfully.';
        banner.hidden = false;

        /* Try to load dashboard if session exists */
        var session = getSession();
        if (session) {
          fetchAccountState();
        } else {
          setView('unauthenticated', 'Use your billing-access email to manage plans, minutes, and team access.');
        }
      })
      .catch(function (err) {
        if (err.message === 'session_expired') return;
        cleanUrl();
        setView('unauthenticated', 'Use your billing-access email to manage plans, minutes, and team access.');
        var banner = document.getElementById('hubBanner');
        banner.className = 'hub__banner hub__banner--expired';
        banner.textContent = 'This verification link has expired or already been used.';
        banner.hidden = false;
      });
  }

  /* ---- Fetch account state ---- */

  function fetchAccountState() {
    setView('loading', 'No WordPress login required. Loading your billing access...');

    apiCall('/api/hub/account-state', {}, true)
      .then(function (data) {
        if (data.account) {
          if (data.account.email) {
            sessionStorage.setItem('sitestaffr_email', data.account.email);
          }
          renderDashboard(data.account);
          renderSiteSwitcher(getSites(), getInstallationId());
        } else {
          setView('error', '');
        }
      })
      .catch(function (err) {
        if (err.message === 'session_expired') return;
        setView('error', '');
      });
  }

  /* ---- Site picker / switcher ---- */

  function renderSitePicker(sites) {
    var listEl = document.getElementById('hubSitesList');
    if (!listEl) return;

    var html = '';
    sites.forEach(function (site) {
      html += '<button type="button" class="hub__site-card" data-installation-id="' + escHtml(site.installation_id) + '">';
      html += '<div>';
      html += '<div class="hub__site-card-url">' + escHtml(displaySiteUrl(site.site_url)) + '</div>';
      html += '</div>';
      html += '<div class="hub__site-card-meta">';
      html += '<span class="hub__site-card-plan">' + escHtml(formatPlanLabel(site.plan_name)) + '</span>';
      html += '<span class="hub__site-card-arrow">\u203a</span>';
      html += '</div>';
      html += '</button>';
    });
    listEl.innerHTML = html;
    listEl.onclick = function (e) {
      var card = e.target.closest('[data-installation-id]');
      if (!card) return;
      setInstallationId(card.getAttribute('data-installation-id'));
      fetchAccountState();
    };

    setView('site-picker', 'Select a site to manage');
  }

  function renderSiteSwitcher(sites, currentInstallationId) {
    var switcherEl = document.getElementById('hubSiteSwitcher');
    var btnEl = document.getElementById('hubSiteSwitcherBtn');
    var urlEl = document.getElementById('hubSiteSwitcherUrl');
    var dropdownEl = document.getElementById('hubSiteSwitcherDropdown');

    if (!switcherEl || !btnEl || !urlEl || !dropdownEl) return;

    if (!sites || sites.length === 0) {
      switcherEl.hidden = true;
      dropdownEl.hidden = true;
      dropdownEl.innerHTML = '';
      return;
    }

    if (sites.length === 1) {
      urlEl.textContent = displaySiteUrl(sites[0].site_url);
      switcherEl.hidden = false;
      btnEl.style.cursor = 'default';
      btnEl.querySelector('svg').style.display = 'none';
      dropdownEl.hidden = true;
      dropdownEl.innerHTML = '';
      return;
    }

    var current = null;
    sites.forEach(function (site) {
      if (site.installation_id === currentInstallationId) current = site;
    });
    if (!current) current = sites[0];

    urlEl.textContent = displaySiteUrl(current.site_url);
    switcherEl.hidden = false;

    var html = '';
    sites.forEach(function (site) {
      var activeClass = site.installation_id === current.installation_id ? ' hub__site-switcher-item--active' : '';
      html += '<button type="button" class="hub__site-switcher-item' + activeClass + '" data-switch-to="' + escHtml(site.installation_id) + '">';
      html += escHtml(displaySiteUrl(site.site_url));
      html += '</button>';
    });
    dropdownEl.innerHTML = html;
    dropdownEl.hidden = true;

    btnEl.onclick = function () {
      dropdownEl.hidden = !dropdownEl.hidden;
    };
    dropdownEl.onclick = function (e) {
      var item = e.target.closest('[data-switch-to]');
      if (!item) return;
      dropdownEl.hidden = true;

      var nextInstallationId = item.getAttribute('data-switch-to');
      if (nextInstallationId === current.installation_id) return;

      setInstallationId(nextInstallationId);
      fetchAccountState();
    };
  }

  function initSiteSwitcherDismissal() {
    document.addEventListener('click', function (e) {
      var switcherEl = document.getElementById('hubSiteSwitcher');
      var dropdownEl = document.getElementById('hubSiteSwitcherDropdown');
      if (!switcherEl || !dropdownEl || switcherEl.hidden) return;
      if (!switcherEl.contains(e.target)) {
        dropdownEl.hidden = true;
      }
    });
  }

  /* ---- Render dashboard ---- */

  function renderDashboard(account) {
    var statusCard = document.getElementById('hubStatusCard');
    var actionsEl = document.getElementById('hubActions');
    var plansEl = document.getElementById('hubPlans');
    var status = account.subscription_status || 'trial';
    var isTrial = status === 'trialing' || status === 'trial' || status === 'trial_active';
    var isActive = status === 'active';
    var isPastDue = status === 'past_due';
    var isCancelled = status === 'canceled' || status === 'cancelled';

    /* Determine if trial is expired */
    var trialExpired = false;
    if (isTrial && account.trial_expires_at) {
      trialExpired = new Date(account.trial_expires_at) < new Date();
    }

    /* Badge */
    var badgeClass = 'hub__status-badge ';
    var badgeText = '';
    if (trialExpired) {
      badgeClass += 'hub__status-badge--warning';
      badgeText = 'Trial Expired';
    } else if (isTrial) {
      badgeClass += 'hub__status-badge--trial';
      badgeText = 'Free Trial';
    } else if (isPastDue) {
      badgeClass += 'hub__status-badge--warning';
      badgeText = 'Past Due';
    } else if (isCancelled) {
      badgeClass += 'hub__status-badge--cancelled';
      badgeText = 'Cancelled';
    } else {
      badgeClass += 'hub__status-badge--active';
      badgeText = 'Active';
    }

    /* Build status card HTML */
    var html = '<div class="' + badgeClass + '">' + badgeText + '</div>';

    if (trialExpired) {
      html += '<div class="hub__status-plan">Your trial has ended</div>';
      html += '<div class="hub__status-warning">Your AI assistant is paused. Choose a plan below to reactivate.</div>';
    } else if (isTrial) {
      html += '<div class="hub__status-plan">Free Trial</div>';
      html += '<div class="hub__status-details">';
      html += statusDetail('Minutes remaining', account.included_minutes_display || '\u2014');
      if (account.trial_expires_at) {
        html += statusDetail('Expires', formatDate(account.trial_expires_at));
      }
      html += '</div>';
    } else if (isCancelled) {
      html += '<div class="hub__status-plan">SiteStaffr ' + escHtml(formatPlanLabel(account.plan_name) || 'Plan') + '</div>';
      html += '<div class="hub__status-warning">Your subscription is cancelled. It remains active until ' + formatDate(account.subscription_current_period_end) + '.</div>';
    } else {
      html += '<div class="hub__status-plan">SiteStaffr ' + escHtml(formatPlanLabel(account.plan_name) || 'Plan') + '</div>';
      html += '<div class="hub__status-details">';
      var totalMinutes = combineMins(account.included_minutes_display, account.addon_minutes_display);
      html += statusDetail('Minutes remaining', totalMinutes);
      if (account.subscription_current_period_end) {
        html += statusDetail('Next billing', formatDate(account.subscription_current_period_end));
      }
      html += '</div>';
      if (isPastDue) {
        html += '<div class="hub__status-warning">Your payment is past due. Please update your payment method to avoid service interruption.</div>';
      }
    }

    statusCard.innerHTML = html;

    /* Actions */
    var actionsHtml = '';
    if (isActive || isPastDue) {
      actionsHtml += '<button type="button" class="btn btn--outline" id="hubBuyMinutes">Buy More Minutes</button>';
      actionsHtml += '<button type="button" class="btn btn--primary" id="hubManageSub">Manage Subscription</button>';
    }
    actionsEl.innerHTML = actionsHtml;

    /* Show plan cards for trial or cancelled users */
    plansEl.hidden = !(isTrial || trialExpired || isCancelled);

    /* Authorized emails */
    var currentSites = getSites();
    var currentInstallation = getInstallationId();
    var currentSiteData = null;
    currentSites.forEach(function (site) {
      if (site.installation_id === currentInstallation) currentSiteData = site;
    });
    renderAuthEmails(
      currentSiteData ? currentSiteData.authorized_emails : [],
      account.email
    );

    /* Set view */
    setView('authenticated', 'Welcome back');

    /* Bind action buttons */
    bindActions(account);
  }

  /* ---- Rendering helpers ---- */

  function statusDetail(label, value) {
    return '<div class="hub__status-detail">' +
      '<div class="hub__status-detail-label">' + escHtml(label) + '</div>' +
      '<div class="hub__status-detail-value">' + escHtml(value) + '</div>' +
      '</div>';
  }

  function formatDate(iso) {
    if (!iso) return '\u2014';
    var d = new Date(iso);
    return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
  }

  function combineMins(included, addon) {
    if (!included && !addon) return '\u2014';
    var parts = [];
    if (included) parts.push(included + ' included');
    if (addon) parts.push(addon + ' add-on');
    return parts.join(' + ');
  }

  function escHtml(str) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
  }

  /* ---- Authorized emails card ---- */

  function formatShortDate(iso) {
    if (!iso) return '';
    var d = new Date(iso);
    return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
  }

  function renderAuthEmails(authorizedEmails, accountEmail) {
    var container = document.getElementById('hub-auth-emails');
    if (!container) return;

    var sessionEmail = (sessionStorage.getItem('sitestaffr_email') || '').trim().toLowerCase();
    var emails = Array.isArray(authorizedEmails) ? authorizedEmails : [];
    var maxEmails = 5;

    // Empty state: show simple billing email display with + Add
    if (emails.length === 0 && accountEmail) {
      emails = [{ email: accountEmail, is_invoice_recipient: true, _synthetic: true }];
    }

    var html = '<div class="hub__auth-emails-header">';
    html += '<span class="hub__auth-emails-title">Billing Access</span>';
    html += '<p class="hub__auth-emails-subtitle">Invite teammates who should manage billing or receive invoices.</p>';
    html += '</div>';

    html += '<div class="hub__auth-emails-list">';
    emails.forEach(function (entry, idx) {
      var email = (entry.email || '').trim().toLowerCase();
      var isPrimary = idx === 0;
      var isSelf = email === sessionEmail;

      html += '<div class="hub__auth-email-row" data-email="' + escHtml(email) + '">';
      html += '<div class="hub__auth-email-info">';
      html += '<div class="hub__auth-email-address">' + escHtml(email) + '</div>';
      html += '<div class="hub__auth-email-meta">';

      if (isPrimary) {
        html += '<span class="hub__auth-email-badge">Primary</span>';
      } else if (entry.added_at) {
        html += '<span class="hub__auth-email-badge">Added ' + escHtml(formatShortDate(entry.added_at)) + '</span>';
      }

      if (entry.is_invoice_recipient) {
        html += '<span class="hub__auth-email-invoice">Receives invoices</span>';
      } else if (!entry._synthetic) {
        html += '<button type="button" class="hub__auth-email-action" data-action="set-invoice-recipient" data-email="' + escHtml(email) + '">Set as invoice recipient</button>';
      }

      html += '</div></div>';

      // Actions
      html += '<div class="hub__auth-email-actions">';
      if (isPrimary) {
        html += '<button type="button" class="hub__auth-email-action" data-action="update-email">Change email</button>';
      } else if (!isSelf) {
        html += '<button type="button" class="hub__auth-email-action" data-action="remove-show" data-email="' + escHtml(email) + '">Remove</button>';
      }
      html += '</div>';

      html += '</div>';
    });
    html += '</div>';

    // "+ Add" link below the list
    if (emails.length < maxEmails) {
      html += '<button type="button" class="hub__auth-emails-add-btn" data-action="add-show">+ Add email</button>';
    }

    // Inline add form (hidden by default, shown on + Add click)
    html += '<div class="hub__auth-email-add" id="authEmailAddForm" hidden>';
    html += '<input type="email" id="authEmailAddInput" placeholder="email@example.com" autocomplete="email">';
    html += '<button type="button" class="hub__auth-email-add-submit" data-action="add-submit">Send Invite</button>';
    html += '<button type="button" class="hub__auth-email-add-cancel" data-action="add-cancel">Cancel</button>';
    html += '</div>';

    // Message area
    html += '<div id="authEmailMessage"></div>';

    container.innerHTML = html;
  }

  function initAuthEmailsDelegation() {
    var container = document.getElementById('hub-auth-emails');
    if (!container) return;

    container.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-action]');
      if (!btn || btn.disabled) return;

      var action = btn.dataset.action;

      if (action === 'update-email') {
        var modal = document.getElementById('hubEmailModal');
        if (modal) {
          modal.hidden = false;
          var input = document.getElementById('newEmail');
          if (input) input.focus();
        }
        return;
      }

      if (action === 'add-show') {
        var addForm = document.getElementById('authEmailAddForm');
        if (addForm) {
          addForm.hidden = false;
          var addInput = document.getElementById('authEmailAddInput');
          if (addInput) { addInput.value = ''; addInput.focus(); }
        }
        return;
      }

      if (action === 'add-cancel') {
        var addForm = document.getElementById('authEmailAddForm');
        if (addForm) addForm.hidden = true;
        clearAuthEmailMessage();
        return;
      }

      if (action === 'add-submit') {
        handleAddAuthorizedEmail(btn);
        return;
      }

      if (action === 'remove-show') {
        handleShowRemoveConfirm(btn);
        return;
      }

      if (action === 'remove-confirm') {
        handleRemoveAuthorizedEmail(btn);
        return;
      }

      if (action === 'remove-cancel') {
        // Re-render to restore normal row
        var currentSites = getSites();
        var currentInstallation = getInstallationId();
        var siteData = null;
        currentSites.forEach(function (s) { if (s.installation_id === currentInstallation) siteData = s; });
        renderAuthEmails(siteData ? siteData.authorized_emails : [], sessionStorage.getItem('sitestaffr_email') || '');
        return;
      }

      if (action === 'set-invoice-recipient') {
        handleSetInvoiceRecipient(btn);
        return;
      }
    });

    // Keyboard: Enter submits add form, Escape cancels
    container.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && e.target.id === 'authEmailAddInput') {
        e.preventDefault();
        var submitBtn = container.querySelector('[data-action="add-submit"]');
        if (submitBtn && !submitBtn.disabled) handleAddAuthorizedEmail(submitBtn);
      }
      if (e.key === 'Escape') {
        var addForm = document.getElementById('authEmailAddForm');
        if (addForm && !addForm.hidden) {
          addForm.hidden = true;
          clearAuthEmailMessage();
        }
      }
    });
  }

  function clearAuthEmailMessage() {
    var msgEl = document.getElementById('authEmailMessage');
    if (msgEl) msgEl.innerHTML = '';
  }

  function showAuthEmailError(message) {
    var msgEl = document.getElementById('authEmailMessage');
    if (msgEl) {
      msgEl.innerHTML = '<div class="hub__auth-email-error">' + escHtml(message) + '</div>';
    }
  }

  function showAuthEmailSuccess(message) {
    var msgEl = document.getElementById('authEmailMessage');
    if (msgEl) {
      msgEl.innerHTML = '<div class="hub__auth-email-success">' + escHtml(message) + '</div>';
      setTimeout(function () {
        var successEl = msgEl.querySelector('.hub__auth-email-success');
        if (successEl) successEl.style.opacity = '0';
      }, 3000);
      setTimeout(function () { msgEl.innerHTML = ''; }, 3500);
    }
  }

  function refetchSitesAndRerender() {
    apiCall('/api/hub/list-sites', {}, true)
      .then(function (data) {
        var sites = data.sites || [];
        setSites(sites);
        var installationId = getInstallationId();
        var siteData = null;
        sites.forEach(function (s) { if (s.installation_id === installationId) siteData = s; });
        renderAuthEmails(siteData ? siteData.authorized_emails : [], sessionStorage.getItem('sitestaffr_email') || '');
      })
      .catch(function () { fetchAccountState(); });
  }

  function handleAuthEmailError(err, fallbackMessage) {
    if (err.message === 'session_expired') return;
    var msg = fallbackMessage || 'Something went wrong. Please try again.';
    if (err.message === 'already_authorized') msg = 'This email already has access.';
    else if (err.message === 'max_emails_reached') msg = 'Maximum of 5 emails reached.';
    else if (err.message === 'invalid_email') msg = 'Please enter a valid email address.';
    else if (err.message === 'cannot_remove_self') msg = 'You cannot remove your own access.';
    else if (err.message === 'cannot_remove_primary') msg = 'Cannot remove the primary email.';
    else if (err.message === 'account_not_found') {
      // Account gone — sign out
      clearSession();
      showSessionExpired('');
      return;
    } else if (err.message === 'email_not_found') {
      // Stale list — re-fetch sites and re-render card
      refetchSitesAndRerender();
      return;
    } else if (err.message === 'not_authorized' || err.message === 'site_not_found') {
      // Lost access to this site — re-fetch sites, redirect to site picker
      setInstallationId('');
      apiCall('/api/hub/list-sites', {}, true)
        .then(function (data) {
          var sites = data.sites || [];
          setSites(sites);
          if (sites.length === 0) {
            setView('error', '');
            var errorText = document.getElementById('hubErrorText');
            if (errorText) errorText.textContent = 'You no longer have access to any sites.';
          } else if (sites.length === 1) {
            setInstallationId(sites[0].installation_id);
            fetchAccountState();
          } else {
            renderSitePicker(sites);
          }
        })
        .catch(function () { clearSession(); showSessionExpired(''); });
      return;
    }
    showAuthEmailError(msg);
  }

  function updateSiteAuthorizedEmails(authorizedEmails) {
    var sites = getSites();
    var installationId = getInstallationId();
    sites.forEach(function (site) {
      if (site.installation_id === installationId) {
        site.authorized_emails = authorizedEmails;
      }
    });
    setSites(sites);
  }

  function reRenderAuthEmails(authorizedEmails) {
    updateSiteAuthorizedEmails(authorizedEmails);
    renderAuthEmails(authorizedEmails, sessionStorage.getItem('sitestaffr_email') || '');
  }

  function handleAddAuthorizedEmail(btn) {
    var input = document.getElementById('authEmailAddInput');
    var email = input ? input.value.trim() : '';
    if (!email) return;

    btn.disabled = true;
    btn.textContent = 'Sending\u2026';
    clearAuthEmailMessage();

    apiCall('/api/hub/authorized-emails', { email: email }, true)
      .then(function (data) {
        reRenderAuthEmails(data.authorized_emails);
        showAuthEmailSuccess('Access granted. Login link sent to ' + email + '.');
      })
      .catch(function (err) {
        btn.disabled = false;
        btn.textContent = 'Send Invite';
        handleAuthEmailError(err);
      });
  }

  function handleShowRemoveConfirm(btn) {
    var email = btn.dataset.email;
    var row = btn.closest('.hub__auth-email-row');
    if (!row) return;

    row.outerHTML = '<div class="hub__auth-email-confirm" data-email="' + escHtml(email) + '">'
      + '<span class="hub__auth-email-confirm-text">Remove access for ' + escHtml(email) + '?</span>'
      + '<div class="hub__auth-email-confirm-actions">'
      + '<button type="button" class="hub__auth-email-confirm-btn" data-action="remove-cancel">Cancel</button>'
      + '<button type="button" class="hub__auth-email-confirm-btn hub__auth-email-confirm-btn--danger" data-action="remove-confirm" data-email="' + escHtml(email) + '">Confirm</button>'
      + '</div></div>';
  }

  function handleRemoveAuthorizedEmail(btn) {
    var email = btn.dataset.email;
    if (!email) return;

    btn.disabled = true;
    btn.textContent = 'Removing\u2026';
    clearAuthEmailMessage();

    apiCall('/api/hub/authorized-emails/remove', { email: email }, true)
      .then(function (data) {
        reRenderAuthEmails(data.authorized_emails);
        showAuthEmailSuccess(email + ' has been removed.');
      })
      .catch(function (err) {
        btn.disabled = false;
        btn.textContent = 'Confirm';
        handleAuthEmailError(err);
      });
  }

  function handleSetInvoiceRecipient(btn) {
    var email = btn.dataset.email;
    if (!email) return;

    btn.disabled = true;
    btn.textContent = 'Updating\u2026';
    clearAuthEmailMessage();

    apiCall('/api/hub/authorized-emails/invoice-recipient', { email: email }, true)
      .then(function (data) {
        reRenderAuthEmails(data.authorized_emails);
      })
      .catch(function (err) {
        btn.disabled = false;
        btn.textContent = 'Set as invoice recipient';
        handleAuthEmailError(err);
      });
  }

  /* ---- Plan card delegation (called once from init) ---- */

  function initPlanCardDelegation() {
    var plansEl = document.getElementById('hubPlans');
    if (!plansEl) return;

    plansEl.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-plan]');
      if (!btn || btn.disabled) return;

      var plan = btn.dataset.plan;
      btn.disabled = true;
      btn.textContent = 'Redirecting\u2026';

      apiCall('/api/hub/create-checkout-session', {
        type: 'subscription',
        plan_name: plan,
      }, true)
        .then(function (data) {
          if (data.checkout_url) {
            window.location.href = data.checkout_url;
          }
        })
        .catch(function (err) {
          if (err.message === 'session_expired') return;
          btn.disabled = false;
          btn.textContent = 'Choose ' + plan.charAt(0).toUpperCase() + plan.slice(1);
          alert('Something went wrong. Please try again.');
        });
    });
  }

  /* ---- Buy More Minutes modal ---- */

  var ADDON_MINUTES = 50;
  var ADDON_PRICE = 10;
  var MIN_QTY = 1;
  var MAX_QTY = 10;
  var buyModalQty = 1;

  function updateBuyModal() {
    var qtyEl = document.getElementById('hubBuyQty');
    var minEl = document.getElementById('hubBuyMinutesDisplay');
    var priceEl = document.getElementById('hubBuyPriceDisplay');
    var minusBtn = document.getElementById('hubBuyMinus');
    var plusBtn = document.getElementById('hubBuyPlus');
    if (!qtyEl) return;
    qtyEl.textContent = buyModalQty;
    minEl.textContent = (buyModalQty * ADDON_MINUTES) + ' minutes';
    priceEl.textContent = '$' + (buyModalQty * ADDON_PRICE);
    minusBtn.disabled = buyModalQty <= MIN_QTY;
    plusBtn.disabled = buyModalQty >= MAX_QTY;
  }

  function openBuyModal() {
    var modal = document.getElementById('hubBuyModal');
    if (!modal) return;
    buyModalQty = 1;
    updateBuyModal();
    modal.hidden = false;
    document.body.style.overflow = 'hidden';
  }

  function closeBuyModal() {
    var modal = document.getElementById('hubBuyModal');
    if (!modal) return;
    modal.hidden = true;
    document.body.style.overflow = '';
  }

  function initBuyModal() {
    var modal = document.getElementById('hubBuyModal');
    if (!modal) return;

    document.getElementById('hubBuyMinus').addEventListener('click', function () {
      if (buyModalQty > MIN_QTY) { buyModalQty--; updateBuyModal(); }
    });
    document.getElementById('hubBuyPlus').addEventListener('click', function () {
      if (buyModalQty < MAX_QTY) { buyModalQty++; updateBuyModal(); }
    });
    document.getElementById('hubBuyCancel').addEventListener('click', closeBuyModal);
    document.getElementById('hubBuyClose').addEventListener('click', closeBuyModal);

    modal.addEventListener('click', function (e) {
      if (e.target === modal) closeBuyModal();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && !modal.hidden) closeBuyModal();
    });

    document.getElementById('hubBuyConfirm').addEventListener('click', function () {
      var confirmBtn = document.getElementById('hubBuyConfirm');
      confirmBtn.disabled = true;
      confirmBtn.textContent = 'Redirecting\u2026';

      apiCall('/api/hub/create-checkout-session', {
        type: 'addon',
        addon_type: 'minutes_50',
        quantity: buyModalQty,
      }, true)
        .then(function (data) {
          if (data.checkout_url) {
            window.location.href = data.checkout_url;
          }
        })
        .catch(function (err) {
          if (err.message === 'session_expired') {
            closeBuyModal();
            return;
          }
          confirmBtn.disabled = false;
          confirmBtn.textContent = 'Confirm Purchase';
          alert('Something went wrong. Please try again.');
        });
    });
  }

  /* ---- Action handlers (called per render — binds to dynamic buttons) ---- */

  function bindActions(account) {
    /* Buy more minutes — open modal */
    var buyBtn = document.getElementById('hubBuyMinutes');
    if (buyBtn) {
      buyBtn.addEventListener('click', openBuyModal);
    }

    /* Manage subscription (Stripe portal) */
    var manageBtn = document.getElementById('hubManageSub');
    if (manageBtn) {
      manageBtn.addEventListener('click', function () {
        manageBtn.disabled = true;
        manageBtn.textContent = 'Redirecting\u2026';

        apiCall('/api/hub/create-portal-session', {
          return_url: window.location.origin + '/manage',
        }, true)
          .then(function (data) {
            if (data.portal_url) {
              window.location.href = data.portal_url;
            }
          })
          .catch(function (err) {
            if (err.message === 'session_expired') return;
            manageBtn.disabled = false;
            manageBtn.textContent = 'Manage Subscription';
            alert('Something went wrong. Please try again.');
          });
      });
    }

  }

  /* ---- Email update modal ---- */

  function initEmailUpdateModal() {
    var modal = document.getElementById('hubEmailModal');
    var openBtn = null; // now opened via event delegation on #hub-auth-emails
    var cancelBtn = document.getElementById('emailUpdateCancel');
    var form = document.getElementById('emailUpdateForm');
    var submitBtn = document.getElementById('emailUpdateSubmit');
    var messageEl = document.getElementById('emailUpdateMessage');

    if (!modal) return;

    // Email update modal is now opened via delegation from the auth emails card

    cancelBtn.addEventListener('click', function () {
      modal.hidden = true;
      form.reset();
      messageEl.className = 'form-message';
    });

    /* Close on backdrop click */
    modal.addEventListener('click', function (e) {
      if (e.target === modal) {
        modal.hidden = true;
        form.reset();
        messageEl.className = 'form-message';
      }
    });

    /* Close on Escape */
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && !modal.hidden) {
        modal.hidden = true;
        form.reset();
        messageEl.className = 'form-message';
      }
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      form.querySelectorAll('.form-group--error').forEach(function (g) {
        g.classList.remove('form-group--error');
      });
      messageEl.className = 'form-message';

      var emailInput = form.querySelector('[name="new_email"]');
      if (!emailInput.value.trim() || !emailInput.checkValidity()) {
        emailInput.closest('.form-group').classList.add('form-group--error');
        return;
      }

      submitBtn.disabled = true;
      submitBtn.textContent = 'Sending\u2026';

      apiCall('/api/hub/update-email', { new_email: emailInput.value.trim() }, true)
        .then(function () {
          messageEl.className = 'form-message form-message--info';
          messageEl.textContent = 'Verification email sent! Check your new inbox to confirm the change.';
          submitBtn.disabled = false;
          submitBtn.textContent = 'Send verification';
          form.reset();
        })
        .catch(function (err) {
          if (err.message === 'session_expired') {
            modal.hidden = true;
            return;
          }
          messageEl.className = 'form-message form-message--error';
          messageEl.textContent = 'Could not send verification email. Please try again later.';
          submitBtn.disabled = false;
          submitBtn.textContent = 'Send verification';
        });
    });
  }

  /* ---- Init ---- */

  function init() {
    initMagicLinkForm();
    initPinEntry();
    initPlanCardDelegation();
    initEmailUpdateModal();
    initAuthEmailsDelegation();
    initBuyModal();
    initSiteSwitcherDismissal();
    handleCheckoutRedirect();

    var params = new URLSearchParams(window.location.search);

    /* Email change verification */
    var verifyEmailToken = params.get('verify_email_token');
    if (verifyEmailToken) {
      verifyEmailChange(verifyEmailToken);
      return;
    }

    /* Magic link token */
    var token = params.get('token');
    if (token) {
      verifyMagicLink(token);
      return;
    }

    /* Existing session */
    var session = getSession();
    if (session) {
      var installationId = getInstallationId();
      if (installationId) {
        fetchAccountState();
        return;
      }

      apiCall('/api/hub/list-sites', {}, true)
        .then(function (data) {
          var sites = data.sites || [];
          setSites(sites);

          if (sites.length === 0) {
            setView('error', '');
            var errorText = document.getElementById('hubErrorText');
            if (errorText) errorText.textContent = 'No sites found for this email.';
            return;
          }

          if (sites.length === 1) {
            setInstallationId(sites[0].installation_id);
            fetchAccountState();
            return;
          }

          renderSitePicker(sites);
        })
        .catch(function (err) {
          if (err.message === 'session_expired') return;
          setView('error', '');
        });
      return;
    }

    /* No token, no session */
    setView('unauthenticated', 'Use your billing-access email to manage plans, minutes, and team access.');
  }

  init();
})();
