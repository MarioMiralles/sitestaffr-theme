// ========== HERO SOUNDWAVE CANVAS ==========
(function() {
  const canvas = document.getElementById('hero-soundwave');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let W, H, dpr;
  let mouse = { x: -1000, y: -1000, active: false };
  let raf;
  let isVisible = true;

  const COLORS = {
    tealLight:  [31, 182, 204],
    tealMid:    [0, 131, 143],
    tealDeep:   [0, 77, 64],
    mint:       [144, 224, 190],
    paleAqua:   [180, 230, 220],
  };

  const BAR_COUNT = 120;
  const BAR_GAP = 2.5;
  let bars = [];

  let resizeRaf;
  function resize() {
    if (resizeRaf) cancelAnimationFrame(resizeRaf);
    resizeRaf = requestAnimationFrame(function() {
      const rect = canvas.parentElement.getBoundingClientRect();
      dpr = Math.min(window.devicePixelRatio || 1, 2);
      W = rect.width;
      H = rect.height;
      canvas.width = W * dpr;
      canvas.height = H * dpr;
      canvas.style.width = W + 'px';
      canvas.style.height = H + 'px';
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      initBars();
    });
  }

  function initBars() {
    bars = [];
    const totalWidth = W;
    const barWidth = (totalWidth / BAR_COUNT) - BAR_GAP;

    for (let i = 0; i < BAR_COUNT; i++) {
      const t = i / BAR_COUNT;
      const waveBase = Math.sin(t * Math.PI * 2.2) * 0.3
                     + Math.sin(t * Math.PI * 4.5 + 1.2) * 0.2
                     + Math.sin(t * Math.PI * 7.0 + 0.7) * 0.12
                     + Math.sin(t * Math.PI * 1.1) * 0.25;
      const envelope = Math.pow(t, 0.7);
      const heightFactor = Math.max(0.05, (0.5 + waveBase * 0.5) * envelope);

      bars.push({
        x: i * (barWidth + BAR_GAP),
        width: barWidth,
        baseHeight: heightFactor,
        currentHeight: heightFactor,
        targetHeight: heightFactor,
        phase: t * Math.PI * 6 + Math.random() * 0.8,
        speed: 0.3 + Math.random() * 0.5,
        colorSeed: Math.random(),
      });
    }
  }

  function drawMistLayer(time) {
    const gradient = ctx.createRadialGradient(
      W * 0.65, H * 0.45, 0,
      W * 0.65, H * 0.45, W * 0.55
    );
    gradient.addColorStop(0, 'rgba(31, 182, 204, 0.06)');
    gradient.addColorStop(0.4, 'rgba(0, 131, 143, 0.04)');
    gradient.addColorStop(1, 'rgba(31, 182, 204, 0)');
    ctx.fillStyle = gradient;
    ctx.fillRect(0, 0, W, H);

    for (let i = 0; i < 4; i++) {
      const cx = W * (0.35 + i * 0.18) + Math.sin(time * 0.0003 + i * 1.5) * W * 0.06;
      const cy = H * (0.35 + Math.sin(time * 0.0002 + i * 2.1) * 0.15);
      const r = W * (0.12 + i * 0.04);
      const [cr, cg, cb] = i % 2 === 0 ? COLORS.tealLight : COLORS.mint;
      const g = ctx.createRadialGradient(cx, cy, 0, cx, cy, r);
      g.addColorStop(0, 'rgba(' + cr + ',' + cg + ',' + cb + ',0.07)');
      g.addColorStop(1, 'rgba(' + cr + ',' + cg + ',' + cb + ',0)');
      ctx.fillStyle = g;
      ctx.fillRect(0, 0, W, H);
    }
  }

  function getBarColor(bar, heightRatio) {
    const [r1, g1, b1] = COLORS.tealLight;
    const [r2, g2, b2] = COLORS.tealMid;
    const [r3, g3, b3] = COLORS.tealDeep;

    let r, g, b;
    if (heightRatio < 0.5) {
      const t = heightRatio / 0.5;
      r = r1 + (r2 - r1) * t;
      g = g1 + (g2 - g1) * t;
      b = b1 + (b2 - b1) * t;
    } else {
      const t = (heightRatio - 0.5) / 0.5;
      r = r2 + (r3 - r2) * t;
      g = g2 + (g3 - g2) * t;
      b = b2 + (b3 - b2) * t;
    }

    var positionFade = Math.pow(bar.x / (W || 1), 0.5);
    const alpha = (0.15 + heightRatio * 0.55) * (0.25 + positionFade * 0.75);
    return 'rgba(' + Math.round(r) + ',' + Math.round(g) + ',' + Math.round(b) + ',' + alpha.toFixed(3) + ')';
  }

  function animate(time) {
    raf = requestAnimationFrame(animate);

    if (!isVisible) return;

    ctx.clearRect(0, 0, W, H);

    drawMistLayer(time);

    const mouseRadius = W * 0.18;

    for (let i = 0; i < bars.length; i++) {
      const bar = bars[i];

      const ambient = Math.sin(time * 0.001 * bar.speed + bar.phase) * 0.08
                    + Math.sin(time * 0.0006 * bar.speed + bar.phase * 1.7) * 0.05;

      bar.targetHeight = bar.baseHeight + ambient;

      if (mouse.active) {
        const barCenterX = bar.x + bar.width / 2;
        const barCenterY = H * 0.5;
        const dx = barCenterX - mouse.x;
        const dy = barCenterY - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < mouseRadius) {
          const influence = 1 - (dist / mouseRadius);
          const boost = Math.pow(influence, 1.5) * 0.45;
          bar.targetHeight += boost;
        }
      }

      bar.currentHeight += (bar.targetHeight - bar.currentHeight) * 0.08;

      const maxBarH = H * 0.75;
      const barH = Math.max(4, bar.currentHeight * maxBarH);
      const barY = (H - barH) / 2;

      const heightRatio = bar.currentHeight / 0.9;

      const topRadius = Math.min(bar.width / 2, 3);

      ctx.beginPath();
      ctx.moveTo(bar.x, barY + barH);
      ctx.lineTo(bar.x, barY + topRadius);
      ctx.quadraticCurveTo(bar.x, barY, bar.x + topRadius, barY);
      ctx.lineTo(bar.x + bar.width - topRadius, barY);
      ctx.quadraticCurveTo(bar.x + bar.width, barY, bar.x + bar.width, barY + topRadius);
      ctx.lineTo(bar.x + bar.width, barY + barH);
      ctx.closePath();

      const grad = ctx.createLinearGradient(bar.x, barY, bar.x, barY + barH);
      grad.addColorStop(0, getBarColor(bar, Math.min(1, heightRatio * 1.2)));
      grad.addColorStop(0.5, getBarColor(bar, heightRatio));
      grad.addColorStop(1, getBarColor(bar, Math.max(0, heightRatio * 0.3)));
      ctx.fillStyle = grad;
      ctx.fill();
    }
  }

  function onMouseMove(e) {
    const rect = canvas.getBoundingClientRect();
    mouse.x = e.clientX - rect.left;
    mouse.y = e.clientY - rect.top;
    mouse.active = true;
  }

  function onMouseLeave() {
    mouse.active = false;
    mouse.x = -1000;
    mouse.y = -1000;
  }

  function onTouchMove(e) {
    const touch = e.touches[0];
    const rect = canvas.getBoundingClientRect();
    mouse.x = touch.clientX - rect.left;
    mouse.y = touch.clientY - rect.top;
    mouse.active = true;
  }

  function onTouchEnd() {
    mouse.active = false;
  }

  const hero = canvas.parentElement;
  hero.addEventListener('mousemove', onMouseMove, { passive: true });
  hero.addEventListener('mouseleave', onMouseLeave);
  hero.addEventListener('touchmove', onTouchMove, { passive: true });
  hero.addEventListener('touchend', onTouchEnd);

  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  if (prefersReduced.matches) {
    resize();
    animate(0);
    cancelAnimationFrame(raf);
    return;
  }

  new IntersectionObserver(function(entries) {
    isVisible = entries[0].isIntersecting;
  }, { threshold: 0 }).observe(canvas);

  window.addEventListener('resize', resize);
  resize();
  raf = requestAnimationFrame(animate);
})();

