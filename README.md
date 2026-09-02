# SiteStaffr Website Theme

A hand built classic WordPress theme for SiteStaffr, an AI voice and text agent plugin
published on WordPress.org.

**Live: [staging.sitestaffr.com](https://staging.sitestaffr.com)** — this branch, the V3 redesign.
Production at [sitestaffr.com](https://sitestaffr.com) still runs the previous version.

No page builder, no framework, no build step. Every template is written by hand on the
WordPress template hierarchy and the theme deploys as source.

| | |
|---|---|
| Version | 0.9.25 |
| PHP | 10,999 lines, 26 files |
| JavaScript | 2,813 lines, vanilla |
| CSS | 13,790 lines |
| Commits | 476 |

## Layout

```
functions.php          theme wiring: assets, headers, caching, page provisioning
index.php  page.php  single.php  404.php
page-{slug}.php        15 hand written page templates
template-parts/        nav, footer, hero, seam, showcases
assets/css/site.css    the whole design system
docs/                  why the code is the way it is
assets/js/             site behavior and the customer account area
```

## A few things worth knowing

**The block system.** Every section on the redesigned pages is one of four block types
(`Statement`, `Split`, `Cards`, `Panel`) with exactly two padding values. This replaced a set of
color "seams" between neighboring sections, each of which was a contract that failed silently at
some viewport widths. Whitespace has no such contract, so most of the sweep work went away.

**Security headers ship with the theme.** `functions.php` sends `X-Content-Type-Options`,
`X-Frame-Options`, `Referrer-Policy` and `Permissions-Policy: microphone=(self)` on `send_headers`.
The last one is scoped deliberately: this is a voice product, so the page needs the mic and no
embedded third party frame should have it. `wp_generator` is removed so the site stops advertising
its WordPress version.

**Caching is version gated.** The site runs LiteSpeed. Rather than purging on every request, the
theme records the version it last purged and compares, so a deploy purges once and never again
until the next one. A theme level `.htaccess` handles compression and long lived immutable caching
for assets, which are busted with a `filemtime` query string.

**Pages are provisioned from code.** An industry registry in `functions.php` drives the
`/for/{industry}/` pages and their SEO metadata from a single array, so adding an industry is one
registry entry and a version bump rather than a new template.

**The reasoning lives in `docs/`.** Long rationale used to sit inline as block comments, which made
the source hard to read. It was moved out so the code reads as code:
[`docs/design-system.md`](docs/design-system.md) covers the CSS,
[`docs/implementation-notes.md`](docs/implementation-notes.md) covers the PHP and JavaScript, both
keyed by selector, token or function name. The source itself carries only what you need while
reading it: section markers, WordPress template headers, and PHPDoc.

**Accessibility was measured, not assumed.** Color tokens are set by their worst background
rather than their most common one, which is why `--teal-text` exists separately from the brand
fill `--teal-deep`. Contrast was sampled from rendered pixels, because a `background-color` walk
silently misreads gradients and translucent fills.

## Running it locally

Drop the theme into `wp-content/themes/` of a WordPress install and activate it. There is no build
step; what is in the repository is what runs.

## Notes

This is a real commercial site, published so the code can be read.

- On staging, `/download/` and `/about/` are intentionally absent while they are redesigned, so
  those two nav links 404 there. Both are live in production.
- The customer account area talks to a private API and will not do anything useful without it.
- Staging is `noindex` and carries no Yoast configuration, which is why its SEO score reads low.

All rights reserved. Published for review, not licensed for reuse.
