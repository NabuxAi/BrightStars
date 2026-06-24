# Bright Stars — Design System

A confident, modern **software / developer** brand for top-tier builders ("Bright Stars" = elite engineering talent). Built on a **pure-black canvas** with a single high-energy **orange** accent and a deep **navy** as the structural/brand color. The signature motif is **code angle brackets `< >` inside a rotated-square (diamond) frame**.

> **Personality:** confident · technical · sharp · ambitious · optimistic. Feels like a senior dev team's home — precise, modern, no fluff.
> **Accent rule:** orange is rare and intentional. Navy + black do the heavy lifting; orange is the one thing that glows.

---

## Sources

This system was authored from a written brand spec ("Bright Stars — Design System Prompt") plus two uploaded logo files:
- `uploads/Asset 3@4x.png` — full-color logo lockup (mark + wordmark) → `assets/logo-full-color.png`
- `uploads/logo b.png` — white mark, transparent background → `assets/logo-mark-white.png`
- Derived: `assets/logo-mark-color.png` (mark-only crop of the full-color lockup)

No codebase or Figma file was provided — the spec is the source of truth. If a product codebase exists, attach it so the UI kit can be made pixel-accurate.

---

## CONTENT FUNDAMENTALS

**Voice:** confident and technical, never salesy. Short, declarative, builder-to-builder. Reads like a senior engineer wrote it.

- **Person:** addresses the reader as **you**; the brand speaks as **we** sparingly. Outcome-first.
- **Casing:** Sentence case for body and most headings. **UPPERCASE** reserved for the mono eyebrow device and badges. Hero headlines may go uppercase (condensed display).
- **Tone:** precise, no fluff, lightly ambitious/optimistic. Confidence without hype — state the capability, don't oversell it.
- **Emoji:** none. The brand device (`< >`, diamond) does the expressive work instead of emoji.
- **The bracket device in copy:** eyebrows and labels are wrapped in angle brackets — `< BUILD FAST >`, `< NOW HIRING >` — rendered in mono, uppercase, +6% tracking.
- **Examples:**
  - Hero: "Build bright." / "Top-tier builders ship here."
  - Eyebrow: `< BUILD FAST >`, `< WHY BRIGHT STARS >`
  - Body: "Bright Stars is the home for senior dev teams — precise, modern, no fluff."
  - CTA: "Get started", "View docs", "Learn more" (verb-first, terse).
- **Avoid:** exclamation-heavy hype, corporate filler, pastel-friendly cutesy phrasing, decorative adjectives.

---

## VISUAL FOUNDATIONS

**Colors.** Pure-black page canvas (`--canvas #000`). Content sits on near-black navy-tinted surfaces (`--surface #0A0F18`, `--surface-2 #101826`). Navy (`#13335A` + 50–900 scale) is the structural/brand color; orange (`#F58021` + 50–800 scale) is the lone accent — CTAs, focus, highlights, the one glow. **Contrast rule:** orange buttons use near-black text (`#0A0F18`); white text only on navy/black. White-on-orange fails WCAG and is forbidden.

**Type.** Four families: **Saira Condensed / Anton** for hero headlines (700–900, often uppercase, tight), **Space Grotesk** for headings/display (600–700, −2% tracking, geometric & techy), **Inter** for body/UI (400/500/600, line-height 1.6), **JetBrains Mono** for eyebrows/labels/code (500, +6% tracking, uppercase, wrapped in `< >`). Type scale: 0.75 → 3.75rem.

**Spacing & layout.** 8px base grid (4px sub-steps): 4·8·12·16·24·32·48·64·96. Generous negative space, high contrast, content max-width ~1200px. Pure-black gutters; panels float on top.

**Backgrounds.** Flat pure black — **no gradient soup, no stock photos, no hand-drawn illustration**. Optional structural decoration only: the diamond/bracket device, hairline grids, faint navy panels. The drama comes from black space + one orange glow, not from textures.

**Corner radii.** Medium and consistent: `sm 6px`, **`md 10px` (default)**, `lg 16px` (cards), `pill 9999px` (badges/switch). Never sharp 0px, never fully pill on buttons.

