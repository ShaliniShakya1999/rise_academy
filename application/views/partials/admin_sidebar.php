<?php
/**
 * Admin workspace sidebar (management-focused).
 *
 * @var string $active e.g. admin, users, resumes, templates, reports, settings
 */
$active = isset($active) ? $active : 'admin';

$link = function ($key, $label, $href, $icon) use ($active) {
    $on = ($active === $key);
    $cls = $on
        ? 'bg-brand-500/25 text-white ring-1 ring-brand-400/40 shadow-lg shadow-brand-950/30'
        : 'text-slate-300 hover:bg-white/5 hover:text-white';
    ?>
    <a href="<?= $href; ?>" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition <?= $cls; ?>">
        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg <?= $on ? 'bg-brand-600 text-white' : 'bg-slate-800 text-slate-400'; ?>">
            <?= $icon; ?>
        </span>
        <span class="truncate"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></span>
    </a>
    <?php
};

$sep = function () {
    echo '<div class="my-2 h-px bg-gradient-to-r from-transparent via-slate-600/80 to-transparent"></div>';
};

$iDash = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>';
$iChart = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>';
$iUsers = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>';
$iFile = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>';
$iGrid = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>';
$iDoc = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/></svg>';
$iPay = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>';
$iGear = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>';
$iShield = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>';
$iOut = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>';
?>

<aside x-data="{
    open: false,
    collapsed: (localStorage.getItem('ra_admin_sb') === '1'),
    toggleCollapse() {
        this.collapsed = !this.collapsed;
        localStorage.setItem('ra_admin_sb', this.collapsed ? '1' : '0');
    }
}"
       class="ra-admin-sidebar fixed inset-y-0 left-0 z-[60] flex flex-col border-r border-slate-700/80 bg-gradient-to-b from-[#050A34] via-[#092676] to-[#050A34] text-white shadow-2xl transition-all duration-300 lg:static lg:z-0 lg:translate-x-0"
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
       @ra-open-admin-sidebar.window="open = true">

    <div x-show="open" x-transition.opacity x-cloak class="fixed inset-0 z-[55] bg-slate-900/70 lg:hidden" @click="open = false"></div>

    <div class="flex h-14 shrink-0 items-center justify-between border-b border-slate-700/80 px-3 lg:h-16">
        <a href="<?= base_url('admin'); ?>" class="flex min-w-0 items-center gap-2">
            <img src="<?= base_url('assets/website/images/rise_logo.png'); ?>" alt="Rise Academy Admin" class="h-8 w-auto brightness-0 invert" x-show="!collapsed">
            <img src="<?= base_url('assets/website/images/rise_logo.png'); ?>" alt="A" class="h-8 w-8 object-left overflow-hidden" x-show="collapsed">
        </a>
        <button type="button" class="hidden h-9 w-9 place-items-center rounded-lg bg-slate-800 text-slate-300 hover:bg-slate-700 lg:grid"
                @click="toggleCollapse()" title="Collapse sidebar">
            <svg class="h-5 w-5 transition-transform" :class="collapsed ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <button type="button" class="grid h-9 w-9 place-items-center rounded-lg bg-slate-800 lg:hidden" @click="open = false" aria-label="Close">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
    </div>

    <nav class="flex-1 space-y-0.5 overflow-y-auto px-2 py-4">
        <p class="ra-admin-nav__txt px-3 pb-2 text-[10px] font-bold uppercase tracking-widest text-slate-500" x-show="!collapsed">Menu</p>
        <?php
        $link('admin', 'Dashboard', base_url('admin'), $iDash);
        $link('analytics', 'Analytics', base_url('admin/analytics'), $iChart);
        $sep();
        $link('users', 'Users', base_url('admin/users'), $iUsers);
        $link('resumes', 'Resumes', base_url('admin/resumes'), $iFile);
        $link('templates', 'Templates', base_url('admin/templates'), $iGrid);
        $sep();
        $link('content', 'Content', base_url('admin/content'), $iDoc);
        $link('ai', 'AI Tools', base_url('admin/ai'), $iChart);
        $link('subscriptions', 'Subscriptions', base_url('admin/subscriptions'), $iPay);
        $sep();
        $link('reports', 'Reports', base_url('admin/reports'), $iChart);
        $link('settings', 'Settings', base_url('admin/settings'), $iGear);
        $link('security', 'Security Logs', base_url('admin/security'), $iShield);
        ?>
    </nav>

    <div class="shrink-0 space-y-1 border-t border-slate-700/80 p-2">
        <a href="<?= base_url('dashboard'); ?>" class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white">
            <span class="grid h-9 w-9 place-items-center rounded-lg bg-slate-800">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
            </span>
            <span class="ra-admin-nav__txt" x-show="!collapsed">User site</span>
        </a>
        <?php $link('logout', 'Logout', base_url('logout'), $iOut); ?>
    </div>
</aside>
