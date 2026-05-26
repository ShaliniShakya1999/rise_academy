<?php
/**
 * User app sidebar " glass / gradient, collapsible (desktop), drawer (mobile).
 *
 * @var string $active                 e.g. dashboard, wishlist, profile
 * @var int|null $shell_avg_completion optional 0 - 100 for widget (dashboard)
 * @var int $wishlist_count             total saved wishlist items (from layout)
 */
$wishlist_count = isset($wishlist_count) ? (int) $wishlist_count : 0;
$active = isset($active) ? $active : 'dashboard';
$is_admin = (int) $this->session->userdata('role_id') === 1;

$nav = function ($key, $label, $href, $icon_svg, $badge = null) use ($active) {
    $is = ($active === $key);
    $cls = $is
        ? 'bg-white/20 backdrop-blur-sm text-white rounded-xl shadow-lg ring-2 ring-white/30'
        : 'text-white/75 hover:text-white hover:bg-white/5 rounded-lg transition-colors';
?>
    <a href="<?= $href; ?>"
       class="ra-dash-nav group flex w-full min-w-0 items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition duration-200 <?= $cls; ?>">
        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg <?= $is ? 'bg-gradient-to-br from-amber-500 to-amber-600 text-white' : 'bg-white/10 text-white/90'; ?>">
            <?= $icon_svg; ?>
        </span>
        <span class="ra-dash-nav__text min-w-0 flex-1 truncate"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></span>
        <?php if ($badge !== null && (int) $badge > 0): ?>
            <span class="ra-dash-nav__badge shrink-0 rounded-full bg-rose-500 px-2 py-0.5 text-[10px] font-bold text-white shadow"><?= (int) $badge; ?></span>
        <?php endif; ?>
    </a>
    <?php
};

$divider = function () {
    echo '<div class="my-3 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>';
};
?>

