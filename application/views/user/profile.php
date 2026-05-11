<div class="mx-auto w-full max-w-3xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <div class="rounded-3xl border border-slate-200/80 bg-white p-8 shadow-xl shadow-slate-200/50 ring-1 ring-slate-100 dark:border-slate-800 dark:bg-slate-900 dark:shadow-none dark:ring-slate-800">
        <div class="flex items-center gap-4">
            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-violet-600 to-indigo-600 text-2xl font-display font-extrabold text-white shadow-lg shadow-violet-500/30">
                <?= strtoupper(substr((string) $this->session->userdata('full_name'), 0, 1)); ?>
            </div>
            <div>
                <h1 class="font-display text-2xl font-extrabold text-slate-900 dark:text-white">Profile</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Account overview</p>
            </div>
        </div>
        <dl class="mt-8 space-y-4 border-t border-slate-100 pt-8 dark:border-slate-800">
            <div class="flex flex-col gap-1 sm:flex-row sm:justify-between">
                <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Full name</dt>
                <dd class="text-sm font-semibold text-slate-900 dark:text-slate-100"><?= htmlspecialchars((string) $this->session->userdata('full_name'), ENT_QUOTES, 'UTF-8'); ?></dd>
            </div>
            <div class="flex flex-col gap-1 sm:flex-row sm:justify-between">
                <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Email</dt>
                <dd class="text-sm font-semibold text-slate-900 dark:text-slate-100"><?= htmlspecialchars((string) $this->session->userdata('email'), ENT_QUOTES, 'UTF-8'); ?></dd>
            </div>
        </dl>
        <p class="mt-8 rounded-xl bg-violet-50 px-4 py-3 text-sm text-violet-900 dark:bg-violet-950/40 dark:text-violet-200">
            Profile editing (photo, phone, password) will be available in a future update.
        </p>
    </div>
</div>
