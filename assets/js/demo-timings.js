/* SECTION 3 DEMO — SINGLE SOURCE OF TRUTH FOR TIMING AND SCRIPT. → docs/implementation-notes.md#section-3-demo-single-source-of-truth-for-timi */
window.SITESTAFFR_DEMO = {

  /* Which tab is active on load. 'voice' once the recording exists. */
  DEFAULT_MODE: 'text',

  voice: {
    enabled: false,                 // no recording yet — the tab renders disabled
    src: null,                      // e.g. '/wp-content/.../assets/audio/ridgeline-auto.mp3'
    label: 'My check engine light came on',
    business: 'Ridgeline Auto',
    stamp: '8:42 PM',
    duration: 72,
    /* Placeholder timings. These are a plausible shape, NOT measured against audio —
       every `t` must be re-read off the real waveform before voice goes live. */
    turns: [
      { t: 0,  who: 'ai',      text: 'Ridgeline Auto, how can I help?' },
      { t: 5,  who: 'visitor', text: 'My check engine light came on this morning.' },
      { t: 10, who: 'ai',      text: 'I can get that looked at. What year and make is it?',
                fill: { label: 'Reason for visit', value: 'Check engine light' } },
      { t: 18, who: 'visitor', text: "It's a 2019 Honda Civic." },
      { t: 24, who: 'ai',      text: 'Got it. What name should I put down?',
                fill: { label: 'Vehicle', value: '2019 Honda Civic' } },
      { t: 32, who: 'visitor', text: "Dave — Dave Whitfield." },
      { t: 38, who: 'ai',      text: 'Thanks Dave. Best number to reach you on?',
                fill: { label: 'Name', value: 'Dave Whitfield' } },
      { t: 44, who: 'visitor', text: '555-0142.' },
      { t: 49, who: 'ai',      text: 'Perfect. Someone will follow up to book you in this week.',
                fill: { label: 'Phone', value: '555-0142' } }
    ],
    summary:  { t: 58, text: 'Check engine light on a 2019 Honda Civic. Wants it looked at this week.' },
    followUp: { t: 64, text: 'Call Dave to book a diagnostic.' },
    toast:    { t: 69, text: 'Recap emailed to you' }
  },

  text: {
    enabled: true,
    src: null,                      // typed thread: the clock drives itself
    label: 'There are ants all over my kitchen',
    business: 'Copperleaf Pest Control',
    stamp: '11:18 PM',
    /* Pest control on purpose. → docs/implementation-notes.md#pest-control-on-purpose-section-2-s-grid-has-n */
    duration: 54,
    turns: [
      { t: 0,  who: 'ai',      text: 'Copperleaf Pest Control — what are you seeing?' },
      { t: 4,  who: 'visitor', text: 'Ants all over the kitchen counter, started today.' },
      { t: 9,  who: 'ai',      text: 'That usually means a trail in from outside. Is it a house or an apartment?',
                fill: { label: 'Reason for visit', value: 'Ants in the kitchen' } },
      { t: 17, who: 'visitor', text: 'A house, single story.' },
      { t: 22, who: 'ai',      text: 'We can get someone out to look. What name should I put down?',
                fill: { label: 'Property', value: 'Single-story house' } },
      { t: 29, who: 'visitor', text: 'Priya Raman.' },
      { t: 34, who: 'ai',      text: 'Thanks Priya — best email or number to reach you?',
                fill: { label: 'Name', value: 'Priya Raman' } },
      { t: 40, who: 'visitor', text: 'priya.raman@example.com' },
      { t: 45, who: 'ai',      text: 'Got it. Someone will follow up to arrange a visit.',
                fill: { label: 'Email', value: 'priya.raman@example.com' } }
    ],
    /* The summary and the follow-up genuinely ARE generated after the conversation ends, so they… → docs/implementation-notes.md#the-summary-and-the-follow-up-genuinely-are-ge */
    summary:  { t: 49, text: 'Ant trail in the kitchen of a single-story house. Wants someone to come out.' },
    followUp: { t: 51, text: 'Email Priya to arrange a visit.' },
    toast:    { t: 53, text: 'Recap emailed to you' }
  }
};
