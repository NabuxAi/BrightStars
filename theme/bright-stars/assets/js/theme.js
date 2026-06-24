/* Bright Stars — front-end behaviour (vanilla, no framework). */
(function () {
  'use strict';

  var cfg = window.BrightStars || {};

  function ready(fn) {
    if (document.readyState !== 'loading') { fn(); }
    else { document.addEventListener('DOMContentLoaded', fn); }
  }

  /* ---------- language switch: persist choice in a cookie, clean the URL ---------- */
  function initLang() {
    try {
      var params = new URLSearchParams(window.location.search);
      var l = params.get('lang');
      if (l && ['en', 'ar', 'fa'].indexOf(l) !== -1) {
        document.cookie = 'bs_lang=' + l + ';path=/;max-age=' + (60 * 60 * 24 * 365) + ';samesite=lax';
        params.delete('lang');
        var qs = params.toString();
        var clean = window.location.pathname + (qs ? '?' + qs : '') + window.location.hash;
        window.history.replaceState({}, '', clean);
      }
    } catch (e) {}
  }

  /* ---------- mobile menu ---------- */
  function initMobile() {
    var panel = document.querySelector('[data-mobile]');
    if (!panel) return;
    var open = document.querySelector('[data-mobile-open]');
    var closers = document.querySelectorAll('[data-mobile-close]');
    function setOpen(state) {
      panel.hidden = !state;
      document.body.style.overflow = state ? 'hidden' : '';
      if (open) open.setAttribute('aria-expanded', state ? 'true' : 'false');
    }
    if (open) open.addEventListener('click', function () { setOpen(true); });
    closers.forEach(function (c) { c.addEventListener('click', function () { setOpen(false); }); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setOpen(false); });
    panel.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () { if (!a.hasAttribute('data-keep')) setOpen(false); });
    });
  }

  /* ---------- scroll reveals ---------- */
  function initReveals() {
    var els = Array.prototype.slice.call(document.querySelectorAll('[data-reveal]'));
    if (!els.length) return;
    if (!('IntersectionObserver' in window)) {
      els.forEach(function (el) { el.style.opacity = '1'; el.style.transform = 'none'; });
      return;
    }
    var vw = window.innerWidth;
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) {
          en.target.style.opacity = '1';
          en.target.style.transform = 'none';
          obs.unobserve(en.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });

    els.forEach(function (el) {
      var dir = el.getAttribute('data-rev-dir');
      if (!dir) {
        var r = el.getBoundingClientRect();
        var c = r.left + r.width / 2;
        if (r.width < vw * 0.6 && c < vw * 0.42) dir = 'left';
        else if (r.width < vw * 0.6 && c > vw * 0.58) dir = 'right';
        else dir = 'up';
      }
      var off = dir === 'left' ? 'translateX(-46px)' : dir === 'right' ? 'translateX(46px)' : 'translateY(26px)';
      var d = parseFloat(el.getAttribute('data-rev-delay') || '0');
      el.style.transition = 'opacity .7s var(--ease) ' + d + 's, transform .7s var(--ease) ' + d + 's';
      el.style.opacity = '0';
      el.style.transform = off;
      obs.observe(el);
    });

    // Safety: reveal anything already in view after a beat.
    setTimeout(function () {
      els.forEach(function (el) {
        var r = el.getBoundingClientRect();
        if (r.top < window.innerHeight * 1.05) { el.style.opacity = '1'; el.style.transform = 'none'; }
      });
    }, 1300);
  }

  /* ---------- scroll-driven lighting + process path ---------- */
  function initScroll() {
    var fill = document.querySelector('[data-progress]');
    var tip = document.querySelector('[data-progress-tip]');
    var site = document.querySelector('.bs-site');
    var pathwrap = document.querySelector('[data-pathwrap]');

    function onScroll() {
      // global lighting bar
      if (site && fill) {
        var rect = site.getBoundingClientRect();
        var total = (rect.height - window.innerHeight) || 1;
        var p = Math.min(1, Math.max(0, -rect.top / total));
        fill.style.height = (p * 100).toFixed(2) + '%';
        fill.style.opacity = (0.4 + p * 0.6).toFixed(3);
        if (tip) {
          var glow = (4 + p * 16).toFixed(1);
          tip.style.boxShadow = '0 0 ' + glow + 'px ' + (1 + p * 4).toFixed(1) + 'px var(--bs-accent)';
          tip.style.opacity = p > 0.005 ? '1' : '0';
        }
      }
      // process path: spine fill + sticky title scaling
      if (pathwrap) {
        var pr = pathwrap.getBoundingClientRect();
        var ptotal = (pr.height - window.innerHeight * 0.5) || 1;
        var pprog = Math.min(1, Math.max(0, (window.innerHeight * 0.5 - pr.top) / ptotal));
        var pf = pathwrap.querySelector('[data-path-fill]');
        if (pf) pf.style.height = (pprog * 100).toFixed(2) + '%';
        pathwrap.querySelectorAll('[data-step]').forEach(function (st) {
          var title = st.querySelector('[data-step-title]');
          if (!title) return;
          var top = st.getBoundingClientRect().top;
          var pin = 58;
          var t = Math.min(1, Math.max(0, (window.innerHeight * 0.52 - top) / (window.innerHeight * 0.52 - pin || 1)));
          title.style.transform = 'scale(' + (0.6 + t * 0.4).toFixed(3) + ')';
          title.style.opacity = (0.3 + t * 0.7).toFixed(3);
        });
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    onScroll();
  }

  /* ---------- alerts (SweetAlert2 when present, else inline) ---------- */
  var T = (cfg.i18n) || {};
  function alertBox(opts, fallbackEl, fallbackMsg) {
    if (window.Swal) {
      return window.Swal.fire(Object.assign({
        background: '#101826',
        color: '#F4F7FB',
        confirmButtonColor: '#F58021',
        confirmButtonText: T.ok || 'OK',
        buttonsStyling: true
      }, opts));
    }
    if (fallbackEl) { fallbackEl.hidden = false; fallbackEl.textContent = fallbackMsg || (opts && opts.text) || ''; }
    return Promise.resolve();
  }

  function markInvalid(el, on) {
    if (!el) return;
    el.style.borderColor = on ? '#F0524B' : '';
  }

  function isEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }

  /* ---------- contact form (AJAX) ---------- */
  function initForm() {
    var form = document.querySelector('[data-lead-form]');
    if (!form) return;
    var okBox = document.querySelector('[data-lead-ok]');
    var errBox = form.querySelector('[data-lead-err]');
    var btn = form.querySelector('button[type="submit"]');

    var fName = form.querySelector('[name="bs_name"]');
    var fEmail = form.querySelector('[name="bs_email"]');
    var fPhone = form.querySelector('[name="bs_phone"]');
    var fMsg = form.querySelector('[name="bs_message"]');

    [fName, fEmail, fPhone, fMsg].forEach(function (el) {
      if (el) el.addEventListener('input', function () { markInvalid(el, false); if (errBox) errBox.textContent = ''; });
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (errBox) errBox.textContent = '';

      var name = (fName && fName.value || '').trim();
      var email = (fEmail && fEmail.value || '').trim();
      var phone = (fPhone && fPhone.value || '').trim();
      var msg = (fMsg && fMsg.value || '').trim();

      // Strict validation: name, a valid email, a phone, and a message are all required.
      var firstBad = null;
      markInvalid(fName, false); markInvalid(fEmail, false); markInvalid(fPhone, false); markInvalid(fMsg, false);
      if (!name) { markInvalid(fName, true); firstBad = firstBad || fName; }
      if (!email || !isEmail(email)) { markInvalid(fEmail, true); firstBad = firstBad || fEmail; }
      if (!phone) { markInvalid(fPhone, true); firstBad = firstBad || fPhone; }
      if (!msg) { markInvalid(fMsg, true); firstBad = firstBad || fMsg; }

      if (firstBad) {
        if (firstBad.focus) firstBad.focus();
        alertBox({ icon: 'warning', title: T.requiredTitle || 'Missing details', text: T.required || 'Please complete all fields.' }, errBox, T.required);
        return;
      }

      var data = new FormData(form);
      data.append('action', 'bright_stars_lead');
      data.append('nonce', cfg.nonce || '');
      if (btn) { btn.disabled = true; btn.dataset.label = btn.textContent; btn.style.opacity = '.7'; }

      fetch(cfg.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          if (res && res.success) {
            form.reset();
            alertBox({ icon: 'success', title: T.thanksH || 'Request received', text: (res && res.data) || T.thanksSub || '' });
            if (okBox) { okBox.hidden = false; form.hidden = true; okBox.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
          } else {
            alertBox({ icon: 'error', title: T.errorTitle || 'Something went wrong', text: (res && res.data) || T.error || 'Please try again.' }, errBox, (res && res.data) || T.error);
          }
          if (btn) { btn.disabled = false; btn.style.opacity = ''; if (btn.dataset.label) btn.textContent = btn.dataset.label; }
        })
        .catch(function () {
          alertBox({ icon: 'error', title: T.errorTitle || 'Something went wrong', text: T.error || 'Please try again.' }, errBox, T.error);
          if (btn) { btn.disabled = false; btn.style.opacity = ''; if (btn.dataset.label) btn.textContent = btn.dataset.label; }
        });
    });
  }

  /* ---------- hero: count-up stats ---------- */
  function initCounters() {
    var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;
    var els = document.querySelectorAll('[data-count]');
    if (!els.length || reduce) return;
    function run(el) {
      var raw = el.textContent.trim();
      var m = raw.match(/^(\D*)([\d.,]+)(.*)$/);
      if (!m) return;
      var prefix = m[1], numStr = m[2].replace(/,/g, ''), suffix = m[3];
      var target = parseFloat(numStr);
      if (isNaN(target)) return;
      var decimals = (numStr.split('.')[1] || '').length;
      var t0 = null, dur = 1200;
      function step(ts) {
        if (!t0) t0 = ts;
        var p = Math.min(1, (ts - t0) / dur);
        var eased = 1 - Math.pow(1 - p, 3);
        var v = (target * eased).toFixed(decimals);
        el.textContent = prefix + Number(v).toLocaleString('en-US', { minimumFractionDigits: decimals, maximumFractionDigits: decimals }) + suffix;
        if (p < 1) requestAnimationFrame(step); else el.textContent = raw;
      }
      requestAnimationFrame(step);
    }
    if ('IntersectionObserver' in window) {
      var obs = new IntersectionObserver(function (es) {
        es.forEach(function (e) { if (e.isIntersecting) { run(e.target); obs.unobserve(e.target); } });
      }, { threshold: 0.4 });
      els.forEach(function (el) { obs.observe(el); });
    } else {
      els.forEach(run);
    }
  }

  /* ---------- hero: pointer parallax on the floating decor ---------- */
  function initParallax() {
    var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce) return;
    if (window.matchMedia && matchMedia('(pointer: coarse)').matches) return;
    var hero = document.querySelector('.bs-hero');
    var decor = hero && hero.querySelector('[data-parallax]');
    if (!hero || !decor || window.innerWidth < 1100) return;
    var raf = 0, tx = 0, ty = 0;
    function apply() { raf = 0; decor.style.transform = 'translate3d(' + tx.toFixed(1) + 'px,' + ty.toFixed(1) + 'px,0)'; }
    hero.addEventListener('mousemove', function (e) {
      var r = hero.getBoundingClientRect();
      tx = ((e.clientX - r.left) / r.width - 0.5) * 22;
      ty = ((e.clientY - r.top) / r.height - 0.5) * 18;
      if (!raf) raf = requestAnimationFrame(apply);
    });
    hero.addEventListener('mouseleave', function () { tx = 0; ty = 0; if (!raf) raf = requestAnimationFrame(apply); });
  }

  ready(function () {
    initLang();
    initMobile();
    initReveals();
    initScroll();
    initForm();
    initCounters();
    initParallax();
  });
})();
