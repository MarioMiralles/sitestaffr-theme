// ========== SCROLL REVEAL ==========
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ========== AUDIO PLAYER ==========
const playSVG = '<svg viewBox="0 0 24 24" fill="currentColor"><polygon points="6,3 20,12 6,21"/></svg>';
const pauseSVG = '<svg viewBox="0 0 24 24" fill="currentColor"><rect x="5" y="3" width="5" height="18"/><rect x="14" y="3" width="5" height="18"/></svg>';

function formatTime(sec) {
  const safeSeconds = Number.isFinite(sec) ? Math.max(0, sec) : 0;
  const m = Math.floor(safeSeconds / 60);
  const s = Math.floor(safeSeconds % 60);
  return m + ':' + (s < 10 ? '0' : '') + s;
}

function initAudioDemo(demoLayout) {
  const audio = demoLayout.querySelector('[data-audio-demo-audio]');
  const playBtn = demoLayout.querySelector('[data-audio-demo-play-btn]');
  const progressBar = demoLayout.querySelector('[data-audio-demo-progress-bar]');
  const progressFill = demoLayout.querySelector('[data-audio-demo-progress-fill]');
  const currentTimeEl = demoLayout.querySelector('[data-audio-demo-current-time]');
  const totalTimeEl = demoLayout.querySelector('[data-audio-demo-total-time]');
  const transcriptPanel = demoLayout.querySelector('[data-audio-demo-transcript-panel]');
  const transcriptWindow = demoLayout.querySelector('[data-audio-demo-transcript-window]');
  const recapCard = demoLayout.querySelector('[data-audio-demo-recap]');
  const transcriptSourceLines = Array.from(demoLayout.querySelectorAll('.transcript-line-source'));

  if (!audio || !playBtn || !progressBar || !progressFill || !currentTimeEl || !totalTimeEl || !transcriptWindow) {
    return;
  }

  const introSrc = (demoLayout.dataset.audioOpenSrc || '').trim();
  const outroSrc = (demoLayout.dataset.audioCloseSrc || '').trim();
  const introAudio = introSrc ? new Audio(introSrc) : null;
  const outroAudio = outroSrc ? new Audio(outroSrc) : null;

  if (introAudio) {
    introAudio.preload = 'metadata';
  }
  if (outroAudio) {
    outroAudio.preload = 'metadata';
  }

  const transcriptEntries = transcriptSourceLines.map((line, index) => ({
    index,
    speaker: (line.dataset.speaker || 'ai').toLowerCase() === 'caller' ? 'caller' : 'ai',
    start: Number.parseFloat(line.dataset.start || '0'),
    end: Number.parseFloat(line.dataset.end || '999'),
    text: (line.textContent || '').trim()
  }));

  let activeSegment = introAudio ? 'open' : 'main';
  let renderedTranscriptIndex = -1;
  let didReachAudioEnd = false;

  function setPlayState(isPlaying) {
    playBtn.innerHTML = isPlaying ? pauseSVG : playSVG;
    playBtn.classList.toggle('playing', isPlaying);
    playBtn.setAttribute('aria-label', isPlaying ? 'Pause audio demo' : 'Play audio demo');
  }

  function setRecapVisible(visible) {
    // This class drives the recap reveal animation in CSS.
    demoLayout.classList.toggle('demo-layout--show-recap', visible);
    if (recapCard) {
      recapCard.setAttribute('aria-hidden', visible ? 'false' : 'true');
    }
  }

  function setTranscriptExpanded(expanded) {
    // This class drives the transcript collapse/expand height transition in CSS.
    demoLayout.classList.toggle('demo-layout--transcript-collapsed', !expanded);
    if (transcriptPanel) {
      transcriptPanel.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    }
  }

  function getSegmentDuration(player) {
    if (!player || !Number.isFinite(player.duration)) {
      return 0;
    }
    return Math.max(0, player.duration);
  }

  function getOpenDuration() {
    return getSegmentDuration(introAudio);
  }

  function getMainDuration() {
    return getSegmentDuration(audio);
  }

  function getCloseDuration() {
    return getSegmentDuration(outroAudio);
  }

  function getSequenceDuration() {
    return getOpenDuration() + getMainDuration() + getCloseDuration();
  }

  function getCurrentPlayer() {
    if (activeSegment === 'open') {
      return introAudio;
    }
    if (activeSegment === 'close') {
      return outroAudio;
    }
    return audio;
  }

  function pauseAllPlayers() {
    [introAudio, audio, outroAudio].forEach((player) => {
      if (player && !player.paused) {
        player.pause();
      }
    });
  }

  function getSequenceCurrentTime() {
    const openDuration = getOpenDuration();
    const mainDuration = getMainDuration();

    if (activeSegment === 'open' && introAudio) {
      return introAudio.currentTime;
    }

    if (activeSegment === 'close' && outroAudio) {
      return openDuration + mainDuration + outroAudio.currentTime;
    }

    return openDuration + audio.currentTime;
  }

  function refreshTimeline(forceComplete) {
    const totalDuration = getSequenceDuration();
    const currentTime = forceComplete ? totalDuration : getSequenceCurrentTime();

    currentTimeEl.textContent = formatTime(currentTime);

    if (totalDuration > 0) {
      totalTimeEl.textContent = formatTime(totalDuration);
      const percent = Math.min(100, Math.max(0, (currentTime / totalDuration) * 100));
      progressFill.style.width = percent + '%';
    } else {
      progressFill.style.width = '0%';
    }
  }

  function getActiveTranscriptIndex(currentTime) {
    for (let i = 0; i < transcriptEntries.length; i += 1) {
      const entry = transcriptEntries[i];
      if (currentTime >= entry.start && currentTime < entry.end) {
        return entry.index;
      }
    }

    if (transcriptEntries.length > 0 && currentTime >= transcriptEntries[transcriptEntries.length - 1].start) {
      return transcriptEntries[transcriptEntries.length - 1].index;
    }

    return -1;
  }

  function createTranscriptLine(entry, isActive) {
    const row = document.createElement('div');
    row.className = `transcript-line transcript-line--${entry.speaker}${isActive ? ' transcript-line--active' : ''}`;
    row.dataset.index = String(entry.index);

    const speaker = document.createElement('span');
    speaker.className = 'transcript-line__speaker';
    speaker.textContent = entry.speaker === 'caller' ? 'Caller:' : 'AI:';

    const text = document.createElement('span');
    text.className = 'transcript-line__text';
    text.textContent = `"${entry.text}"`;

    row.appendChild(speaker);
    row.appendChild(text);
    return row;
  }

  function rebuildTranscriptWindow(currentTime) {
    transcriptWindow.innerHTML = '';

    if (transcriptEntries.length === 0) {
      renderedTranscriptIndex = -1;
      return;
    }

    const seedFirstPair = transcriptEntries.length > 1 && currentTime < transcriptEntries[1].start;
    if (seedFirstPair) {
      transcriptWindow.appendChild(createTranscriptLine(transcriptEntries[0], true));
      transcriptWindow.appendChild(createTranscriptLine(transcriptEntries[1], false));
      renderedTranscriptIndex = 1;
      return;
    }

    const visibleEntries = transcriptEntries.filter((entry) => currentTime >= entry.start);
    const activeIndex = getActiveTranscriptIndex(currentTime);
    const lastTwo = visibleEntries.slice(-2);

    lastTwo.forEach((entry) => {
      transcriptWindow.appendChild(createTranscriptLine(entry, entry.index === activeIndex));
    });

    renderedTranscriptIndex = visibleEntries.length > 0 ? visibleEntries[visibleEntries.length - 1].index : -1;
  }

  function updateTranscriptWindow(currentTime) {
    if (transcriptEntries.length === 0) {
      return;
    }

    if (renderedTranscriptIndex >= 0 && currentTime + 0.05 < transcriptEntries[renderedTranscriptIndex].start) {
      rebuildTranscriptWindow(currentTime);
      return;
    }

    for (let i = renderedTranscriptIndex + 1; i < transcriptEntries.length; i += 1) {
      const entry = transcriptEntries[i];
      if (currentTime < entry.start) {
        break;
      }

      transcriptWindow.appendChild(createTranscriptLine(entry, false));
      while (transcriptWindow.children.length > 2) {
        transcriptWindow.removeChild(transcriptWindow.firstElementChild);
      }
      renderedTranscriptIndex = i;
    }

    const activeIndex = getActiveTranscriptIndex(currentTime);
    Array.from(transcriptWindow.children).forEach((row) => {
      row.classList.toggle('transcript-line--active', Number.parseInt(row.dataset.index || '-1', 10) === activeIndex);
    });
  }

  function resetTranscriptWindow() {
    renderedTranscriptIndex = -1;
    rebuildTranscriptWindow(0);
  }

  function setActiveSegment(segment) {
    activeSegment = segment;
  }

  function playActiveSegment() {
    const activePlayer = getCurrentPlayer();
    if (!activePlayer) {
      if (activeSegment === 'open') {
        startMainSegment();
      } else if (activeSegment === 'close') {
        finishSequence();
      }
      return;
    }

    activePlayer.play().then(() => {
      didReachAudioEnd = false;
      setPlayState(true);

      if (activeSegment === 'main') {
        setTranscriptExpanded(true);
        setRecapVisible(false);
        updateTranscriptWindow(audio.currentTime);
      } else if (activeSegment === 'open') {
        setTranscriptExpanded(true);
        setRecapVisible(false);
      } else {
        setTranscriptExpanded(false);
        setRecapVisible(true);
      }
    }).catch(() => {
      if (activeSegment === 'open') {
        startMainSegment();
      } else if (activeSegment === 'close') {
        finishSequence();
      } else {
        setPlayState(false);
      }
    });
  }

  function startMainSegment() {
    setActiveSegment('main');
    setTranscriptExpanded(true);
    setRecapVisible(false);
    if (audio.currentTime <= 0.05) {
      resetTranscriptWindow();
    }
    playActiveSegment();
  }

  function startCloseSegment() {
    const closeDuration = getCloseDuration();
    if (!outroAudio || closeDuration <= 0) {
      finishSequence();
      return;
    }

    setActiveSegment('close');
    outroAudio.currentTime = 0;
    setTranscriptExpanded(false);
    setRecapVisible(true);
    playActiveSegment();
  }

  function finishSequence() {
    didReachAudioEnd = true;
    pauseAllPlayers();
    setPlayState(false);
    setActiveSegment(outroAudio ? 'close' : 'main');
    rebuildTranscriptWindow(getMainDuration() || 999);
    setTranscriptExpanded(false);
    setRecapVisible(true);
    refreshTimeline(true);
  }

  function resetSequence() {
    pauseAllPlayers();
    if (introAudio) {
      introAudio.currentTime = 0;
    }
    audio.currentTime = 0;
    if (outroAudio) {
      outroAudio.currentTime = 0;
    }

    setActiveSegment(introAudio ? 'open' : 'main');
    didReachAudioEnd = false;
    setPlayState(false);
    setTranscriptExpanded(true);
    setRecapVisible(false);
    resetTranscriptWindow();
    refreshTimeline(false);
  }

  [audio, introAudio, outroAudio].forEach((player) => {
    if (player) {
      player.addEventListener('loadedmetadata', () => {
        refreshTimeline(false);
      });
    }
  });

  if (introAudio) {
    introAudio.addEventListener('timeupdate', () => {
      if (activeSegment === 'open') {
        refreshTimeline(false);
      }
    });

    introAudio.addEventListener('ended', () => {
      if (activeSegment === 'open') {
        startMainSegment();
      }
    });
  }

  audio.addEventListener('timeupdate', () => {
    if (activeSegment === 'main') {
      updateTranscriptWindow(audio.currentTime);
      refreshTimeline(false);
    }
  });

  audio.addEventListener('ended', () => {
    if (activeSegment !== 'main') {
      return;
    }

    rebuildTranscriptWindow(getMainDuration() || 999);
    startCloseSegment();
  });

  if (outroAudio) {
    outroAudio.addEventListener('timeupdate', () => {
      if (activeSegment === 'close') {
        refreshTimeline(false);
      }
    });

    outroAudio.addEventListener('ended', () => {
      if (activeSegment === 'close') {
        finishSequence();
      }
    });
  }

  playBtn.addEventListener('click', () => {
    const activePlayer = getCurrentPlayer();
    const isPlaying = !!(activePlayer && !activePlayer.paused);

    if (didReachAudioEnd) {
      resetSequence();
    }

    if (isPlaying) {
      activePlayer.pause();
      setPlayState(false);
      if (activeSegment === 'main') {
        setTranscriptExpanded(false);
        setRecapVisible(true);
      }
      refreshTimeline(false);
    } else {
      playActiveSegment();
    }
  });

  progressBar.addEventListener('click', (e) => {
    const totalDuration = getSequenceDuration();
    if (!totalDuration) {
      return;
    }

    const rect = progressBar.getBoundingClientRect();
    if (!rect.width) {
      return;
    }

    const rawPosition = (e.clientX - rect.left) / rect.width;
    const position = Math.min(1, Math.max(0, rawPosition));
    const targetTime = position * totalDuration;
    const activePlayer = getCurrentPlayer();
    const shouldResume = !!(activePlayer && !activePlayer.paused);
    const openDuration = getOpenDuration();
    const mainDuration = getMainDuration();
    const closeDuration = getCloseDuration();

    didReachAudioEnd = false;
    pauseAllPlayers();

    if (introAudio && targetTime < openDuration) {
      introAudio.currentTime = targetTime;
      audio.currentTime = 0;
      if (outroAudio) {
        outroAudio.currentTime = 0;
      }
      setActiveSegment('open');
      setTranscriptExpanded(true);
      setRecapVisible(false);
      resetTranscriptWindow();
    } else if (targetTime < openDuration + mainDuration || !outroAudio || closeDuration <= 0) {
      if (introAudio) {
        introAudio.currentTime = openDuration;
      }
      audio.currentTime = Math.max(0, targetTime - openDuration);
      if (outroAudio) {
        outroAudio.currentTime = 0;
      }
      setActiveSegment('main');
      setTranscriptExpanded(true);
      setRecapVisible(false);
      rebuildTranscriptWindow(audio.currentTime);
    } else {
      if (introAudio) {
        introAudio.currentTime = openDuration;
      }
      audio.currentTime = mainDuration;
      if (outroAudio) {
        const closeTime = Math.max(0, Math.min(closeDuration, targetTime - openDuration - mainDuration));
        outroAudio.currentTime = closeTime;
      }
      setActiveSegment('close');
      setTranscriptExpanded(false);
      setRecapVisible(true);
      rebuildTranscriptWindow(mainDuration || 999);
    }

    refreshTimeline(false);

    if (shouldResume) {
      playActiveSegment();
    } else {
      setPlayState(false);
    }
  });

  resetSequence();
}

