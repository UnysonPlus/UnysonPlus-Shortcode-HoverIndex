# Hover Index — UnysonPlus shortcode

An add-on element for the [UnysonPlus](https://github.com/UnysonPlus) page
builder: a "selected work" index where hovering a row floats a preview image
that follows the cursor (and clip-reveals). On touch devices each row shows an
inline thumbnail instead. Vanilla JS, no dependencies.

This is **not** bundled in core — it installs on demand.

## Install

In WordPress: **Unyson+ → Extensions → Shortcodes**, then either:

- **From GitHub** — paste this repo's URL (`https://github.com/UnysonPlus/UnysonPlus-Shortcode-HoverIndex`) and click *Download & install*, or
- **Upload a .zip** — download this repo as a zip and upload it.

It installs into `wp-content/uploads/unysonplus-shortcodes/` (update-safe) and is
enabled automatically. You'll then find **Hover Index** under the **Interactive**
tab in the page builder.

## Use

Add the element, then add items (title, category, year, a preview image, an
optional link). Hover a row on desktop to see the floating preview. The
**Animations** tab still applies, so you can stagger the rows in on scroll.

## License

GPL-2.0-or-later.
