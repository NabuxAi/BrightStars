# Bright Stars — WordPress Theme

A trilingual (English · Arabic · Persian, RTL-ready) WordPress theme for
**Bright Stars**, a Muscat-based digital-marketing agency. It is a faithful,
production-grade implementation of the original Claude Design prototype:
every section is dynamic and editable, content lives in custom post types, and
each page is a real, SEO-optimized WordPress page.

> Built from the design bundle in `../../project/`.

---

## Highlights

- **Real pages, not a single-page app.** Home, Services, Clients, About,
  Pricing, Blog and Contact are individual WordPress pages with their own
  URLs — each independently indexable.
- **Trilingual EN / AR / FA** with a header language switcher, full RTL
  support, per-language fonts (Saira Condensed / Space Grotesk / Inter for
  Latin, Tajawal for Arabic, Vazirmatn for Persian) and `hreflang` alternates.
- **Everything is dynamic.** A dedicated **Bright Stars** admin panel plus five
  custom post types drive every section. Nothing is hard-coded — yet the site
  is fully populated out of the box from the original copy.
- **SEO built in:** per-page meta title/description, Open Graph + Twitter
  cards, canonical URLs, `hreflang`, JSON-LD (`Organization`, `LocalBusiness`,
  `WebSite`, `Article`, `BreadcrumbList`), core sitemap support and clean
  semantic HTML.
- **Four colour themes** — Orange (default), Gold, Pearl, Emerald.
- **Scroll-driven motion** ported from the prototype (lighting progress bar,
  sticky “zero-to-viral” path, directional reveals) with
  `prefers-reduced-motion` respected.
- **Working contact form** that stores enquiries and emails the team.

---

## Installation

1. Copy the `bright-stars` folder into `wp-content/themes/`.
2. In **Appearance → Themes**, activate **Bright Stars**.
3. On activation the theme automatically:
   - creates the pages (Home, Services, Clients, About, Pricing, Contact, Blog),
   - sets Home as the front page and Blog as the posts page,
   - imports the demo content (services, pricing, team, testimonials, clients)
     in all three languages,
   - builds a Primary menu.
4. Visit **Settings → Permalinks** once and click *Save* to flush rewrite rules
   (so client case-study URLs work).

If you ever need to re-run setup: **Bright Stars → Setup & Demo**.

---

## Managing content

Everything is under the **Bright Stars** menu in wp-admin.

| Where | Controls |
|------|----------|
| **Theme Settings → General** | Brand name, logo, colour theme, default & enabled languages |
| **Theme Settings → Hero** | Headline, sub-text, the three hero stats |
| **Theme Settings → Journey & Process** | The 5-step path, the metrics band, the 4-step process |
| **Theme Settings → Section headings** | Eyebrows & headings for every section |
| **Theme Settings → About / Contact / Footer / SEO** | Intro copy, contact details, map, social links, analytics |
| **Services** | Service cards (icon + title + description) |
| **Pricing** | Plans (price, features, “most popular” flag) |
| **Team** | Members (photo, role, quote, bio) |
| **Testimonials** | Client quotes |
| **Clients** | Logos + categories; each is also an SEO case-study page |
| **Enquiries** | Contact-form submissions |

**Translations:** every text field accepts EN / AR / FA. Leave a field blank
to fall back to the built-in translation, so the site is never half-translated.

**SEO per page:** every page, post and client has an *SEO — Bright Stars* box
for a custom meta title, description and a noindex toggle.

---

## Architecture

```
bright-stars/
├── style.css, functions.php          theme header + bootstrap
├── header.php, footer.php, *.php      templates (front-page, page, home, single, archive, search, 404…)
├── page-templates/                    Services / Clients / About / Pricing / Contact templates
├── template-parts/
│   ├── nav, mobile-menu, post-card
│   └── sections/                      hero, process-path, services, metrics, process,
│                                      clients, testimonials, about, pricing, cta, map, blog-teaser
├── inc/
│   ├── i18n.php                       EN/AR/FA dictionary (design defaults)
│   ├── helpers.php                    bs_lang(), bs_opt(), bs_t(), bs_field(), bs_icon()…
│   ├── setup.php, enqueue.php         supports, menus, assets, fonts
│   ├── cpt.php                        custom post types + trilingual meta boxes
│   ├── seo.php                        meta, Open Graph, JSON-LD, hreflang
│   ├── template-tags.php              nav, language switcher, helpers
│   └── admin/                         options schema, the panel, setup + seeding, enquiries
└── assets/                            css (tokens + theme), js, images
```

Content resolution: a section first looks for its custom-post-type items (or
admin field); if none exist it falls back to the faithful design defaults — so
the front end always looks complete, even before anything is edited.

---

## Requirements

- WordPress 6.0+ (tested up to 7.0)
- PHP 7.4+

## License

GPL-2.0-or-later.