document.querySelectorAll('.js-audio-demo').forEach((demoLayout) => {
  initAudioDemo(demoLayout);
});

// ========== FEATURE LIGHTBOX ==========
const featureLightbox = document.getElementById('featureLightbox');
if (featureLightbox) {
  const lightboxImage = featureLightbox.querySelector('.feature-lightbox__image');
  const lightboxCaption = featureLightbox.querySelector('.feature-lightbox__caption');
  const lightboxBackdrop = featureLightbox.querySelector('.feature-lightbox__backdrop');
  const lightboxClose = featureLightbox.querySelector('.feature-lightbox__close');

  const lightboxData = {
    dashboard: {
      caption: 'See which conversations need your attention, what each visitor needed, and who deserves a callback once you have a moment.'
    },
    analytics: {
      caption: 'Track conversation activity and minute usage so you can see how much front-desk work SiteStaffr is handling in the background.'
    },
    protection: {
      caption: 'Visitors can talk or type to get help whether you are on a job, with a customer, or away from the office.'
    },
    'email-recaps': {
      caption: 'SiteStaffr leaves you the recap instead of the interruption, with a quick summary first and the full review link when you need it.'
    },
    'ai-generator': {
      caption: 'Feed SiteStaffr your website content so it learns the details once instead of making you repeat the same business information again and again.'
    }
  };

  function openLightbox(card) {
    if (!card) return;
    const featureId = card.dataset.featureLightbox;
    const data = lightboxData[featureId];
    if (!data) return;
    const previewImage = card.querySelector('.feature-card__screenshot img');
    const imageSource = previewImage ? (previewImage.currentSrc || previewImage.src) : '';
    if (imageSource) {
      lightboxImage.src = imageSource;
    }
    lightboxImage.alt = data.caption;
    lightboxCaption.textContent = data.caption;
    featureLightbox.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    featureLightbox.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  document.querySelectorAll('[data-feature-lightbox]').forEach(card => {
    card.addEventListener('click', () => openLightbox(card));
  });

  lightboxClose.addEventListener('click', closeLightbox);
  lightboxBackdrop.addEventListener('click', closeLightbox);
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && featureLightbox.getAttribute('aria-hidden') === 'false') {
      closeLightbox();
    }
  });
}