<aside x-data="{
    open: false,
    collapsed: (localStorage.getItem('ra_sidebar_collapsed') === '1'),
    toggleCollapse() {
        this.collapsed = !this.collapsed;
        localStorage.setItem('ra_sidebar_collapsed', this.collapsed ? '1' : '0');
    }
}"
       class="ra-user-sidebar fixed inset-y-0 left-0 z-[60] flex flex-col border-r border-white/10 bg-gradient-to-b from-zinc-950 via-zinc-900 to-zinc-950 text-white shadow-2xl shadow-black/40 transition-all duration-300 lg:static lg:z-0 lg:translate-x-0"
       :class="{
           '-translate-x-full': !open,
           'translate-x-0': open,
           'w-[280px]': !collapsed,
           'w-[76px]': collapsed,
           'lg:w-[280px]': !collapsed,
           'lg:w-[76px]': collapsed,
           'is-collapsed': collapsed
       }"
       @keydown.escape.window="open = false"
       @ra-open-sidebar.window="open = true">

    <div x-show="open" x-transition.opacity x-cloak
         class="fixed inset-0 z-[55] bg-slate-900/60 lg:hidden"
         @click="open = false"></div>

    <div class="flex h-14 shrink-0 items-center justify-between gap-2 border-b border-white/10 px-3 lg:h-16">
        <a href="<?= base_url('dashboard'); ?>" class="flex min-w-0 items-center gap-2 ra-dash-nav__text">
            <img src="<?= base_url('assets/website/images/logo.png'); ?>" alt="Logo" class="h-8 w-auto object-contain" style="filter: invert(1) hue-rotate(180deg) saturate(2.5) brightness(1.2);" onerror="this.style.display='none'; this.nextElementSibling.removeAttribute('style');">
            <span class="font-bold text-lg text-white" style="display: none;">Internmo</span>
        </a>
        <button type="button" @click="toggleCollapse()" class="hidden lg:grid h-9 w-9 place-items-center rounded-lg bg-white/5 text-white/70 hover:bg-white/10 hover:text-white transition" title="Collapse sidebar">
            <svg class="w-5 h-5 transition" :class="collapsed ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <button type="button" class="lg:hidden grid h-9 w-9 place-items-center rounded-lg bg-white/10" @click="open = false" aria-label="Close menu">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-2 py-4 space-y-0.5">
        <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-widest text-white/40 ra-dash-nav__text" x-show="!collapsed">Main</p>

        <?php
        $icoDash = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>';
        $icoFile = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>';
        $icoPlus = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>';
        $icoGrid = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>';
        $icoHeart = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>';
        $icoCheck = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>';
        $icoMail = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>';
        $icoDown = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>';
        $icoDraft = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>';
        $icoUser = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>';
        $icoGear = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>';
        $icoShield = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>';
        $icoOut = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>';

        $nav('dashboard', 'Dashboard', base_url('dashboard'), $icoDash);
        $nav('resumes', 'My Resumes', base_url('dashboard#your-resumes'), $icoFile);
        $nav('create', 'Create Resume', base_url('resume/create/1'), $icoPlus);
        $nav('templates', 'Templates', base_url('templates'), $icoGrid);

        $divider();

        $nav('wishlist', 'Wishlist', base_url('wishlist'), $icoHeart, $wishlist_count);
        $nav('checker', 'ATS Checker', base_url('resume-checker'), $icoCheck);
        $nav('cover', 'Cover Letter', base_url('cover-letter'), $icoMail);
        $nav('downloads', 'Downloads', base_url('dashboard#downloads'), $icoDown);
        $nav('drafts', 'Saved Drafts', base_url('dashboard#your-resumes'), $icoDraft);

        $divider();

        $nav('profile', 'Profile', base_url('profile'), $icoUser);
        $nav('settings', 'Settings', base_url('account/settings'), $icoGear);

        if ($is_admin) {
            $nav('admin', 'Admin Panel', base_url('admin'), $icoShield);
        }
        ?>

        <div class="mt-4 rounded-xl bg-white/5 p-3 ring-1 ring-white/10" x-show="!collapsed">
            <?php if (isset($shell_avg_completion) && $shell_avg_completion !== null): ?>
                <p class="text-[10px] font-bold uppercase tracking-wider text-white/45">Resume completion</p>
                <div class="mt-2 h-2 overflow-hidden rounded-full bg-black/30">
                    <div class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-teal-400 transition-all duration-500" style="width: <?= max(0, min(100, (int) $shell_avg_completion)); ?>%"></div>
                </div>
                <p class="mt-1.5 text-lg font-display font-extrabold text-white"><?= (int) $shell_avg_completion; ?>%</p>
            <?php else: ?>
                <p class="text-[10px] font-bold uppercase tracking-wider text-white/45">Quick tip</p>
                <p class="mt-1 text-xs leading-relaxed text-white/70">Use the ATS Checker before you apply " it helps catch formatting issues early.</p>
            <?php endif; ?>
        </div>
    </nav>

    <div class="shrink-0 border-t border-white/10 p-2 space-y-1">
        <button type="button"
                @click="
                    document.documentElement.classList.toggle('dark');
                    localStorage.setItem('ra_dark', document.documentElement.classList.contains('dark') ? '1' : '0');
                "
                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium text-white/75 transition hover:bg-white/10 hover:text-white ra-dash-nav__text"
                x-show="!collapsed">
            <span class="grid h-9 w-9 place-items-center rounded-lg bg-white/10">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </span>
            <span>Dark mode</span>
        </button>
        <button type="button"
                @click="
                    document.documentElement.classList.toggle('dark');
                    localStorage.setItem('ra_dark', document.documentElement.classList.contains('dark') ? '1' : '0');
                "
                class="w-full items-center justify-center rounded-xl py-2 text-white/75 transition hover:bg-white/10 hidden"
                :class="collapsed ? 'flex' : 'hidden'"
                title="Dark mode">
            <span class="grid h-9 w-9 place-items-center rounded-lg bg-white/10">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </span>
        </button>

        <?php $nav('logout', 'Logout', base_url('logout'), $icoOut); ?>
    </div>
</aside>

<!-- Mobile sidebar open button (injected placement via layout) -->




