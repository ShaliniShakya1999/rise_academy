<div class="mx-auto w-full max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-950 dark:text-indigo-300">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        </div>
        <h1 class="mt-4 font-display text-2xl font-extrabold text-slate-900 dark:text-white"><?= htmlspecialchars(isset($section_title) ? $section_title : 'Admin', ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="mt-2 text-slate-600 dark:text-slate-400">This section is scaffolded for the next phase. You can wire CRUD, charts, and filters here.</p>
        <a href="<?= base_url('admin'); ?>" class="mt-6 inline-flex rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-700">Back to overview</a>
    </div>
</div>
