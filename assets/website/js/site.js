/* Rise Academy — global JS hooks (Alpine.js handles most interactivity) */

(function () {
    'use strict';

    /* ------------------------------------------------------------------
     * Wishlist save buttons — graceful AJAX toggle with fallback
     * Falls back to plain form POST when JS is disabled or unavailable.
     * ------------------------------------------------------------------ */
    document.addEventListener('submit', function (e) {
        const form = e.target.closest('.ra-wish-form');
        if (!form) return;

        e.preventDefault();

        const btn = form.querySelector('.ra-wish-btn');
        if (!btn || btn.dataset.busy === '1') return;
        btn.dataset.busy = '1';
        btn.classList.add('ra-wish-busy');

        const fd = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: fd,
            credentials: 'same-origin',
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function (res) {
            if (res.status === 401) {
                return res.json().then(function (j) {
                    if (j && j.login_url) window.location.href = j.login_url;
                    else window.location.href = (window.RA_BASE_URL || '/') + 'login';
                });
            }
            return res.json().then(function (j) {
                if (!j || !j.ok) {
                    form.submit();
                    return;
                }
                applyWishState(btn, !!j.saved);
                showToast(j.saved ? 'Added to your wishlist' : 'Removed from your wishlist', j.saved ? 'ok' : 'info');
            });
        })
        .catch(function () { form.submit(); })
        .finally(function () {
            btn.dataset.busy = '0';
            btn.classList.remove('ra-wish-busy');
        });
    });

    function applyWishState(btn, saved) {
        const svg = btn.querySelector('svg');
        btn.classList.toggle('ra-wish-saved', saved);
        btn.classList.toggle('bg-rose-50', saved);
        btn.classList.toggle('border-rose-200', saved);
        btn.classList.toggle('text-rose-600', saved);
        btn.classList.toggle('bg-white', !saved);
        btn.classList.toggle('border-slate-200', !saved);
        btn.classList.toggle('text-slate-400', !saved);
        btn.classList.toggle('hover:text-rose-500', !saved);
        btn.classList.toggle('hover:border-rose-300', !saved);
        btn.setAttribute('title', saved ? 'Saved — click to remove' : 'Save to wishlist');
        if (svg) svg.setAttribute('fill', saved ? 'currentColor' : 'none');
        btn.classList.remove('ra-wish-pop'); void btn.offsetWidth; btn.classList.add('ra-wish-pop');
    }

    function showToast(message, kind) {
        let host = document.getElementById('ra-toast-host');
        if (!host) {
            host = document.createElement('div');
            host.id = 'ra-toast-host';
            host.style.cssText = 'position:fixed;bottom:24px;left:50%;transform:translateX(-50%);z-index:9999;display:flex;flex-direction:column;gap:8px;align-items:center;pointer-events:none;';
            document.body.appendChild(host);
        }
        const t = document.createElement('div');
        const bg = kind === 'ok'
            ? 'linear-gradient(135deg,#10b981,#059669)'
            : 'linear-gradient(135deg,#475569,#1e293b)';
        t.style.cssText = 'background:' + bg + ';color:#fff;padding:10px 18px;border-radius:999px;font:600 13px/1.2 system-ui,sans-serif;box-shadow:0 16px 36px rgba(15,23,42,.25);opacity:0;transform:translateY(8px);transition:.3s cubic-bezier(.4,0,.2,1);pointer-events:auto;display:inline-flex;align-items:center;gap:8px;';
        t.innerHTML = '<span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#fff;opacity:.85"></span>' + message;
        host.appendChild(t);
        requestAnimationFrame(function () {
            t.style.opacity = '1';
            t.style.transform = 'translateY(0)';
        });
        setTimeout(function () {
            t.style.opacity = '0';
            t.style.transform = 'translateY(8px)';
            setTimeout(function () { t.remove(); }, 320);
        }, 2200);
    }
})();