// ========== VOICE AGENT SHOWCASE ==========
const voiceShowcase = document.getElementById('voiceShowcase');
if (voiceShowcase) {
  const showcasePortrait = document.getElementById('showcasePortrait');
  const showcaseName = document.getElementById('showcaseName');
  const showcasePlan = document.getElementById('showcasePlan');
  const showcaseRecommended = document.getElementById('showcaseRecommended');
  const showcasePersonality = document.getElementById('showcasePersonality');
  const showcaseDescription = document.getElementById('showcaseDescription');
  const showcaseBestFor = document.getElementById('showcaseBestFor');
  const showcasePlayBtn = document.getElementById('showcasePlayBtn');
  const showcasePlayLabel = document.getElementById('showcasePlayLabel');
  const showcaseAudio = document.getElementById('showcaseAudio');
  const showcaseThumbs = document.getElementById('showcaseThumbs');

  const stylesheetEl = document.querySelector('link[rel="stylesheet"][href*="site.css"]');
  const themeUrl = stylesheetEl ? stylesheetEl.href.replace(/\/assets\/css\/site\.css.*$/, '') : '';

  const voices = [
    { name: 'Marin', file: 'Marin', personality: 'Warm & Welcoming', description: 'Makes your callers feel right at home with a friendly, inviting tone that puts people at ease. Perfect for service businesses that prioritize customer comfort.', bestFor: 'Home Services | Hospitality | Customer Support', plan: 'Starter', recommended: true },
    { name: 'Cedar', file: 'Cedar', personality: 'Smooth & Natural', description: 'Brings a calm, professional presence to every interaction. Ideal for businesses that want to project reliability and trustworthiness.', bestFor: 'Professional Services | Local Agencies | Legal Offices', plan: 'Starter', recommended: true },
    { name: 'Sage', file: 'Sage', personality: 'Wise & Thoughtful', description: 'A measured, trustworthy tone that conveys expertise. Great for financial services and consulting.', bestFor: 'Financial Advisors | Accounting Firms | Coaching Services', plan: 'Business', recommended: false },
    { name: 'Coral', file: 'Coral', personality: 'Bright & Cheerful', description: 'Brings energy and positivity to customer interactions. Perfect for retail, hospitality, and customer-focused businesses.', bestFor: 'Retail | Salons | Restaurants', plan: 'Business', recommended: false },
    { name: 'Ash', file: 'Ash', personality: 'Clear & Confident', description: 'Projects authority and competence. Great for professional services, consulting, and B2B businesses.', bestFor: 'B2B Services | Consulting Shops | Marketing Agencies', plan: 'Business', recommended: false },
    { name: 'Alloy', file: 'Alloy', personality: 'Neutral & Professional', description: 'A balanced, versatile voice suitable for any business type. Clear and easy to understand with broad appeal.', bestFor: 'General SMB | Front Desk Coverage | Mixed Inquiries', plan: 'Pro', recommended: false },
    { name: 'Echo', file: 'Echo', personality: 'Calm & Reassuring', description: 'A gentle, soothing presence that helps callers feel heard and supported. Ideal for healthcare and support services.', bestFor: 'Clinics | Wellness Practices | Care Teams', plan: 'Pro', recommended: false },
    { name: 'Shimmer', file: 'Shimmer', personality: 'Light & Elegant', description: 'Refined and sophisticated presence. Perfect for luxury brands, spas, and premium services.', bestFor: 'Spas | Boutique Brands | Premium Services', plan: 'Pro', recommended: false },
    { name: 'Verse', file: 'Verse', personality: 'Poetic & Refined', description: 'Cultured and articulate with artistic sensibility. Perfect for galleries, museums, and cultural institutions.', bestFor: 'Art Galleries | Cultural Venues | Education Programs', plan: 'Pro', recommended: false },
    { name: 'Ballad', file: 'Ballad', personality: 'Expressive & Melodic', description: 'Brings artistry and emotional depth to conversations. Ideal for creative industries and entertainment.', bestFor: 'Creative Studios | Event Services | Entertainment SMBs', plan: 'Pro', recommended: false }
  ];

  let activeVoiceIndex = 0;

  function selectVoice(index) {
    activeVoiceIndex = index;
    const voice = voices[index];

    showcasePortrait.src = themeUrl + '/assets/images/agents/' + voice.file + '_half-size.png';
    showcasePortrait.alt = voice.name;
    showcaseName.textContent = voice.name;
    showcasePlan.textContent = voice.plan;
    showcasePlan.setAttribute('data-plan', voice.plan);
    showcaseRecommended.hidden = !voice.recommended;
    showcasePersonality.textContent = voice.personality;
    showcaseDescription.textContent = voice.description;
    showcaseBestFor.textContent = voice.bestFor;

    showcaseAudio.pause();
    showcaseAudio.currentTime = 0;
    showcasePlayBtn.classList.remove('playing');
    showcasePlayLabel.textContent = 'Preview Voice';

    showcaseThumbs.querySelectorAll('.voice-showcase__thumb').forEach(function(thumb, i) {
      thumb.classList.toggle('active', i === index);
    });
  }

  // Build thumbnail strip
  voices.forEach(function(voice, i) {
    var thumb = document.createElement('button');
    thumb.type = 'button';
    thumb.className = 'voice-showcase__thumb' + (i === 0 ? ' active' : '');
    thumb.setAttribute('aria-label', voice.name);

    thumb.innerHTML =
      '<div class="voice-showcase__thumb-img">' +
        '<img src="' + themeUrl + '/assets/images/agents/' + voice.file + '_half-size.png" alt="' + voice.name + '" loading="lazy">' +
      '</div>' +
      '<span class="voice-showcase__thumb-name">' + voice.name + '</span>' +
      '<span class="voice-showcase__thumb-plan" data-plan="' + voice.plan + '">' + voice.plan + '</span>';

    thumb.addEventListener('click', function() { selectVoice(i); });
    showcaseThumbs.appendChild(thumb);
  });

  selectVoice(0);

  // Navigation arrows
  voiceShowcase.querySelector('.voice-showcase__arrow--prev').addEventListener('click', function() {
    selectVoice((activeVoiceIndex - 1 + voices.length) % voices.length);
  });
  voiceShowcase.querySelector('.voice-showcase__arrow--next').addEventListener('click', function() {
    selectVoice((activeVoiceIndex + 1) % voices.length);
  });

  // Play button
  showcasePlayBtn.addEventListener('click', function() {
    if (showcaseAudio.paused) {
      var voice = voices[activeVoiceIndex];
      var audioSrc = themeUrl + '/assets/audio/voices/' + voice.file.toLowerCase() + '.mp3';
      if (!showcaseAudio.src || !showcaseAudio.src.endsWith('/' + voice.file.toLowerCase() + '.mp3')) {
        showcaseAudio.src = audioSrc;
      }
      showcaseAudio.play().then(function() {
        showcasePlayBtn.classList.add('playing');
        showcasePlayLabel.textContent = 'Playing...';
      }).catch(function() {
        showcasePlayBtn.classList.add('playing');
        showcasePlayLabel.textContent = 'Audio coming soon';
        setTimeout(function() {
          showcasePlayBtn.classList.remove('playing');
          showcasePlayLabel.textContent = 'Preview Voice';
        }, 2000);
      });
    } else {
      showcaseAudio.pause();
      showcasePlayBtn.classList.remove('playing');
      showcasePlayLabel.textContent = 'Preview Voice';
    }
  });

  showcaseAudio.addEventListener('ended', function() {
    showcasePlayBtn.classList.remove('playing');
    showcasePlayLabel.textContent = 'Preview Voice';
  });
}