**Cards.** `--surface-2` fill, 1px `--border` hairline, `--radius-lg` (16px), subtle dark shadow. Optional **orange top-left corner-bracket accent**. Interactive cards lift 2px and deepen their shadow on hover.

**Borders & shadows.** Hairlines `--border #1C2738`; input/focus boundaries `--border-strong #2A384D`. Shadows are dark and soft (`0 4px 16px rgba(0,0,0,.45)`). The hero elevation is the **orange glow** — `0 0 0 1px #F58021, 0 8px 24px rgba(245,128,33,.25)` — reserved for primary CTAs and focus.

**Hover states.** Primary button → lighter orange (`--orange-400`) + lift 2px + glow. Secondary → navy-700 fill. Ghost → 10% orange tint. Cards → lift + shadow. Motion is purposeful, never bouncy.

**Press states.** Primary button → darker orange (`--orange-600`), settles back to translateY(0). No shrink/scale tricks.

**Focus.** Animated orange ring (`--glow-soft`, 3px `rgba(245,128,33,.25)`) + orange border. Always visible, never removed.

**Transparency & blur.** Used sparingly — orange tints at 10–25% alpha for ghost surfaces and chips; semantic badge fills at ~12% alpha. No heavy glassmorphism.

**Imagery vibe.** When photography is used it should be cool-toned, high-contrast, technical (screens, code, hardware) — but the default is no imagery; black space is the canvas.

**Motion.** Duration 150–220ms; easing `cubic-bezier(.2,.8,.2,1)` (`--ease`). Hover = lift + glow; section reveal = fade-up 16px; focus = animated orange ring. Never bouncy, never decorative loops.

---

## ICONOGRAPHY

- **Icon set:** **Lucide** (or Phosphor), **1.75–2px stroke**, geometric with square-ish joins. Linked from CDN in UI kits/slides (no codebase icon font was provided — flagged as a substitution; swap for the product's real set if one exists).
- **No emoji.** The brand never uses emoji. Expressive accents come from the bracket/diamond device instead.
- **Brand glyph device:** the angle-bracket pair `< >` is used as a typographic icon — in eyebrows, as select chevrons (`>`), as the corner-bracket frame on cards, and as the diamond around the `bs` mark. Pair key icons with `< >` accents.
- **Unicode used as icons:** `<`, `>`, `/`, `→` (mono) appear as lightweight glyphs where a full icon would be overkill (e.g. select chevron, button arrow).
- **Logo assets** in `assets/`: `logo-full-color.png` (lockup), `logo-mark-color.png` (mark only), `logo-mark-white.png` (white mark for dark/photographic backgrounds). Never recolor the mark outside orange/navy/white-on-dark. Clear space ≥ the height of the `b`.

---

## Index / manifest

**Root**
- `styles.css` — global entry; `@import` manifest only. Consumers link this one file.
- `tokens/` — `fonts.css` (Google Fonts import), `colors.css`, `typography.css`, `spacing.css`, `effects.css`.
- `assets/` — logos (full color, mark color, mark white).
- `guidelines/` — foundation specimen cards (Design System tab).
- `SKILL.md` — Agent-Skill manifest for use in Claude Code.

**Components** (`window.BrightStarsDesignSystem_7248ca`)
- `components/buttons/` — **Button**, **IconButton**
- `components/forms/` — **Input**, **Select**, **Checkbox**, **Switch**
- `components/display/` — **Eyebrow**, **Badge**, **Card**, **Avatar**

**UI kit**
- `ui_kits/marketing/` — Bright Stars marketing site (hero, features, careers/CTA) — interactive `index.html`.
- `ui_kits/agency-landing/` — **Bright Starts** (Muscat digital-marketing agency) luxury Gulf landing — 3 switchable brand directions (Midnight Gold / Pearl & Sand / Royal Emerald).

**Luxe layer**
- `tokens/luxe.css` — champagne-gold, deep-emerald and pearl/sand luxury tokens + an Arabic display family (Tajawal). Additive over the Bright Stars core; powers the agency landing's luxury directions.

**Slides**
- `slides/` — branded 16:9 sample slides (title, section, content, big-quote).

---

*Font note: all four families are Google Fonts, loaded via `@import` in `tokens/fonts.css` (requires network). If you need offline/self-hosted fonts, ask and I'll swap in `@font-face` rules with bundled files.*
