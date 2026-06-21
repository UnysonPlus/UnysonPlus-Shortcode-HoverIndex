/* Hover Index — installable UnysonPlus shortcode.
   Floats a preview image that eases toward the cursor while a row is hovered.
   Vanilla JS, no dependencies. Touch / no-hover falls back to inline thumbnails
   (handled in CSS). Skips inside the page-builder editor. */
(function () {
  'use strict';
  if (typeof window === 'undefined' || typeof document === 'undefined') return;

  function inBuilder() {
    return document.body && (
      document.body.classList.contains('fw-builder-active') ||
      document.body.classList.contains('fw-backend-builder') ||
      window.self !== window.top
    );
  }

  var fine = window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function init(root) {
    if (root.__hvx) return;
    root.__hvx = true;

    var peek = root.querySelector('.fw-hvx__peek');
    var rows = root.querySelectorAll('.fw-hvx__row');
    if (!peek || !rows.length) return;

    // Non-functional demo links (href="#") shouldn't jump the page.
    rows.forEach(function (row) {
      row.addEventListener('click', function (e) {
        if (row.getAttribute('href') === '#') e.preventDefault();
      });
    });

    if (!fine || reduced) return; // touch / reduced motion → inline thumbs via CSS

    var pimg = peek.querySelector('img');
    var tx = 0, ty = 0, cx = 0, cy = 0, raf = null, active = false;

    function loop() {
      cx += (tx - cx) * 0.18;
      cy += (ty - cy) * 0.18;
      peek.style.setProperty('--hvx-x', cx + 'px');
      peek.style.setProperty('--hvx-y', cy + 'px');
      raf = requestAnimationFrame(loop);
    }

    window.addEventListener('mousemove', function (e) { tx = e.clientX; ty = e.clientY; }, { passive: true });

    rows.forEach(function (row) {
      var src = row.getAttribute('data-hvx-img');
      if (!src) return;
      row.addEventListener('mouseenter', function () {
        if (pimg.getAttribute('src') !== src) { pimg.src = src; }
        active = true;
        if (!raf) { cx = tx; cy = ty; loop(); } // snap to cursor on first show
        peek.style.transition = 'opacity .35s ease, clip-path .55s cubic-bezier(.16,1,.3,1)';
        peek.style.opacity = '1';
        peek.style.clipPath = 'inset(0 0 0% 0)';
      });
      row.addEventListener('mouseleave', function () {
        active = false;
        peek.style.opacity = '0';
        peek.style.clipPath = 'inset(0 0 100% 0)';
      });
    });
  }

  function boot() {
    if (inBuilder()) return;
    var lists = document.querySelectorAll('.fw-hvx');
    for (var i = 0; i < lists.length; i++) { init(lists[i]); }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }

  // pick up lists injected after load (AJAX, etc.)
  if ('MutationObserver' in window) {
    var mo = new MutationObserver(function () { boot(); });
    mo.observe(document.body || document.documentElement, { childList: true, subtree: true });
  }
})();