function getCustomizerIconSVG(icon, size, themeUrl = '') {
  const safeSize = Math.max(10, Number.parseInt(size, 10) || 18);
  const common = `width="${safeSize}" height="${safeSize}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"`;

  if (icon === 'none') {
    return '';
  }
  if (icon === 'sitestaffr') {
    const baseUrl = String(themeUrl || '').replace(/\/$/, '');
    const iconUrl = `${baseUrl}/assets/images/sitestaffr-icon.svg`;
    const safeIconUrl = iconUrl.replace(/'/g, "\\'");
    return `<span class="customize-icon-mask" style="--customize-icon-size:${safeSize}px; --customize-icon-url:url('${safeIconUrl}');"></span>`;
  }

  const map = {
    phone: `<svg ${common}><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.8 12.8 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.8 12.8 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>`,
    microphone: `<svg ${common}><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" y1="19" x2="12" y2="23"></line><line x1="8" y1="23" x2="16" y2="23"></line></svg>`,
    chat: `<svg ${common}><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>`,
    headset: `<svg ${common}><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path></svg>`
  };

  return map[icon] || map.phone;
}

function initCustomizationPreview() {
  const section = document.getElementById('customize');
  if (!section) {
    return;
  }
  const stylesheetEl = document.querySelector('link[rel="stylesheet"][href*="site.css"]');
  const themeUrl = stylesheetEl ? stylesheetEl.href.replace(/\/assets\/css\/site\.css.*$/, '') : '';

  const rangeLabelPairs = [
    ['lpWidgetSize', 'lpWidgetSizeValue'],
    ['lpWidgetIconSize', 'lpWidgetIconSizeValue'],
    ['lpWidgetRadiusTop', 'lpWidgetRadiusTopValue'],
    ['lpWidgetRadiusRight', 'lpWidgetRadiusRightValue'],
    ['lpWidgetRadiusBottom', 'lpWidgetRadiusBottomValue'],
    ['lpWidgetRadiusLeft', 'lpWidgetRadiusLeftValue'],
    ['lpButtonIconSize', 'lpButtonIconSizeValue'],
    ['lpButtonFontSize', 'lpButtonFontSizeValue'],
    ['lpButtonRadiusTop', 'lpButtonRadiusTopValue'],
    ['lpButtonRadiusRight', 'lpButtonRadiusRightValue'],
    ['lpButtonRadiusBottom', 'lpButtonRadiusBottomValue'],
    ['lpButtonRadiusLeft', 'lpButtonRadiusLeftValue'],
    ['lpButtonBorderWidth', 'lpButtonBorderWidthValue'],
    ['lpButtonShadowBlur', 'lpButtonShadowBlurValue'],
    ['lpButtonShadowOffset', 'lpButtonShadowOffsetValue'],
    ['lpButtonPaddingX', 'lpButtonPaddingXValue'],
    ['lpButtonPaddingY', 'lpButtonPaddingYValue']
  ];

  const widgetAutoDisplay = document.getElementById('lpWidgetAutoDisplay');
  const widgetIcon = document.getElementById('lpWidgetIcon');
  const widgetSize = document.getElementById('lpWidgetSize');
  const widgetIconSize = document.getElementById('lpWidgetIconSize');
  const widgetBg = document.getElementById('lpWidgetBg');
  const widgetHoverBg = document.getElementById('lpWidgetHoverBg');
  const widgetIconColor = document.getElementById('lpWidgetIconColor');
  const widgetRadiusLock = document.getElementById('lpWidgetRadiusLock');
  const widgetRadiusTop = document.getElementById('lpWidgetRadiusTop');
  const widgetRadiusRight = document.getElementById('lpWidgetRadiusRight');
  const widgetRadiusBottom = document.getElementById('lpWidgetRadiusBottom');
  const widgetRadiusLeft = document.getElementById('lpWidgetRadiusLeft');
  const widgetButton = document.getElementById('lpWidgetPreviewButton');
  const widgetOffNotice = document.getElementById('lpWidgetOffNotice');

  const buttonText = document.getElementById('lpButtonText');
  const buttonIcon = document.getElementById('lpButtonIcon');
  const buttonIconPosition = document.getElementById('lpButtonIconPosition');
  const buttonIconSize = document.getElementById('lpButtonIconSize');
  const buttonFontSize = document.getElementById('lpButtonFontSize');
  const buttonFontWeight = document.getElementById('lpButtonFontWeight');
  const buttonTextTransform = document.getElementById('lpButtonTextTransform');
  const buttonTextColor = document.getElementById('lpButtonTextColor');
  const buttonIconColor = document.getElementById('lpButtonIconColor');
  const buttonBg = document.getElementById('lpButtonBg');
  const buttonHoverBg = document.getElementById('lpButtonHoverBg');
  const buttonGradient = document.getElementById('lpButtonGradient');
  const buttonGradientEnd = document.getElementById('lpButtonGradientEnd');
  const buttonRadiusLock = document.getElementById('lpButtonRadiusLock');
  const buttonRadiusTop = document.getElementById('lpButtonRadiusTop');
  const buttonRadiusRight = document.getElementById('lpButtonRadiusRight');
  const buttonRadiusBottom = document.getElementById('lpButtonRadiusBottom');
  const buttonRadiusLeft = document.getElementById('lpButtonRadiusLeft');
  const buttonBorderWidth = document.getElementById('lpButtonBorderWidth');
  const buttonBorderColor = document.getElementById('lpButtonBorderColor');
  const buttonShadow = document.getElementById('lpButtonShadow');
  const buttonShadowBlur = document.getElementById('lpButtonShadowBlur');
  const buttonShadowOffset = document.getElementById('lpButtonShadowOffset');
  const buttonPaddingX = document.getElementById('lpButtonPaddingX');
  const buttonPaddingY = document.getElementById('lpButtonPaddingY');
  const buttonFullWidth = document.getElementById('lpButtonFullWidth');
  const buttonHoverAnimation = document.getElementById('lpButtonHoverAnimation');
  const buttonPreview = document.getElementById('lpButtonPreviewButton');
  const buttonWrap = document.getElementById('lpButtonPreviewWrap');
  const buttonPanel = document.getElementById('customizeButtonPanel');
  const buttonControlsToggle = document.getElementById('customizeButtonControls');

  if (!widgetButton || !widgetOffNotice || !buttonPreview || !buttonWrap) {
    return;
  }

  const widgetRadiusInputs = [widgetRadiusTop, widgetRadiusRight, widgetRadiusBottom, widgetRadiusLeft];
  const buttonRadiusInputs = [buttonRadiusTop, buttonRadiusRight, buttonRadiusBottom, buttonRadiusLeft];

  function updateRangeLabels() {
    rangeLabelPairs.forEach(([inputId, labelId]) => {
      const input = document.getElementById(inputId);
      const label = document.getElementById(labelId);
      if (!input || !label) {
        return;
      }
      label.textContent = `${input.value}px`;
    });
  }

  function parseRangeValue(input, fallback) {
    const parsed = Number.parseInt(input ? input.value : '', 10);
    return Number.isFinite(parsed) ? parsed : fallback;
  }

  function getRadiusString(inputs, fallbacks) {
    return inputs
      .map((input, index) => `${parseRangeValue(input, fallbacks[index])}px`)
      .join(' ');
  }

  function syncLockedRadius(lockControl, radiusInputs, sourceInput) {
    if (!lockControl || !lockControl.checked || !sourceInput) {
      return;
    }
    radiusInputs.forEach((input) => {
      if (!input || input === sourceInput) {
        return;
      }
      input.value = sourceInput.value;
    });
  }

  function updateRadiusInputState(lockControl, radiusInputs) {
    const isLocked = !!(lockControl && lockControl.checked);
    radiusInputs.forEach((input, index) => {
      if (!input) {
        return;
      }
      input.disabled = isLocked && index > 0;
    });
  }

  function updateWidgetPreview() {
    updateRangeLabels();
    updateRadiusInputState(widgetRadiusLock, widgetRadiusInputs);

    const isVisible = !!(widgetAutoDisplay && widgetAutoDisplay.checked);
    widgetOffNotice.hidden = isVisible;
    widgetButton.hidden = !isVisible;
    widgetOffNotice.style.display = isVisible ? 'none' : 'inline-flex';
    widgetButton.style.display = isVisible ? 'flex' : 'none';

    if (!isVisible) {
      return;
    }

    const size = Number.parseInt(widgetSize.value, 10) || 60;
    const iconSize = Number.parseInt(widgetIconSize.value, 10) || 40;
    const baseBg = widgetBg.value || '#10b981';
    const hoverBg = widgetHoverBg.value || baseBg;
    const iconColor = widgetIconColor.value || '#ffffff';
    const widgetRadius = getRadiusString(widgetRadiusInputs, [20, 20, 20, 0]);

    widgetButton.style.width = `${size}px`;
    widgetButton.style.height = `${size}px`;
    widgetButton.style.backgroundColor = baseBg;
    widgetButton.style.color = iconColor;
    widgetButton.style.borderRadius = widgetRadius;
    widgetButton.innerHTML = getCustomizerIconSVG(widgetIcon.value || 'sitestaffr', iconSize, themeUrl);

    widgetButton.onmouseenter = () => {
      widgetButton.style.backgroundColor = hoverBg;
      widgetButton.style.boxShadow = '0 10px 28px rgba(0,0,0,0.24)';
    };
    widgetButton.onmouseleave = () => {
      widgetButton.style.backgroundColor = baseBg;
      widgetButton.style.boxShadow = '0 8px 24px rgba(0,0,0,0.17)';
    };
  }

  function updateButtonPreview() {
    updateRangeLabels();

    const text = (buttonText.value || '').trim() || 'Contact Us';
    const icon = buttonIcon.value || 'sitestaffr';
    const iconPos = buttonIconPosition.value || 'left';
    const iconSizeValue = Number.parseInt(buttonIconSize.value, 10) || 32;
    const fontSizeValue = Number.parseInt(buttonFontSize.value, 10) || 16;
    const fontWeightValue = buttonFontWeight.value || '600';
    const textTransformValue = buttonTextTransform.value || 'none';
    const textColorValue = buttonTextColor.value || '#ffffff';
    const iconColorValue = buttonIconColor.value || textColorValue;
    const bgValue = buttonBg.value || '#1fb6cc';
    const hoverBgValue = buttonHoverBg.value || '#17a2b8';
    const gradientEnabled = !!buttonGradient.checked;
    const gradientEndValue = buttonGradientEnd.value || '#10b981';
    const buttonRadius = getRadiusString(buttonRadiusInputs, [80, 80, 80, 80]);
    const borderWidthValue = Number.parseInt(buttonBorderWidth.value, 10) || 0;
    const borderColorValue = buttonBorderColor.value || '#1fb6cc';
    const shadowEnabled = !!buttonShadow.checked;
    const shadowBlurValue = Number.parseInt(buttonShadowBlur.value, 10) || 10;
    const shadowOffsetValue = Number.parseInt(buttonShadowOffset.value, 10) || 4;
    const padXValue = Number.parseInt(buttonPaddingX.value, 10) || 24;
    const padYValue = Number.parseInt(buttonPaddingY.value, 10) || 12;
    const fullWidthValue = !!buttonFullWidth.checked;
    const hoverAnimationValue = buttonHoverAnimation.value || 'none';

    const bgStyle = gradientEnabled
      ? `linear-gradient(135deg, ${bgValue} 0%, ${gradientEndValue} 100%)`
      : bgValue;

    const borderStyle = borderWidthValue > 0
      ? `${borderWidthValue}px solid ${borderColorValue}`
      : 'none';

    const baseShadow = shadowEnabled
      ? `0 ${shadowOffsetValue}px ${shadowBlurValue}px rgba(0,0,0,0.2)`
      : 'none';

    updateRadiusInputState(buttonRadiusLock, buttonRadiusInputs);

    const iconMarkup = icon === 'none'
      ? ''
      : `<span class="customize-button-icon" style="color: ${iconColorValue};">${getCustomizerIconSVG(icon, iconSizeValue, themeUrl)}</span>`;

    buttonPreview.innerHTML = icon === 'none'
      ? `<span class="customize-button-text">${text}</span>`
      : iconPos === 'left'
        ? `${iconMarkup}<span class="customize-button-text">${text}</span>`
        : `<span class="customize-button-text">${text}</span>${iconMarkup}`;

    buttonPreview.style.color = textColorValue;
    buttonPreview.style.fontSize = `${fontSizeValue}px`;
    buttonPreview.style.fontWeight = fontWeightValue;
    buttonPreview.style.textTransform = textTransformValue;
    buttonPreview.style.background = bgStyle;
    buttonPreview.style.borderRadius = buttonRadius;
    buttonPreview.style.border = borderStyle;
    buttonPreview.style.boxShadow = baseShadow;
    buttonPreview.style.padding = `${padYValue}px ${padXValue}px`;
    buttonPreview.style.width = fullWidthValue ? '100%' : 'auto';
    buttonWrap.style.width = fullWidthValue ? '100%' : 'auto';

    buttonPreview.onmouseenter = () => {
      buttonPreview.style.background = hoverBgValue;
      if (hoverAnimationValue === 'scale') {
        buttonPreview.style.transform = 'scale(1.05)';
      } else if (hoverAnimationValue === 'glow') {
        buttonPreview.style.boxShadow = `0 0 22px ${bgValue}`;
      } else if (hoverAnimationValue === 'pulse') {
        buttonPreview.classList.add('is-pulsing');
      }
    };

    buttonPreview.onmouseleave = () => {
      buttonPreview.style.background = bgStyle;
      buttonPreview.style.transform = '';
      buttonPreview.style.boxShadow = baseShadow;
      buttonPreview.classList.remove('is-pulsing');
    };
  }

  widgetRadiusInputs.forEach((input) => {
    if (!input) {
      return;
    }
    input.addEventListener('input', (event) => {
      syncLockedRadius(widgetRadiusLock, widgetRadiusInputs, event.target);
    });
    input.addEventListener('change', (event) => {
      syncLockedRadius(widgetRadiusLock, widgetRadiusInputs, event.target);
    });
  });

  if (widgetRadiusLock && widgetRadiusInputs[0]) {
    widgetRadiusLock.addEventListener('change', () => {
      syncLockedRadius(widgetRadiusLock, widgetRadiusInputs, widgetRadiusInputs[0]);
    });
  }

  buttonRadiusInputs.forEach((input) => {
    if (!input) {
      return;
    }
    input.addEventListener('input', (event) => {
      syncLockedRadius(buttonRadiusLock, buttonRadiusInputs, event.target);
    });
    input.addEventListener('change', (event) => {
      syncLockedRadius(buttonRadiusLock, buttonRadiusInputs, event.target);
    });
  });

  if (buttonRadiusLock && buttonRadiusInputs[0]) {
    buttonRadiusLock.addEventListener('change', () => {
      syncLockedRadius(buttonRadiusLock, buttonRadiusInputs, buttonRadiusInputs[0]);
    });
  }

  section.querySelectorAll('[data-widget-control]').forEach((control) => {
    control.addEventListener('input', updateWidgetPreview);
    control.addEventListener('change', updateWidgetPreview);
  });

  section.querySelectorAll('[data-button-control]').forEach((control) => {
    control.addEventListener('input', updateButtonPreview);
    control.addEventListener('change', updateButtonPreview);
  });

  if (buttonPanel && buttonControlsToggle) {
    const syncButtonPanelState = () => {
      buttonPanel.classList.toggle('is-expanded', buttonControlsToggle.open);
    };
    buttonControlsToggle.addEventListener('toggle', syncButtonPanelState);
    syncButtonPanelState();
  }

  updateWidgetPreview();
  updateButtonPreview();
}

initCustomizationPreview();

// ========== FAQ ACCORDION ==========
document.querySelectorAll('.faq-item__question').forEach(btn => {
  btn.addEventListener('click', () => {
    const item = btn.parentElement;
    const wasOpen = item.classList.contains('open');

    // Close all
    document.querySelectorAll('.faq-item.open').forEach(openItem => {
      openItem.classList.remove('open');
    });

    // Toggle clicked
    if (!wasOpen) {
      item.classList.add('open');
    }
  });
});