// The scroll-reveal IntersectionObserver was deleted. Content
// visibility must never depend on decorative JS running successfully.

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

  // Playback phase for listeners outside the component (e.g. homepage step cards):
  // 0 = idle, 1 = answering, 2 = capturing details, 3 = recap delivered.
  const recapPinned = Boolean(demoLayout.dataset.audioDemoRecapPinned);
  const capturePhaseStart = Number.parseFloat(demoLayout.dataset.audioCaptureStart || '12');
  let lastEmittedPhase = -1;

  function emitPhase(phase) {
    if (phase === lastEmittedPhase) {
      return;
    }
    lastEmittedPhase = phase;
    demoLayout.dispatchEvent(new CustomEvent('audiodemophase', { bubbles: true, detail: { phase } }));
  }

  function setPlayState(isPlaying) {
    playBtn.innerHTML = isPlaying ? pauseSVG : playSVG;
    playBtn.classList.toggle('playing', isPlaying);
    playBtn.setAttribute('aria-label', isPlaying ? 'Pause audio demo' : 'Play audio demo');
  }

  function setRecapVisible(visible) {
    // This class drives the recap reveal animation in CSS.
    demoLayout.classList.toggle('demo-layout--show-recap', visible);
    if (recapCard && !recapPinned) {
      // Pinned recaps stay visible at desktop widths, so the CSS (visibility on
      // the collapsed state) handles assistive-tech exposure instead of aria-hidden.
      recapCard.setAttribute('aria-hidden', visible ? 'false' : 'true');
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
        setRecapVisible(false);
        updateTranscriptWindow(audio.currentTime);
        emitPhase(audio.currentTime >= capturePhaseStart ? 2 : 1);
      } else if (activeSegment === 'open') {
        setRecapVisible(false);
        emitPhase(1);
      } else {
        setRecapVisible(true);
        emitPhase(3);
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
    setRecapVisible(true);
    emitPhase(3);
    playActiveSegment();
  }

  function finishSequence() {
    didReachAudioEnd = true;
    pauseAllPlayers();
    setPlayState(false);
    setActiveSegment(outroAudio ? 'close' : 'main');
    rebuildTranscriptWindow(getMainDuration() || 999);
    setRecapVisible(true);
    emitPhase(3);
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
    setRecapVisible(false);
    emitPhase(0);
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
      if (!audio.paused) {
        emitPhase(audio.currentTime >= capturePhaseStart ? 2 : 1);
      }
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

// ========== LEAD DEMO: STEP CARDS SYNCED TO PLAYBACK ==========
document.querySelectorAll('.lead-demo').forEach((section) => {
  const stepCards = section.querySelectorAll('.lead-demo__step-card');
  if (!stepCards.length) {
    return;
  }
  section.addEventListener('audiodemophase', (event) => {
    const phase = event.detail && Number.isFinite(event.detail.phase) ? event.detail.phase : 0;
    stepCards.forEach((card, index) => {
      card.classList.toggle('lead-demo__step-card--active', index === phase - 1);
    });
  });
});

// ========== VOICE & TEXT MODE SWITCHER ==========
document.querySelectorAll('.voice-text-section__card').forEach(function(card) {
  card.addEventListener('click', function() {
    var mode = this.getAttribute('data-vt-mode');
    var panel = this.closest('.voice-text-section__panel');
    // Toggle active card
    panel.querySelectorAll('.voice-text-section__card').forEach(function(c) {
      c.classList.remove('voice-text-section__card--active');
    });
    this.classList.add('voice-text-section__card--active');
    // Toggle active preview
    panel.querySelectorAll('.voice-text-section__mode').forEach(function(m) {
      m.classList.remove('voice-text-section__mode--active');
    });
    panel.querySelector('.voice-text-section__mode--' + mode).classList.add('voice-text-section__mode--active');
    // Re-trigger entry animations by cloning animated elements
    var activeMode = panel.querySelector('.voice-text-section__mode--active');
    activeMode.querySelectorAll('.voice-text-section__msg, .voice-text-section__chat-row').forEach(function(el) {
      var clone = el.cloneNode(true);
      el.parentNode.replaceChild(clone, el);
    });
    // Toggle flanking robot images
    var section = this.closest('.voice-text-section');
    if (section) {
      section.querySelectorAll('.voice-text-section__robot').forEach(function(r) {
        r.classList.remove('voice-text-section__robot--active');
      });
      var activeRobot = section.querySelector('.voice-text-section__robot--' + mode);
      if (activeRobot) activeRobot.classList.add('voice-text-section__robot--active');
    }
  });
});

// ========== VOICE & TEXT ROBOT SIZING ==========
(function() {
  var section = document.querySelector('.voice-text-section');
  if (!section) return;
  var panel = section.querySelector('.voice-text-section__panel');
  if (!panel) return;
  function sizeRobots() {
    var panelRect = panel.getBoundingClientRect();
    var gap = panelRect.left;
    if (gap < 120) {
      section.style.setProperty('--vt-robot-width', '0px');
    } else {
      section.style.setProperty('--vt-robot-width', (gap - 20) + 'px');
    }
  }
  sizeRobots();
  window.addEventListener('resize', sizeRobots);
})();

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

  const themeUrl = (typeof sitestaffrTheme !== 'undefined' && sitestaffrTheme.url) ? sitestaffrTheme.url.replace(/\/$/, '') : '';

  // Background portrait crossfade elements
  var bgCurrent = document.getElementById('voiceBgCurrent');
  var bgNext = document.getElementById('voiceBgNext');
  var imgVersion = '?v=20260401';

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

  function portraitUrl(voice) {
    return themeUrl + '/assets/images/agents/portraits/' + voice.file.toLowerCase() + '.webp' + imgVersion;
  }

  // Warm the full-size portraits once the page is idle. The thumbnail strip uses
  // -sm.webp, so the large file for a voice had never been fetched when you clicked
  // it — the browser went to the network mid-swap and the portrait visibly blanked
  // and reloaded. All ten together are ~700KB, so this is cheap after first paint.
  function preloadPortraits() {
    voices.forEach(function (v) { new Image().src = portraitUrl(v); });
  }
  if ('requestIdleCallback' in window) {
    requestIdleCallback(preloadPortraits, { timeout: 3000 });
  } else {
    setTimeout(preloadPortraits, 1500);
  }

  // Guards against a slow earlier request landing after a faster later one and
  // painting the wrong face.
  let portraitSwapToken = 0;

  function selectVoice(index) {
    activeVoiceIndex = index;
    const voice = voices[index];
    const src = portraitUrl(voice);
    const token = ++portraitSwapToken;

    // Swap only once the new file has decoded, so the visible portrait never blanks
    // mid-change. Everything else on the card updates immediately.
    const pre = new Image();
    pre.src = src;
    const applyPortrait = function () {
      if (token !== portraitSwapToken) return;
      showcasePortrait.src = src;
      showcasePortrait.alt = voice.name;
      if (bgCurrent && bgNext) {
        bgNext.src = src;
        bgNext.classList.add('voice-section__bg-img--active');
        bgCurrent.classList.remove('voice-section__bg-img--active');
        const temp = bgCurrent;
        bgCurrent = bgNext;
        bgNext = temp;
      }
    };
    if (pre.decode) {
      pre.decode().then(applyPortrait).catch(applyPortrait);
    } else if (pre.complete) {
      applyPortrait();
    } else {
      pre.onload = applyPortrait;
      pre.onerror = applyPortrait;
    }
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

    // Selection feedback is immediate — it must not wait on the image.
    showcaseThumbs.querySelectorAll('.voice-showcase__thumb').forEach(function(thumb, i) {
      thumb.classList.toggle('active', i === index);
    });
  }

  // Build thumbnail strip (clear SSR placeholders first)
  showcaseThumbs.innerHTML = '';
  voices.forEach(function(voice, i) {
    var thumb = document.createElement('button');
    thumb.type = 'button';
    thumb.className = 'voice-showcase__thumb' + (i === 0 ? ' active' : '');
    thumb.setAttribute('aria-label', voice.name);

    thumb.innerHTML =
      '<div class="voice-showcase__thumb-img">' +
        '<img src="' + themeUrl + '/assets/images/agents/portraits/' + voice.file.toLowerCase() + '-sm.webp' + imgVersion + '" alt="' + voice.name + '" loading="lazy">' +
      '</div>' +
      '<span class="voice-showcase__thumb-name">' + voice.name + '</span>' +
      '<span class="voice-showcase__thumb-plan" data-plan="' + voice.plan + '">' + voice.plan + '</span>';

    thumb.addEventListener('click', function() { selectVoice(i); });
    showcaseThumbs.appendChild(thumb);
  });

  selectVoice(0);

  // Navigation arrows (inside showcase card — used on mobile)
  voiceShowcase.querySelector('.voice-showcase__arrow--prev').addEventListener('click', function() {
    selectVoice((activeVoiceIndex - 1 + voices.length) % voices.length);
  });
  voiceShowcase.querySelector('.voice-showcase__arrow--next').addEventListener('click', function() {
    selectVoice((activeVoiceIndex + 1) % voices.length);
  });

  // Card-edge arrows (positioned at card boundaries on desktop)
  var cardPrev = voiceShowcase.querySelector('.voice-showcase__card-arrow--prev');
  var cardNext = voiceShowcase.querySelector('.voice-showcase__card-arrow--next');
  if (cardPrev) {
    cardPrev.addEventListener('click', function() {
      selectVoice((activeVoiceIndex - 1 + voices.length) % voices.length);
    });
  }
  if (cardNext) {
    cardNext.addEventListener('click', function() {
      selectVoice((activeVoiceIndex + 1) % voices.length);
    });
  }

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

/* FAQ ACCORDION ========== ONE OPEN AT A TIME, AND ALL OF THEM CAN BE CLOSED. → docs/implementation-notes.md#faq-accordion-one-open-at-a-time-and-all-of-th */
document.querySelectorAll('.faq-item__question').forEach(btn => {
  btn.addEventListener('click', () => {
    const item = btn.closest('.faq-item');
    if (!item) return;
    const wasOpen = item.classList.contains('faq-item--open');

    document.querySelectorAll('.faq-item--open').forEach(openItem => {
      openItem.classList.remove('faq-item--open');
      openItem.querySelector('.faq-item__question').setAttribute('aria-expanded', 'false');
    });

    if (!wasOpen) {
      item.classList.add('faq-item--open');
      btn.setAttribute('aria-expanded', 'true');
    }
  });
});

// ========== LANGUAGE SECTION EXPAND ==========
const langExpandBtn = document.querySelector('.lang-section__expand-btn');
if (langExpandBtn) {
  const langDetail = document.querySelector('.lang-section__detail');
  langExpandBtn.addEventListener('click', () => {
    const isExpanded = langExpandBtn.getAttribute('aria-expanded') === 'true';
    langExpandBtn.setAttribute('aria-expanded', String(!isExpanded));
    langDetail.setAttribute('aria-hidden', String(isExpanded));
  });
}



/* SECTION 3 — "See it answer": the live-fill demo. → docs/implementation-notes.md#section-3-see-it-answer-the-live-fill-demo */
(function () {
  var DEMO = window.SITESTAFFR_DEMO;
  var root = document.querySelector('.see-it');
  if (!DEMO || !root) return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion) return;   // leave the fully-rendered PHP output exactly as it is

  var thread    = root.querySelector('[data-see-it-thread]');
  var fields    = root.querySelector('[data-see-it-fields]');
  var summary   = root.querySelector('[data-see-it-summary]');
  var followUp  = root.querySelector('[data-see-it-followup]');
  var toast     = root.querySelector('[data-see-it-toast]');
  var caption   = root.querySelector('[data-see-it-caption]');
  var transport = root.querySelector('[data-see-it-transport]');
  var playBtn   = root.querySelector('[data-see-it-play]');
  var fillBar   = root.querySelector('[data-see-it-fill]');
  var timeEl    = root.querySelector('[data-see-it-time]');
  var business  = root.querySelector('[data-see-it-business]');
  var stage     = root.querySelector('[data-see-it-stage]');
  var stagePlay = root.querySelector('[data-see-it-stage-play]');
  var tabs      = Array.prototype.slice.call(root.querySelectorAll('.see-it__tab'));

  if (!thread || !fields || !transport || !playBtn) return;

  var mode  = DEMO.DEFAULT_MODE || 'text';
  var timer = null;
  var t0    = 0;
  var playing = false;

  function data() { return DEMO[mode]; }

  function fmt(sec) {
    var m = Math.floor(sec / 60), s = Math.floor(sec % 60);
    return m + ':' + (s < 10 ? '0' : '') + s;
  }

  /* Empty the panels. Only ever called once we know we can drive them. */
  function clear() {
    thread.innerHTML = '';
    fields.innerHTML = '';
    [summary, followUp, toast].forEach(function (el) {
      if (el) el.classList.remove('is-in', 'is-shimmer');
    });
    if (caption) caption.hidden = false;
  }

  function addLine(turn, index) {
    if (!turn.text) return null;
    var p = document.createElement('p');
    p.className = 'see-it__line see-it__line--' + (turn.who === 'ai' ? 'ai' : 'visitor');
    var who = document.createElement('span');
    who.className = 'see-it__who';
    who.textContent = turn.who === 'ai' ? 'SiteStaffr' : 'Visitor';
    p.appendChild(who);
    p.appendChild(document.createTextNode(turn.text));
    p.dataset.turn = String(index);
    thread.appendChild(p);
    thread.scrollTop = thread.scrollHeight;
    return p;
  }

  /* Label and value arrive TOGETHER, as a pair. There is no pre-drawn skeleton,
     because the product has no fixed recap schema to draw. */
  function addField(fill, sourceLine) {
    var wrap = document.createElement('div');
    wrap.className = 'see-it__field is-in';
    var dt = document.createElement('dt');
    dt.textContent = fill.label;
    var dd = document.createElement('dd');
    dd.textContent = fill.value;
    wrap.appendChild(dt);
    wrap.appendChild(dd);
    fields.appendChild(wrap);

    /* THE FLASH IS WHAT MAKES THIS AN ARGUMENT RATHER THAN AN ANIMATION. Without
       linking the filled field back to the line that produced it, the right panel
       just looks like it is moving for decoration. */
    if (sourceLine) {
      sourceLine.classList.add('is-flash');
      setTimeout(function () { sourceLine.classList.remove('is-flash'); }, 900);
    }
  }

  function reveal(el, shimmerMs) {
    if (!el) return;
    el.classList.add('is-shimmer');
    setTimeout(function () {
      el.classList.remove('is-shimmer');
      el.classList.add('is-in');
    }, shimmerMs || 900);
  }

  function stop() {
    playing = false;
    clearInterval(timer);
    timer = null;
    root.classList.remove('is-playing');
    playBtn.setAttribute('aria-label', 'Play the conversation');
  }

  function tick() {
    var d = data();
    var now = (Date.now() - t0) / 1000;

    d.turns.forEach(function (turn, i) {
      if (turn._done || now < turn.t) return;
      turn._done = true;
      var line = addLine(turn, i);
      if (turn.fill) addField(turn.fill, line);
    });

    if (d.summary  && !d.summary._done  && now >= d.summary.t)  { d.summary._done  = true; reveal(summary); }
    if (d.followUp && !d.followUp._done && now >= d.followUp.t) { d.followUp._done = true; reveal(followUp); }
    if (d.toast    && !d.toast._done    && now >= d.toast.t)    { d.toast._done    = true; reveal(toast, 200); }

    var pct = Math.min(100, (now / d.duration) * 100);
    if (fillBar) fillBar.style.width = pct + '%';
    if (timeEl)  timeEl.textContent = fmt(Math.min(now, d.duration)) + ' / ' + fmt(d.duration);

    if (now >= d.duration) stop();
  }

  function resetProgress() {
    var d = data();
    d.turns.forEach(function (t) { delete t._done; });
    if (d.summary)  delete d.summary._done;
    if (d.followUp) delete d.followUp._done;
    if (d.toast)    delete d.toast._done;
    if (fillBar) fillBar.style.width = '0%';
    if (timeEl)  timeEl.textContent = '0:00 / ' + fmt(d.duration);
  }

  /* THE OPEN CHIME. → docs/implementation-notes.md#chime */
  function chime() {
    if (!stage) return;
    var src = stage.getAttribute('data-see-it-open-sound');
    if (!src) return;
    try {
      var a = new Audio(src);
      a.volume = 0.5;
      var p = a.play();
      if (p && p.catch) p.catch(function () {});
    } catch (e) {}
  }

  /* Retire the stage. ONE WAY ONLY — once the panels are up they stay up, including
     after the demo finishes. Reverting to the stage on stop would take the assembled
     recap away at the exact moment it has finished assembling, which is the payoff the
     whole section is built around. Replay is the transport's job, not the stage's. */
  function revealPanels() {
    if (root.classList.contains('has-played')) return;
    root.classList.add('has-played');
    if (stage) stage.hidden = true;
  }

  function play() {
    if (playing) { stop(); return; }
    revealPanels();
    clear();
    resetProgress();
    /* The caption is an at-rest instruction. Leaving it up during playback means
       the panel reads "Press play" while it is already playing. */
    if (caption) caption.hidden = true;
    playing = true;
    t0 = Date.now();
    root.classList.add('is-playing');
    playBtn.setAttribute('aria-label', 'Pause the conversation');
    timer = setInterval(tick, 100);
    tick();
  }

  function setMode(next) {
    if (next === mode) return;
    var d = DEMO[next];
    if (!d || !d.enabled) return;      // the voice tab is disabled until the recording exists
    stop();
    mode = next;
    tabs.forEach(function (tab) {
      var on = tab.dataset.mode === mode;
      tab.classList.toggle('see-it__tab--active', on);
      tab.setAttribute('aria-selected', String(on));
    });
    if (business) business.textContent = d.business;
    clear();
    resetProgress();
  }

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () { setMode(tab.dataset.mode); });
  });
  playBtn.addEventListener('click', play);

  /* The stage button and the transport button both call play; the stage's press adds
     the chime because that press is the one that "opens the widget". Focus moves to the
     transport afterwards so a keyboard user is not left on a button that has just
     removed itself from the page. */
  if (stagePlay) {
    stagePlay.addEventListener('click', function () {
      chime();
      play();
      if (playBtn && typeof playBtn.focus === 'function') playBtn.focus();
    });
  }

  /* Everything above is wired. Only NOW is it safe to swap the fully-rendered
     panels for the empty, playable version — so a throw anywhere earlier leaves
     the reader with a complete section rather than two empty boxes. */
  transport.hidden = false;
  if (stage) stage.hidden = false;
  root.classList.add('is-interactive');
  clear();
  resetProgress();
})();

