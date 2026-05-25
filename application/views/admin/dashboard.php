<?php
/** @var array $stats */
$s = $stats + ['users' => 0, 'resumes' => 0, 'templates' => 0, 'jobs' => 0];
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-indigo-400">Admin</p>
            <h1 class="font-display text-3xl font-extrabold text-slate-900 dark:text-white">Overview</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Live counts from your database.</p>
        </div>
        <a href="<?= base_url('dashboard'); ?>" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-800 shadow-sm transition hover:border-indigo-400 hover:text-indigo-700 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">
            Open user dashboard
        </a>
    </div>

    <div class="mt-10 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="group relative overflow-hidden rounded-2xl bg-slate-900 p-6 text-white shadow-xl transition duration-300 hover:-translate-y-0.5 hover:shadow-2xl">
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-white/10 blur-2xl transition group-hover:bg-white/15"></div>
            <div class="relative flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-white/60">Users</p>
                    <p class="mt-2 font-display text-4xl font-extrabold"><?= (int) $s['users']; ?></p>
                </div>
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 shadow-lg">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
            </div>
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-slate-900 p-6 text-white shadow-xl transition duration-300 hover:-translate-y-0.5 hover:shadow-2xl">
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-violet-500/20 blur-2xl transition group-hover:bg-violet-500/30"></div>
            <div class="relative flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-white/60">Resumes</p>
                    <p class="mt-2 font-display text-4xl font-extrabold"><?= (int) $s['resumes']; ?></p>
                </div>
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 shadow-lg">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </span>
            </div>
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-slate-900 p-6 text-white shadow-xl transition duration-300 hover:-translate-y-0.5 hover:shadow-2xl">
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-emerald-500/20 blur-2xl transition group-hover:bg-emerald-500/30"></div>
            <div class="relative flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-white/60">Active templates</p>
                    <p class="mt-2 font-display text-4xl font-extrabold"><?= (int) $s['templates']; ?></p>
                </div>
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-lg">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                </span>
            </div>
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-slate-900 p-6 text-white shadow-xl transition duration-300 hover:-translate-y-0.5 hover:shadow-2xl">
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-amber-500/20 blur-2xl transition group-hover:bg-amber-500/30"></div>
            <div class="relative flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-white/60">Jobs</p>
                    <p class="mt-2 font-display text-4xl font-extrabold"><?= (int) $s['jobs']; ?></p>
                </div>
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 shadow-lg">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                </span>
            </div>
        </div>
    </div>

    <div class="mt-10 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <h2 class="font-display text-lg font-bold text-slate-900 dark:text-white">Quick links</h2>
        <div class="mt-4 flex flex-wrap gap-2">
            <a href="<?= base_url('admin/users'); ?>" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-800 transition hover:bg-indigo-100 hover:text-indigo-800 dark:bg-slate-700 dark:text-slate-100 dark:hover:bg-indigo-900/40">Users</a>
            <a href="<?= base_url('admin/resumes'); ?>" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-800 transition hover:bg-indigo-100 hover:text-indigo-800 dark:bg-slate-700 dark:text-slate-100 dark:hover:bg-indigo-900/40">Resumes</a>
            <a href="<?= base_url('admin/templates'); ?>" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-800 transition hover:bg-indigo-100 hover:text-indigo-800 dark:bg-slate-700 dark:text-slate-100 dark:hover:bg-indigo-900/40">Templates</a>
        </div>
    </div>
</div>




