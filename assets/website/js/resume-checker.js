/**
 * Internmo â€” Resume Checker page interactions (vanilla JS)
 */
(function () {
  'use strict';

  var MAX_FILE_BYTES = 10 * 1024 * 1024;
  var ALLOWED_EXT = ['pdf', 'doc', 'docx'];
  var JD_MAX = 5000;

  var state = {
    file: null,
    analyzing: false,
  };

  function $(sel, root) {
    return (root || document).querySelector(sel);
  }

  function $$(sel, root) {
    return Array.prototype.slice.call((root || document).querySelectorAll(sel));
  }

  function formatBytes(n) {
    if (n < 1024) return n + ' B';
    if (n < 1048576) return (n / 1024).toFixed(1) + ' KB';
    return (n / 1048576).toFixed(2) + ' MB';
  }

  function extOf(name) {
    var i = name.lastIndexOf('.');
    return i >= 0 ? name.slice(i + 1).toLowerCase() : '';
  }

  function validateFile(file) {
    if (!file) return 'No file selected.';
    if (file.size > MAX_FILE_BYTES) return 'File must be under 10 MB.';
    var ext = extOf(file.name);
    if (ALLOWED_EXT.indexOf(ext) === -1) return 'Only PDF, DOC, or DOCX files are allowed.';
    return null;
  }

  function setProgress(pct) {
    var wrap = $('#ra-rc-progress-wrap');
    var bar = $('#ra-rc-progress-bar');
    if (!wrap || !bar) return;
    wrap.classList.add('ra-rc--visible');
    bar.style.width = Math.min(100, Math.max(0, pct)) + '%';
  }

  function hideProgress() {
    var wrap = $('#ra-rc-progress-wrap');
    var bar = $('#ra-rc-progress-bar');
    if (wrap) wrap.classList.remove('ra-rc--visible');
    if (bar) bar.style.width = '0%';
  }

  function showFilePreview(file) {
    var prev = $('#ra-rc-file-preview');
    var nameEl = $('#ra-rc-preview-filename');
    var sizeEl = $('#ra-rc-preview-filesize');
    var asideName = $('#ra-rc-aside-filename');
    var asideSize = $('#ra-rc-aside-size');
    var asideDate = $('#ra-rc-aside-date');
    if (!prev) return;
    prev.classList.add('ra-rc--visible');
    if (nameEl) nameEl.textContent = file.name;
    if (sizeEl) sizeEl.textContent = formatBytes(file.size);
    if (asideName) asideName.textContent = file.name;
    if (asideSize) asideSize.textContent = formatBytes(file.size);
    if (asideDate) asideDate.textContent = new Date().toLocaleString();
  }

  function clearFilePreview() {
    var prev = $('#ra-rc-file-preview');
    if (prev) prev.classList.remove('ra-rc--visible');
    hideProgress();
  }

  function animateValue(el, end, duration, suffix) {
    suffix = suffix || '';
    if (!el) return;
    var start = 0;
    var t0 = null;
    function frame(ts) {
      if (!t0) t0 = ts;
      var p = Math.min(1, (ts - t0) / duration);
      var eased = 1 - Math.pow(1 - p, 3);
      var val = Math.round(start + (end - start) * eased);
      el.textContent = val + suffix;
      if (p < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  function setRingPercent(pct) {
    var ring = $('#ra-rc-ring-fg');
    if (!ring) return;
    var r = 54;
    var c = 2 * Math.PI * r;
    ring.style.strokeDasharray = String(c);
    ring.style.strokeDashoffset = String(c * (1 - pct / 100));
  }

  function runLoadingSteps(onDone) {
    var overlay = $('#ra-rc-loading');
    var stepEl = $('#ra-rc-loading-step');
    var steps = [
      'Reading resumeâ€¦',
      'Extracting skillsâ€¦',
      'Matching keywordsâ€¦',
      'Calculating ATS scoreâ€¦',
      'Generating suggestionsâ€¦',
    ];
    var i = 0;
    if (overlay) overlay.classList.add('ra-rc--visible');
    function tick() {
      if (stepEl) stepEl.textContent = steps[Math.min(i, steps.length - 1)];
      i++;
      if (i <= steps.length) {
        setTimeout(tick, i === 1 ? 400 : 700);
      } else {
        setTimeout(function () {
          if (overlay) overlay.classList.remove('ra-rc--visible');
          onDone();
        }, 400);
      }
    }
    tick();
  }

  function animateInt(el, end, duration) {
    if (!el) return;
    var start = 0;
    var t0 = null;
    function frame(ts) {
      if (!t0) t0 = ts;
      var p = Math.min(1, (ts - t0) / duration);
      var eased = 1 - Math.pow(1 - p, 3);
      var val = Math.round(start + (end - start) * eased);
      el.textContent = val.toLocaleString();
      if (p < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  function applyDemoResults() {
    var jd = ($('#ra-rc-jobdesc') && $('#ra-rc-jobdesc').value) || '';
    var hasJd = jd.trim().length > 40;
    var base = hasJd ? 12 : 0;
    var ats = 58 + base + Math.floor(Math.random() * 15);
    ats = Math.min(94, Math.max(38, ats));

    var results = $('#ra-rc-results');
    if (results) results.classList.add('ra-rc--visible');

    if ($('#ra-rc-ats-num')) $('#ra-rc-ats-num').textContent = '0%';
    setRingPercent(0);

    requestAnimationFrame(function () {
      animateValue($('#ra-rc-ats-num'), ats, 1200, '%');
      setTimeout(function () {
        setRingPercent(ats);
      }, 50);
    });

    animateValue($('#ra-rc-val-grammar'), 72 + (hasJd ? 8 : 0), 1000, '%');
    animateValue($('#ra-rc-val-skills'), 64 + base, 1000, '%');
    animateValue($('#ra-rc-val-exp'), 70 + (hasJd ? 5 : 0), 1000, '%');
    animateValue($('#ra-rc-val-format'), 81, 1000, '%');

    animateInt($('#ra-rc-stat-1'), 12847 + Math.floor(Math.random() * 400), 1600);
    animateValue($('#ra-rc-stat-2'), 94, 1200, '%');
    animateInt($('#ra-rc-stat-3'), 38 + Math.floor(Math.random() * 8), 1400);
    animateInt($('#ra-rc-stat-4'), 12 + Math.floor(Math.random() * 5), 1000);

    var weak = $('#ra-rc-weakness');
    if (weak) {
      weak.textContent = hasJd
        ? 'Some high-value keywords from the job description are missing or buried in dense paragraphs. Consider mirroring exact phrases in your skills and experience bullets.'
        : 'Without a job description, keyword alignment is generic. Paste a JD for precise gap analysis and stronger ATS matching.';
    }

    $$('.ra-rc-reveal').forEach(function (el) {
      el.classList.add('ra-rc-reveal--visible');
    });
  }

  function simulateUpload(cb) {
    var p = 0;
    setProgress(0);
    var id = setInterval(function () {
      p += Math.random() * 18 + 5;
      if (p >= 100) {
        p = 100;
        setProgress(100);
        clearInterval(id);
        setTimeout(function () {
          hideProgress();
          cb();
        }, 350);
      } else {
        setProgress(p);
      }
    }, 120);
  }

  function bindDropzone() {
    var zone = $('#ra-rc-dropzone');
    var input = $('#ra-rc-file');
    if (!zone || !input) return;

    zone.addEventListener('click', function () {
      if (!state.analyzing) input.click();
    });

    ['dragenter', 'dragover'].forEach(function (ev) {
      zone.addEventListener(ev, function (e) {
        e.preventDefault();
        e.stopPropagation();
        zone.classList.add('ra-rc-dropzone--active');
      });
    });

    ['dragleave', 'drop'].forEach(function (ev) {
      zone.addEventListener(ev, function (e) {
        e.preventDefault();
        e.stopPropagation();
        zone.classList.remove('ra-rc-dropzone--active');
      });
    });

    zone.addEventListener('drop', function (e) {
      var files = e.dataTransfer && e.dataTransfer.files;
      if (files && files[0]) handleFile(files[0]);
    });

    zone.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        if (!state.analyzing) input.click();
      }
    });

    input.addEventListener('change', function () {
      if (input.files && input.files[0]) handleFile(input.files[0]);
    });
  }

  function handleFile(file) {
    var err = validateFile(file);
    if (err) {
      alert(err);
      return;
    }
    state.file = file;
    showFilePreview(file);
    var btnAnalyze = $('#ra-rc-btn-analyze');
    if (btnAnalyze) btnAnalyze.disabled = false;
    simulateUpload(function () {});
  }

  function bindJobDesc() {
    var ta = $('#ra-rc-jobdesc');
    var ctr = $('#ra-rc-jd-count');
    if (!ta || !ctr) return;
    function sync() {
      var len = ta.value.length;
      if (len > JD_MAX) {
        ta.value = ta.value.slice(0, JD_MAX);
        len = JD_MAX;
      }
      ctr.textContent = len + ' / ' + JD_MAX;
    }
    ta.addEventListener('input', sync);
    sync();
  }

  function bindAnalyze() {
    var btn = $('#ra-rc-btn-analyze');
    if (!btn) return;
    btn.addEventListener('click', function () {
      if (!state.file) {
        alert('Please upload a resume first (PDF, DOC, or DOCX).');
        return;
      }
      if (state.analyzing) return;
      state.analyzing = true;
      btn.disabled = true;
      runLoadingSteps(function () {
        state.analyzing = false;
        btn.disabled = false;
        applyDemoResults();
        var aside = document.querySelector('.ra-rc-preview');
        if (aside) aside.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      });
    });
  }

  function bindHeroButtons() {
    var upload = $('#ra-rc-hero-upload');
    var check = $('#ra-rc-hero-check');
    var input = $('#ra-rc-file');
    if (upload && input) {
      upload.addEventListener('click', function (e) {
        e.preventDefault();
        input.click();
      });
    }
    if (check) {
      check.addEventListener('click', function (e) {
        e.preventDefault();
        var dz = $('#ra-rc-dropzone');
        if (dz) dz.scrollIntoView({ behavior: 'smooth', block: 'center' });
        if (!state.file && input) setTimeout(function () { input.click(); }, 400);
      });
    }
  }

  function bindDownload() {
    var btn = $('#ra-rc-btn-download');
    if (!btn) return;
    btn.addEventListener('click', function () {
      var ats = ($('#ra-rc-ats-num') && $('#ra-rc-ats-num').textContent) || 'â€”';
      var name = state.file ? state.file.name : 'resume';
      var body =
        'Internmo â€” ATS Resume Report\n' +
        '================================\n\n' +
        'File: ' + name + '\n' +
        'ATS score: ' + ats + '\n\n' +
        'This is a demo export. Connect backend processing for full AI analysis.\n';
      var blob = new Blob([body], { type: 'text/plain;charset=utf-8' });
      var a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = 'internmo-ats-report.txt';
      a.click();
      URL.revokeObjectURL(a.href);
    });
  }

  function bindReupload() {
    var btn = $('#ra-rc-btn-reupload');
    var input = $('#ra-rc-file');
    if (!btn || !input) return;
    btn.addEventListener('click', function () {
      state.file = null;
      input.value = '';
      clearFilePreview();
      var res = $('#ra-rc-results');
      if (res) res.classList.remove('ra-rc--visible');
      var analyze = $('#ra-rc-btn-analyze');
      if (analyze) analyze.disabled = true;
      setRingPercent(0);
      if ($('#ra-rc-ats-num')) $('#ra-rc-ats-num').textContent = '0%';
      ['ra-rc-val-grammar', 'ra-rc-val-skills', 'ra-rc-val-exp', 'ra-rc-val-format'].forEach(function (id) {
        var el = document.getElementById(id);
        if (el) el.textContent = '0';
      });
      if ($('#ra-rc-stat-1')) $('#ra-rc-stat-1').textContent = '0';
      if ($('#ra-rc-stat-2')) $('#ra-rc-stat-2').textContent = '0%';
      if ($('#ra-rc-stat-3')) $('#ra-rc-stat-3').textContent = '0';
      if ($('#ra-rc-stat-4')) $('#ra-rc-stat-4').textContent = '0';
      $$('.ra-rc-reveal').forEach(function (el) {
        el.classList.remove('ra-rc-reveal--visible');
      });
      var dz = $('#ra-rc-dropzone');
      if (dz) dz.scrollIntoView({ behavior: 'smooth', block: 'center' });
      input.click();
    });
  }

  function bindImprove() {
    var btns = $$('[data-scroll-improve]');
    btns.forEach(function (b) {
      b.addEventListener('click', function (e) {
        e.preventDefault();
        var target = $('#ra-rc-suggestions');
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  }

  function bindRecheck() {
    var btn = $('#ra-rc-btn-recheck');
    if (!btn) return;
    btn.addEventListener('click', function () {
      if (!state.file) {
        alert('Upload a resume first.');
        return;
      }
      if (state.analyzing) return;
      state.analyzing = true;
      btn.disabled = true;
      runLoadingSteps(function () {
        state.analyzing = false;
        btn.disabled = false;
        applyDemoResults();
      });
    });
  }

  function initScrollReveal() {
    var els = $$('.ra-rc-reveal');
    if (!('IntersectionObserver' in window)) {
      els.forEach(function (el) { el.classList.add('ra-rc-reveal--visible'); });
      return;
    }
    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) {
            en.target.classList.add('ra-rc-reveal--visible');
            io.unobserve(en.target);
          }
        });
      },
      { rootMargin: '0px 0px -8% 0px', threshold: 0.08 }
    );
    els.forEach(function (el) { io.observe(el); });
  }

  function onReady(fn) {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', fn);
    } else {
      fn();
    }
  }

  onReady(function () {
    bindDropzone();
    bindJobDesc();
    bindAnalyze();
    bindHeroButtons();
    bindDownload();
    bindReupload();
    bindImprove();
    bindRecheck();
    initScrollReveal();
    setRingPercent(0);
  });
})();




