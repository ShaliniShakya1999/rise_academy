/* =========================================================
   Rise Academy — Resume Editor
   Vanilla JS · live preview, autosave, drag-drop, zoom
   ========================================================= */
(function () {
    'use strict';

    const $  = (sel, root = document) => root.querySelector(sel);
    const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

    const BOOT = window.__RE_BOOT__ || null;
    if (!BOOT) return;

    // -------- State --------
    const state = {
        resumeId: BOOT.resumeId,
        title:    BOOT.title || 'Untitled Resume',
        templateId: BOOT.templateId || 1,
        sections: BOOT.sections || {},
        zoom: 0.62
    };

    // ============================================================
    // Sidebar nav highlighting (scroll spy)
    // ============================================================
    const cards    = $$('.re-card');
    const sideLinks = $$('.re-side-link');

    function setActiveSide(id) {
        sideLinks.forEach(a => a.classList.toggle('is-active', a.dataset.target === id));
    }

    sideLinks.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const id  = link.dataset.target;
            const card = document.getElementById('card-' + id);
            if (!card) return;
            card.setAttribute('data-open', 'true');
            card.scrollIntoView({ behavior: 'smooth', block: 'start' });
            setActiveSide(id);
        });
    });

    if ('IntersectionObserver' in window) {
        const obs = new IntersectionObserver(entries => {
            entries.forEach(en => {
                if (en.isIntersecting) {
                    const id = en.target.id.replace('card-', '');
                    setActiveSide(id);
                }
            });
        }, { rootMargin: '-30% 0px -55% 0px', threshold: 0 });
        cards.forEach(c => obs.observe(c));
    }

    // ============================================================
    // Collapsible cards
    // ============================================================
    $$('.re-card__head').forEach(head => {
        head.addEventListener('click', () => {
            const card = head.closest('.re-card');
            const isOpen = card.getAttribute('data-open') === 'true';
            card.setAttribute('data-open', isOpen ? 'false' : 'true');
        });
    });

    // ============================================================
    // Chips input (skills / tags)
    // ============================================================
    function initChips(wrap) {
        const input = wrap.querySelector('.re-chip-input');
        const key   = wrap.dataset.chipsKey;

        function render() {
            const arr = (state.sections.skills && state.sections.skills.items) || [];
            wrap.querySelectorAll('.re-chip').forEach(n => n.remove());
            arr.forEach((chip, idx) => {
                const value = typeof chip === 'string' ? chip : (chip.name || '');
                if (!value) return;
                const el = document.createElement('span');
                el.className = 're-chip';
                el.innerHTML =
                    '<span>' + escapeHtml(value) + '</span>' +
                    '<button type="button" aria-label="Remove"><i class="fa-solid fa-xmark"></i></button>';
                el.querySelector('button').addEventListener('click', () => {
                    const items = state.sections.skills.items;
                    items.splice(idx, 1);
                    render(); renderPreview(); scheduleSave();
                });
                wrap.insertBefore(el, input);
            });
        }

        function addValue(v) {
            v = (v || '').trim();
            if (!v) return;
            if (!state.sections.skills) state.sections.skills = { items: [], language_tags: [] };
            if (!Array.isArray(state.sections.skills.items)) state.sections.skills.items = [];
            state.sections.skills.items.push({ name: v });
            input.value = '';
            render(); renderPreview(); scheduleSave();
        }

        input.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                addValue(input.value);
            } else if (e.key === 'Backspace' && !input.value) {
                if (state.sections.skills && state.sections.skills.items.length) {
                    state.sections.skills.items.pop();
                    render(); renderPreview(); scheduleSave();
                }
            }
        });
        input.addEventListener('blur', () => addValue(input.value));

        render();
    }
    $$('.re-chips').forEach(initChips);

    // ============================================================
    // Repeater (Education / Experience / Projects / Certifications)
    // ============================================================
    function bindRepeaters() {
        $$('[data-repeater]').forEach(container => {
            const key      = container.dataset.repeater;
            const template = container.querySelector('template');
            const list     = container.querySelector('.re-repeater-list');
            const addBtn   = container.querySelector('.re-add-btn');

            if (!state.sections[key]) state.sections[key] = { items: [] };
            if (!Array.isArray(state.sections[key].items)) state.sections[key].items = [];

            function render() {
                list.innerHTML = '';
                const items = state.sections[key].items;
                if (items.length === 0) {
                    const empty = document.createElement('div');
                    empty.className = 're-empty';
                    empty.innerHTML =
                        '<div class="re-empty__icon"><i class="fa-solid fa-plus"></i></div>' +
                        '<p>No entries yet. Click "Add" to begin.</p>';
                    list.appendChild(empty);
                    return;
                }
                items.forEach((item, idx) => {
                    const node = template.content.firstElementChild.cloneNode(true);
                    node.querySelector('.re-item__num').textContent = '#' + (idx + 1);
                    node.querySelectorAll('[data-field]').forEach(input => {
                        const field = input.dataset.field;
                        input.value = item[field] || '';
                        input.addEventListener('input', () => {
                            item[field] = input.value;
                            renderPreview();
                            scheduleSave();
                        });
                    });
                    node.querySelector('.re-item__remove').addEventListener('click', () => {
                        items.splice(idx, 1);
                        render(); renderPreview(); scheduleSave();
                    });
                    list.appendChild(node);
                });
            }

            addBtn.addEventListener('click', () => {
                state.sections[key].items.push({});
                render(); scheduleSave();
            });

            render();
        });
    }
    bindRepeaters();

    // ============================================================
    // Simple field bindings (header, summary, social)
    // ============================================================
    $$('[data-bind]').forEach(input => {
        const path = input.dataset.bind.split('.');
        const get  = () => path.reduce((o, k) => (o && o[k] != null) ? o[k] : '', state.sections);
        input.value = get();
        input.addEventListener('input', () => {
            let o = state.sections;
            for (let i = 0; i < path.length - 1; i++) {
                const k = path[i];
                if (!o[k] || typeof o[k] !== 'object') o[k] = {};
                o = o[k];
            }
            o[path[path.length - 1]] = input.value;
            renderPreview();
            scheduleSave();
        });
    });

    // Title input
    const titleInput = $('#resumeTitle');
    if (titleInput) {
        titleInput.value = state.title;
        titleInput.addEventListener('input', () => {
            state.title = titleInput.value;
            scheduleSave();
        });
    }

    // ============================================================
    // Live Preview rendering
    // ============================================================
    const preview = $('#previewBody');

    function escapeHtml(str) {
        return String(str || '').replace(/[&<>"']/g, c => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
        }[c]));
    }
    function nl2br(str) { return escapeHtml(str).replace(/\n/g, '<br>'); }

    function renderPreview() {
        const s = state.sections;
        const h = s.header || {};
        const summary = (s.summary && s.summary.text) || '';

        let html = '';

        // Header
        html += '<div class="rp-head">';
        html +=   '<h1 class="rp-name">' + escapeHtml(h.name || 'Your Name') + '</h1>';
        if (h.role) html += '<div class="rp-role">' + escapeHtml(h.role) + '</div>';
        html +=   '<div class="rp-contact">';
        if (h.email)    html += '<span><i class="fa-solid fa-envelope"></i>' + escapeHtml(h.email) + '</span>';
        if (h.phone)    html += '<span><i class="fa-solid fa-phone"></i>' + escapeHtml(h.phone) + '</span>';
        if (h.location) html += '<span><i class="fa-solid fa-location-dot"></i>' + escapeHtml(h.location) + '</span>';
        if (h.website)  html += '<span><i class="fa-solid fa-globe"></i>' + escapeHtml(h.website) + '</span>';
        if (h.linkedin) html += '<span><i class="fa-brands fa-linkedin"></i>' + escapeHtml(h.linkedin) + '</span>';
        if (h.github)   html += '<span><i class="fa-brands fa-github"></i>' + escapeHtml(h.github) + '</span>';
        html +=   '</div>';
        html += '</div>';

        // Summary
        if (summary.trim()) {
            html += '<div class="rp-section">';
            html += '<h2>Profile Summary</h2>';
            html += '<p class="rp-summary">' + nl2br(summary) + '</p>';
            html += '</div>';
        }

        // Experience
        const expItems = (s.experience && s.experience.items) || [];
        if (expItems.some(notEmpty)) {
            html += '<div class="rp-section"><h2>Experience</h2>';
            expItems.forEach(it => {
                if (!notEmpty(it)) return;
                html += '<div class="rp-item">';
                html += '<div class="rp-item__row">';
                html += '<div><h3 class="rp-item__title">' + escapeHtml(it.title || '') + '</h3>';
                if (it.subtitle) html += '<div class="rp-item__sub">' + escapeHtml(it.subtitle) + '</div>';
                html += '</div>';
                if (it.period) html += '<span class="rp-item__date">' + escapeHtml(it.period) + '</span>';
                html += '</div>';
                if (it.description) html += '<p class="rp-item__desc">' + nl2br(it.description) + '</p>';
                html += '</div>';
            });
            html += '</div>';
        }

        // Education
        const eduItems = (s.education && s.education.items) || [];
        if (eduItems.some(notEmpty)) {
            html += '<div class="rp-section"><h2>Education</h2>';
            eduItems.forEach(it => {
                if (!notEmpty(it)) return;
                html += '<div class="rp-item">';
                html += '<div class="rp-item__row">';
                html += '<div><h3 class="rp-item__title">' + escapeHtml(it.title || '') + '</h3>';
                if (it.subtitle) html += '<div class="rp-item__sub">' + escapeHtml(it.subtitle) + '</div>';
                html += '</div>';
                if (it.period) html += '<span class="rp-item__date">' + escapeHtml(it.period) + '</span>';
                html += '</div>';
                if (it.description) html += '<p class="rp-item__desc">' + nl2br(it.description) + '</p>';
                html += '</div>';
            });
            html += '</div>';
        }

        // Skills
        const skillItems = (s.skills && s.skills.items) || [];
        if (skillItems.length) {
            html += '<div class="rp-section"><h2>Skills</h2>';
            html += '<div class="rp-skills">';
            skillItems.forEach(sk => {
                const name = typeof sk === 'string' ? sk : sk.name;
                if (name) html += '<span class="rp-skill">' + escapeHtml(name) + '</span>';
            });
            html += '</div></div>';
        }

        // Projects
        const projItems = (s.projects && s.projects.items) || [];
        if (projItems.some(notEmpty)) {
            html += '<div class="rp-section"><h2>Projects</h2>';
            projItems.forEach(it => {
                if (!notEmpty(it)) return;
                html += '<div class="rp-item">';
                html += '<div class="rp-item__row">';
                html += '<div><h3 class="rp-item__title">' + escapeHtml(it.title || '') + '</h3>';
                if (it.subtitle) html += '<div class="rp-item__sub">' + escapeHtml(it.subtitle) + '</div>';
                html += '</div>';
                if (it.period) html += '<span class="rp-item__date">' + escapeHtml(it.period) + '</span>';
                html += '</div>';
                if (it.description) html += '<p class="rp-item__desc">' + nl2br(it.description) + '</p>';
                html += '</div>';
            });
            html += '</div>';
        }

        // Certifications (stored under achievements)
        const certItems = (s.achievements && s.achievements.items) || [];
        if (certItems.some(notEmpty)) {
            html += '<div class="rp-section"><h2>Certifications & Achievements</h2>';
            certItems.forEach(it => {
                if (!notEmpty(it)) return;
                html += '<div class="rp-item">';
                html += '<div class="rp-item__row">';
                html += '<div><h3 class="rp-item__title">' + escapeHtml(it.title || '') + '</h3>';
                if (it.subtitle) html += '<div class="rp-item__sub">' + escapeHtml(it.subtitle) + '</div>';
                html += '</div>';
                if (it.dateLabel || it.period) html += '<span class="rp-item__date">' + escapeHtml(it.dateLabel || it.period) + '</span>';
                html += '</div>';
                if (it.description) html += '<p class="rp-item__desc">' + nl2br(it.description) + '</p>';
                html += '</div>';
            });
            html += '</div>';
        }

        preview.innerHTML = html;
        updateProgress();
    }

    function notEmpty(o) {
        if (!o || typeof o !== 'object') return false;
        return Object.values(o).some(v => v != null && String(v).trim() !== '');
    }

    // ============================================================
    // Progress bar
    // ============================================================
    function updateProgress() {
        const s = state.sections;
        const checks = [
            !!(s.header && s.header.name),
            !!(s.header && s.header.email),
            !!(s.header && s.header.phone),
            !!(s.summary && s.summary.text && s.summary.text.trim()),
            !!(s.experience && s.experience.items && s.experience.items.some(notEmpty)),
            !!(s.education && s.education.items && s.education.items.some(notEmpty)),
            !!(s.skills && s.skills.items && s.skills.items.length),
            !!(s.projects && s.projects.items && s.projects.items.some(notEmpty)),
            !!(s.achievements && s.achievements.items && s.achievements.items.some(notEmpty)),
            !!(s.header && (s.header.linkedin || s.header.github || s.header.website))
        ];
        const pct = Math.round((checks.filter(Boolean).length / checks.length) * 100);
        const fill = $('#progressFill');
        const txt  = $('#progressText');
        if (fill) fill.style.width = pct + '%';
        if (txt)  txt.textContent = pct + '%';
    }

    // ============================================================
    // Autosave
    // ============================================================
    const badge = $('#autosaveBadge');
    let saveTimer = null;

    function setBadge(state) {
        if (!badge) return;
        const icon = badge.querySelector('i');
        const text = badge.querySelector('.re-autosave__text');
        badge.classList.remove('is-saving', 'is-error');
        if (state === 'saving') {
            badge.classList.add('is-saving');
            icon.className = 'fa-solid fa-arrows-rotate';
            text.textContent = 'Saving…';
        } else if (state === 'error') {
            badge.classList.add('is-error');
            icon.className = 'fa-solid fa-triangle-exclamation';
            text.textContent = 'Save failed';
        } else {
            icon.className = 'fa-solid fa-circle-check';
            text.textContent = 'All changes saved';
        }
    }

    function scheduleSave() {
        clearTimeout(saveTimer);
        setBadge('saving');
        saveTimer = setTimeout(doSave, 900);
    }

    function doSave() {
        const payload = new FormData();
        payload.append('title', state.title);
        payload.append('template_id', state.templateId);
        payload.append('sections', JSON.stringify(state.sections));

        fetch(window.RE_BASE_URL + 'index.php/resume/save/' + state.resumeId, {
            method: 'POST',
            body: payload,
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(j => {
            if (j && j.ok) setBadge('saved');
            else setBadge('error');
        })
        .catch(() => setBadge('error'));
    }

    $('#btnSave')?.addEventListener('click', e => { e.preventDefault(); doSave(); });

    // ============================================================
    // Template switcher
    // ============================================================
    $('#templateSelect')?.addEventListener('change', e => {
        state.templateId = parseInt(e.target.value, 10) || 1;
        scheduleSave();
    });

    // ============================================================
    // Zoom controls
    // ============================================================
    const a4Wrap   = $('#a4Wrap');
    const zoomVal  = $('#zoomValue');

    function applyZoom() {
        if (a4Wrap)  a4Wrap.style.transform = 'scale(' + state.zoom + ')';
        if (zoomVal) zoomVal.textContent = Math.round(state.zoom * 100) + '%';
    }
    $('#zoomIn')?.addEventListener('click',  () => { state.zoom = Math.min(1.5, state.zoom + 0.1);  applyZoom(); });
    $('#zoomOut')?.addEventListener('click', () => { state.zoom = Math.max(0.4, state.zoom - 0.1);  applyZoom(); });
    $('#zoomReset')?.addEventListener('click', () => { state.zoom = 0.62; applyZoom(); });

    function autoFitZoom() {
        const canvas = $('#a4Canvas');
        if (!canvas || !a4Wrap) return;
        const cw = canvas.clientWidth - 56;
        const a4Width = 210 * 3.78;
        const fit = Math.min(1, cw / a4Width);
        state.zoom = Math.max(0.45, Math.min(0.85, fit));
        applyZoom();
    }
    window.addEventListener('resize', autoFitZoom);

    // ============================================================
    // Download PDF (print dialog)
    // ============================================================
    $('#btnDownload')?.addEventListener('click', e => {
        e.preventDefault();
        const prevZoom = state.zoom;
        state.zoom = 1;
        applyZoom();
        setTimeout(() => {
            window.print();
            state.zoom = prevZoom;
            applyZoom();
        }, 200);
    });

    // ============================================================
    // Mobile preview drawer
    // ============================================================
    const pane   = $('#previewPane');
    const toggle = $('#mobileToggle');
    toggle?.addEventListener('click', () => {
        pane.classList.toggle('is-open');
        const open = pane.classList.contains('is-open');
        toggle.innerHTML = open
            ? '<i class="fa-solid fa-xmark"></i>'
            : '<i class="fa-solid fa-eye"></i>';
    });

    // ============================================================
    // Drag-and-drop section ordering
    // ============================================================
    let dragSrc = null;
    cards.forEach(card => {
        card.setAttribute('draggable', 'true');
        const head = card.querySelector('.re-card__head');
        card.addEventListener('dragstart', e => {
            dragSrc = card;
            card.style.opacity = '0.4';
            e.dataTransfer.effectAllowed = 'move';
        });
        card.addEventListener('dragend', () => { card.style.opacity = ''; });
        card.addEventListener('dragover', e => { e.preventDefault(); e.dataTransfer.dropEffect = 'move'; });
        card.addEventListener('drop', e => {
            e.preventDefault();
            if (!dragSrc || dragSrc === card) return;
            const all = Array.from(card.parentNode.children);
            const srcIdx = all.indexOf(dragSrc);
            const tgtIdx = all.indexOf(card);
            if (srcIdx < tgtIdx) card.after(dragSrc); else card.before(dragSrc);
        });
    });

    // ============================================================
    // Initial render
    // ============================================================
    renderPreview();
    autoFitZoom();
    setBadge('saved');

    document.querySelector('.re-card')?.setAttribute('data-open', 'true');
})();