/* SECTION 4 — the overnight inbox opens its recap documents. → docs/implementation-notes.md#section-4-the-overnight-inbox-opens-its-recap */
(function () {
  var root = document.querySelector('.what-you-get');
  if (!root) return;

  var rows = Array.prototype.slice.call(root.querySelectorAll('[data-morning-open]'));
  if (!rows.length) return;

  /* Feature-detect the METHOD, not the element. A <dialog> tag parses everywhere;
     older browsers simply render it inert with no showModal, which would throw on
     the first click and leave the reader with a dead row. */
  var probe = root.querySelector('dialog.recap-doc');
  if (!probe || typeof probe.showModal !== 'function') return;

  rows.forEach(function (row) {
    var dlg = document.getElementById('recap-' + row.dataset.morningOpen);
    if (!dlg) return;

    row.addEventListener('click', function () {
      dlg.showModal();
    });

    /* Click-outside-to-close. The dialog element fills the top layer, so a click
       landing on the DIALOG itself rather than on the sheet inside it is a click on
       the backdrop. Comparing against the sheet is what makes this reliable —
       event.target === dlg is true only outside .recap-doc__sheet. */
    dlg.addEventListener('click', function (e) {
      if (e.target === dlg) dlg.close();
    });

    var closeBtn = dlg.querySelector('[data-morning-close]');
    if (closeBtn) closeBtn.addEventListener('click', function () { dlg.close(); });

    /* Focus returns to the row that opened it. Browsers restore focus to the opener
       for showModal, but not after a programmatic close in every engine, and
       landing back at the top of the document loses a keyboard reader their place. */
    dlg.addEventListener('close', function () {
      if (typeof row.focus === 'function') row.focus();
    });
  });

  root.classList.add('is-interactive');
})();

