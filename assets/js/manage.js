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

    setView('unauthenticated', 'Access your billing and subscription settings.');

    if (emailValue) {
      var emailInput = document.getElementById('magicLinkEmail');
      if (emailInput) emailInput.value = emailValue;
    }
  }

  /* ---- Unauthenticated: Send magic link ---- */

  function initMagicLinkForm() {
    var form = document.getElementById('magicLinkForm');
    var submitBtn = document.getElementById('magicLinkSubmit');
    var successEl = document.getElementById('magicLinkSuccess');
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
          form.hidden = true;
          successEl.hidden = false;
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
          setView('unauthenticated', 'Access your billing and subscription settings.');
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
        banner.textContent = 'Your billing email has been updated successfully.';
        banner.hidden = false;

        /* Try to load dashboard if session exists */
        var session = getSession();
        if (session) {
          fetchAccountState();
        } else {
          setView('unauthenticated', 'Access your billing and subscription settings.');
        }
      })
      .catch(function (err) {
        if (err.message === 'session_expired') return;
        cleanUrl();
        setView('unauthenticated', 'Access your billing and subscription settings.');
        var banner = document.getElementById('hubBanner');
        banner.className = 'hub__banner hub__banner--expired';
        banner.textContent = 'This verification link has expired or already been used.';
        banner.hidden = false;
      });
  }

  /* ---- Fetch account state ---- */

  function fetchAccountState() {
    setView('loading', 'Loading your account...');

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

    if (!sites || sites.length <= 1) {
      switcherEl.hidden = true;
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
    var emailValue = document.getElementById('hubEmailValue');

    var status = account.subscription_status || 'trial';
    var isTrial = status === 'trialing' || status === 'trial';
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
      badgeText = account.plan_name || 'Active';
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
      html += '<div class="hub__status-plan">' + escHtml(account.plan_name || 'Cancelled') + '</div>';
      html += '<div class="hub__status-warning">Your subscription is cancelled. It remains active until ' + formatDate(account.subscription_current_period_end) + '.</div>';
    } else {
      html += '<div class="hub__status-plan">' + escHtml(account.plan_name || 'Active Plan') + '</div>';
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

    /* Email */
    emailValue.textContent = account.email || '';

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

  /* ---- Action handlers (called per render — binds to dynamic buttons) ---- */

  function bindActions(account) {
    /* Buy more minutes */
    var buyBtn = document.getElementById('hubBuyMinutes');
    if (buyBtn) {
      buyBtn.addEventListener('click', function () {
        buyBtn.disabled = true;
        buyBtn.textContent = 'Redirecting\u2026';

        apiCall('/api/hub/create-checkout-session', {
          type: 'addon',
          addon_type: 'minutes_50',
        }, true)
          .then(function (data) {
            if (data.checkout_url) {
              window.location.href = data.checkout_url;
            }
          })
          .catch(function (err) {
            if (err.message === 'session_expired') return;
            buyBtn.disabled = false;
            buyBtn.textContent = 'Buy More Minutes';
            alert('Something went wrong. Please try again.');
          });
      });
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
    var openBtn = document.getElementById('hubEmailUpdateBtn');
    var cancelBtn = document.getElementById('emailUpdateCancel');
    var form = document.getElementById('emailUpdateForm');
    var submitBtn = document.getElementById('emailUpdateSubmit');
    var messageEl = document.getElementById('emailUpdateMessage');

    if (!openBtn || !modal) return;

    openBtn.addEventListener('click', function () {
      modal.hidden = false;
      document.getElementById('newEmail').focus();
    });

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
    initPlanCardDelegation();
    initEmailUpdateModal();
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
    setView('unauthenticated', 'Access your billing and subscription settings.');
  }

  init();
})();
