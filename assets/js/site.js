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

// ========== NAVIGATION SCROLL ==========
const nav = document.getElementById('nav');
let lastScroll = 0;
window.addEventListener('scroll', () => {
  const scrollY = window.scrollY;
  if (scrollY > 60) {
    nav.classList.add('scrolled');
  } else {
    nav.classList.remove('scrolled');
  }
  lastScroll = scrollY;
}, { passive: true });

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

  const transcriptEntries = transcriptSourceLines.map((line, index) => ({
    index,
    speaker: (line.dataset.speaker || 'ai').toLowerCase() === 'caller' ? 'caller' : 'ai',
    start: Number.parseFloat(line.dataset.start || '0'),
    end: Number.parseFloat(line.dataset.end || '999'),
    text: (line.textContent || '').trim()
  }));

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

  setPlayState(false);
  setTranscriptExpanded(true);
  setRecapVisible(false);
  resetTranscriptWindow();

  playBtn.addEventListener('click', () => {
    if (didReachAudioEnd || (audio.duration && audio.currentTime >= audio.duration - 0.05)) {
      audio.currentTime = 0;
      didReachAudioEnd = false;
      progressFill.style.width = '0%';
      currentTimeEl.textContent = '0:00';
      setRecapVisible(false);
      setTranscriptExpanded(true);
      resetTranscriptWindow();
    }

    if (audio.paused) {
      audio.play().catch(() => {});
    } else {
      audio.pause();
    }
  });

  // Audio lifecycle events are the source of truth for transcript/recap UI state.
  audio.addEventListener('play', () => {
    didReachAudioEnd = false;
    setPlayState(true);
    setTranscriptExpanded(true);
    setRecapVisible(false);
    updateTranscriptWindow(audio.currentTime);
  });

  audio.addEventListener('pause', () => {
    if (audio.ended) {
      return;
    }
    setPlayState(false);
    setTranscriptExpanded(false);
    setRecapVisible(true);
  });

  audio.addEventListener('timeupdate', () => {
    if (audio.duration) {
      progressFill.style.width = (audio.currentTime / audio.duration * 100) + '%';
      currentTimeEl.textContent = formatTime(audio.currentTime);
    }
    updateTranscriptWindow(audio.currentTime);
  });

  audio.addEventListener('loadedmetadata', () => {
    totalTimeEl.textContent = formatTime(audio.duration);
  });

  audio.addEventListener('ended', () => {
    didReachAudioEnd = true;
    setPlayState(false);
    progressFill.style.width = '100%';
    currentTimeEl.textContent = totalTimeEl.textContent;
    rebuildTranscriptWindow(audio.duration || 999);
    setTranscriptExpanded(false);
    setRecapVisible(true);
  });

  progressBar.addEventListener('click', (e) => {
    if (!audio.duration) {
      return;
    }

    const rect = progressBar.getBoundingClientRect();
    if (!rect.width) {
      return;
    }

    const rawPosition = (e.clientX - rect.left) / rect.width;
    const position = Math.min(1, Math.max(0, rawPosition));
    audio.currentTime = position * audio.duration;

    if (audio.currentTime < audio.duration - 0.1) {
      didReachAudioEnd = false;
      if (!audio.paused) {
        setTranscriptExpanded(true);
        setRecapVisible(false);
      }
    }

    updateTranscriptWindow(audio.currentTime);
  });
}

document.querySelectorAll('.js-audio-demo').forEach((demoLayout) => {
  initAudioDemo(demoLayout);
});

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
