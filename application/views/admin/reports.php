<?php
/**
 * Admin → Reports
 *
 * @var array $downloads
 * @var array $top_users
 * @var array $stats
 */
$initial = function ($name) {
    $name = trim((string) $name);
    if ($name === '') return '?';
    $parts = preg_split('/\s+/', $name);
    return strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
};
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <?php $this->load->view('admin/_header', [
        'eyebrow' => 'Admin',
        'title'   => 'Reports',
        'desc'    => 'Resume downloads, exports, and top contributors.',
    ]); ?>

    <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <?php
        $cards = [
            ['Total downloads', (int) $stats['total_downloads'], 'from-violet-500 to-fuchsia-500'],
            ['PDF downloads',   (int) $stats['pdf_downloads'],   'from-rose-500 to-pink-500'],
            ['Last 30 days',    (int) $stats['last_30d'],        'from-amber-500 to-orange-500'],
            ['Unique users',    (int) $stats['unique_users'],    'from-emerald-500 to-teal-500'],
        ];
        foreach ($cards as $c): list($l, $v, $g) = $c; ?>
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-gradient-to-br <?= $g; ?> opacity-20 blur-2xl"></div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $l; ?></p>
                <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= number_format((int) $v); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-6 grid gap-4 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Top downloaders</h3>
            <?php if (empty($top_users)): ?>
                <p class="mt-4 text-sm text-slate-500">No downloads yet.</p>
            <?php else: ?>
                <ul class="mt-4 space-y-2">
                <?php foreach ($top_users as $u): ?>
                    <li class="flex items-center justify-between gap-3 rounded-xl bg-slate-50 px-3 py-2 dark:bg-slate-700/40">
                        <div class="flex min-w-0 items-center gap-3">
                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-gradient-to-br from-indigo-500 to-fuchsia-500 text-xs font-bold text-white"><?= $initial($u->full_name ?: $u->email); ?></span>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($u->full_name ?: '—', ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="truncate text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($u->email ?: '', ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </div>
                        <span class="shrink-0 rounded-full bg-indigo-100 px-2 py-0.5 text-xs font-bold text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300"><?= (int) $u->downloads; ?></span>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2 dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-center justify-between">
                <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Recent downloads</h3>
                <span class="rounded-full bg-slate-100 px-2 py-1 text-[10px] font-bold text-slate-600 dark:bg-slate-700 dark:text-slate-300"><?= count($downloads); ?> shown</span>
            </div>
            <div class="-mx-5 mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                    <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                        <tr>
                            <th class="px-5 py-3">User</th>
                            <th class="px-5 py-3">Resume</th>
                            <th class="px-5 py-3">Format</th>
                            <th class="px-5 py-3">When</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    <?php if (empty($downloads)): ?>
                        <tr><td colspan="4" class="px-5 py-10 text-center text-sm text-slate-500">No downloads yet.</td></tr>
                    <?php else: foreach ($downloads as $d): ?>
                        <tr>
                            <td class="px-5 py-3">
                                <p class="font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($d->full_name ?: '—', ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="truncate text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($d->email ?: '', ENT_QUOTES, 'UTF-8'); ?></p>
                            </td>
                            <td class="px-5 py-3 text-slate-700 dark:text-slate-200"><?= htmlspecialchars($d->title ?: 'Resume #' . $d->id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-5 py-3"><span class="rounded-full bg-rose-100 px-2 py-1 text-[11px] font-bold uppercase text-rose-800 dark:bg-rose-900/40 dark:text-rose-300"><?= htmlspecialchars($d->format, ENT_QUOTES, 'UTF-8'); ?></span></td>
                            <td class="px-5 py-3 text-xs text-slate-500 dark:text-slate-400"><?= date('d M Y, H:i', strtotime($d->created_at)); ?></td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
