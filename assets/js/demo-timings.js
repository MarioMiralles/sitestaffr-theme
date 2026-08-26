/**
 * SECTION 3 DEMO — SINGLE SOURCE OF TRUTH FOR TIMING AND SCRIPT.
 *
 * ─────────────────────────────────────────────────────────────────────────────
 * WHEN THE AUTO-REPAIR RECORDING ARRIVES, THIS IS THE ONLY FILE THAT CHANGES.
 * ─────────────────────────────────────────────────────────────────────────────
 *
 * Mario is recording it LAST, after the rest of the redesign is built (2026-08-26).
 * It needs a sandbox tenant first, and the sandbox needs config export/restore before
 * "shelve the beauty clinic and build auto repair" is a real workflow rather than a
 * delete-and-rebuild. That is the longest pole on the page and it is not website work.
 *
 * So nothing in site.js hardcodes a timestamp, a speaker or a line of script. To land
 * the recording: drop the file in, re-time `voice.turns[].t` against it, set
 * `voice.src` and `voice.duration`, flip `voice.enabled` to true, and change
 * DEFAULT_MODE to 'voice'. No markup or CSS changes, no mechanism changes.
 *
 * WHY TEXT SHIPS FIRST. The spec says voice leads, and it should: section 3's currency
 * is credibility, a chat transcript is trivially fakeable, and almost nobody has heard a
 * website answer out loud. But the text thread drives the IDENTICAL live-fill mechanism,
 * so shipping it first means the section argues completely on day one instead of sitting
 * behind a blocker. `voice` below is scaffolding, deliberately marked disabled.
 *
 * ⚠️ THERE IS NO FIXED RECAP SCHEMA. Each turn's optional `fill` carries a label AND a
 * value, and they materialise together as a pair. The product builds each recap
 * intelligently — sometimes a name only, sometimes a name and an email, sometimes a name
 * and a phone. A pre-drawn skeleton of greyed labels would be a picture of a form the
 * product does not have. Note the two threads below capture DIFFERENT fields, and that
 * difference is load-bearing, not incidental.
 *
 * ⚠️ BOTH THREADS END WITH DETAILS CAPTURED AND A HUMAN FOLLOWING UP — no appointment is
 * confirmed. SiteStaffr gathers leads; it does not hold a calendar. A demo that books
 * something is a demo of a product we do not sell.
 */
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
    /* Pest control on purpose. Section 2's grid has no pest-control card, so this is the
       better contrasting second example — section 2 says what one job is worth, section 3
       lets you watch a different one arrive. */
    duration: 54,
    turns: [
      { t: 0,  who: 'ai',      text: 'Copperleaf Pest Control — what are you seeing?' },
      { t: 4,  who: 'visitor', text: 'Ants all over the kitchen counter, started today.' },
      { t: 9,  who: 'ai',      text: 'That usually means a trail in from outside. Is it a house or an apartment?',
                fill: { label: 'Reason for visit', value: 'Ants in the kitchen' } },
      { t: 17, who: 'visitor', text: 'A house, single storey.' },
      { t: 22, who: 'ai',      text: 'We can get someone out to look. What name should I put down?',
                fill: { label: 'Property', value: 'Single-storey house' } },
      { t: 29, who: 'visitor', text: 'Priya Raman.' },
      { t: 34, who: 'ai',      text: 'Thanks Priya — best email or number to reach you?',
                fill: { label: 'Name', value: 'Priya Raman' } },
      { t: 40, who: 'visitor', text: 'priya.raman@example.com' },
      { t: 45, who: 'ai',      text: 'Got it. Someone will follow up to arrange a visit.',
                fill: { label: 'Email', value: 'priya.raman@example.com' } }
    ],
    /* The summary and the follow-up genuinely ARE generated after the conversation ends,
       so they arrive last and after a brief shimmer. That is not decoration; it is the
       one part of the sequence that mirrors how the product actually works. */
    summary:  { t: 49, text: 'Ant trail in the kitchen of a single-storey house. Wants someone to come out.' },
    followUp: { t: 51, text: 'Email Priya to arrange a visit.' },
    toast:    { t: 53, text: 'Recap emailed to you' }
  }
};