/* SECTION 5 — the language orbit has NO SCRIPT, deliberately. → docs/implementation-notes.md#section-5-the-language-orbit-has-no-script-del */

/* ===================================================================
   SECTION 6 — the industry directory. */
(function () {
  var root = document.querySelector('.industries');
  if (!root) return;

  var names    = Array.prototype.slice.call(root.querySelectorAll('[data-ind-name]'));
  var panels   = Array.prototype.slice.call(root.querySelectorAll('[data-ind-panel]'));
  var excerpts = Array.prototype.slice.call(root.querySelectorAll('[data-ind-excerpt-for]'));
  if (!names.length) return;

  var mobile = window.matchMedia('(max-width: 900px)');

  function activate(slug) {
    names.forEach(function (b) {
      var on = b.dataset.indName === slug;
      b.classList.toggle('is-active', on);
      b.setAttribute('aria-pressed', String(on));
    });
    panels.forEach(function (p) {
      var on = p.dataset.indPanel === slug;
      p.classList.toggle('is-active', on);
      if (on) { p.removeAttribute('aria-hidden'); } else { p.setAttribute('aria-hidden', 'true'); }
    });
    excerpts.forEach(function (e) {
      e.classList.toggle('is-active', e.dataset.indExcerptFor === slug);
    });
  }

  function toggleMobile(btn) {
    var wasOpen = btn.classList.contains('is-open');
    names.forEach(function (b) { b.classList.remove('is-open'); });
    if (!wasOpen) btn.classList.add('is-open');
  }

  names.forEach(function (btn) {
    btn.addEventListener('click', function () {
      if (mobile.matches) {
        toggleMobile(btn);
      } else {
        activate(btn.dataset.indName);
      }
    });

    /* Desktop only, and only a prefetch: the next 440px render is likely to be
       wanted, but nothing is decoded or displayed until the click happens. */
    btn.addEventListener('mouseenter', function () {
      if (mobile.matches) return;
      var panel = root.querySelector('[data-ind-panel="' + btn.dataset.indName + '"] img');
      if (panel && panel.loading === 'lazy') panel.loading = 'eager';
    });
  });

  /* ⚠️ ONE ROW STARTS OPEN ON A PHONE, AND IT IS THE FIRST ONE, NOT THE FEATURED ONE. → docs/implementation-notes.md#openFirstOnMobile */
  function openFirstOnMobile() {
    names.forEach(function (b) { b.classList.remove('is-open'); });
    if (mobile.matches) names[0].classList.add('is-open');
  }
  mobile.addEventListener('change', openFirstOnMobile);
  openFirstOnMobile();

  /* Last, as everywhere else in this file: only now does CSS start collapsing the
     mobile details, so a throw above leaves every blurb and link readable. */
  root.classList.add('is-interactive');
})();
