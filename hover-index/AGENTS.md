---
type: shortcode
name: hover_index
provides: simple-element
distribution: installable add-on (not bundled in core)
---

# Hover Index

A list of links (a "selected work" index) where hovering a row floats a
preview image that eases toward the cursor and clip-reveals. On touch / no-hover
devices each row shows an inline thumbnail instead. The whole list is a normal
shortcode wrapper, so the **Animations** tab (incl. GSAP Scroll Motion) still
applies — e.g. stagger the rows in on scroll.

This is an **installable add-on shortcode**, distributed as its own repo and
installed from the Shortcodes screen (GitHub URL or zip). It is NOT bundled in
the core shortcodes extension.

## Registration

Auto-registered by the framework from `config.php` — no class file, no
page-builder item (it is a simple content element, not section-like). The
installer copies it to `wp-content/uploads/unysonplus-shortcodes/hover-index/`.

## Options schema (atts)

| Att | Type | Default | Notes |
|-----|------|---------|-------|
| `items` | addable-popup[] | `[]` | Each: `title`, `meta`, `year`, `image` (`upload` → `{attachment_id,url}`), `link_url`, `link_target` (`_self`/`_blank`) |
| `size` | select | `lg` | `md` / `lg` / `xl` — title size |
| `preview_ratio` | select | `portrait` | `portrait` (4:5) / `landscape` (3:2) / `square` |
| `show_numbers` | switch | `yes` | Prefix rows with 01, 02, … |
| `dividers` | switch | `yes` | Hairline between rows |
| `text_color` / `hover_color` / `meta_color` | compact color | `''` | CSS vars `--hvx-text` / `--hvx-accent` / `--hvx-meta` |
| `font_size_preset`, `spacing` | styling | | Standard |
| `animation` / `gsap_motion` | (Animations tab) | | Standard shortcode wrapper effects |

## Rendering

`views/view.php` outputs `.fw-hvx > .fw-hvx__list > a.fw-hvx__row` rows
(`.fw-hvx__n`, `__t`, `__meta`, `__yr`, plus an inline `.fw-hvx__thumb`), and one
`.fw-hvx__peek` preview element per instance. Each row carries `data-hvx-img`.
`static/js/scripts.js` (vanilla, no deps) eases the peek toward the cursor with
a rAF lerp while a row is hovered. Skips inside the page-builder editor and on
touch / reduced-motion (CSS shows the inline thumbnails there).

`static.php` resolves its own asset URL from `__FILE__` against the uploads base
(it runs isolated, so there is no `$this` / extension path).

## Pitfalls

- The `image` field is an `upload` → value is `{ attachment_id, url }`; read
  `$it['image']['url']`. Demo/import generators should localize external URLs.
- Multiple instances on a page each get their own `.fw-hvx__peek`.

## Files

- `config.php` — page-builder config (tab/title/title_template)
- `options.php` — edit-modal fields (atts schema)
- `static.php` — frontend enqueues (uploads-relative URI)
- `views/view.php` — frontend HTML
- `static/css/styles.css`, `static/js/scripts.js`, `static/img/page_builder.svg`
