<?php
/**
 * Admin â†’ Resumes
 *
 * @var array $rows   joined rows of resumes + user + template
 * @var array $stats
 */
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <?php $this->load->view('admin/_header', [
        'eyebrow' => 'Admin',
        'title'   => 'Resumes',
        'desc'    => 'All resumes created by users, with completion score and template used.',
    ]); ?>

    <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <?php
        $cards = [
            ['Total resumes', (int) $stats['total'],     'from-violet-500 to-fuchsia-500'],
            ['Avg completion', $stats['avg_score'] . '%', 'from-emerald-500 to-teal-500'],
            ['With score',    (int) $stats['with_score'], 'from-amber-500 to-orange-500'],
            ['Downloads',     (int) $stats['downloads'],  'from-cyan-500 to-blue-500'],
        ];
        foreach ($cards as $c): list($l, $v, $g) = $c; ?>
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-gradient-to-br <?= $g; ?> opacity-20 blur-2xl"></div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $l; ?></p>
                <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-slate-700">
            <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Latest 100 resumes</h3>
            <span class="text-xs font-semibold text-slate-500"><?= count($rows); ?> shown</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                    <tr>
                        <th class="px-4 py-3">Resume</th>
                        <th class="px-4 py-3">Owner</th>
                        <th class="px-4 py-3">Template</th>
                        <th class="px-4 py-3 w-44">Completion</th>
                        <th class="px-4 py-3">Updated</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                <?php if (empty($rows)): ?>
                    <tr><td colspan="5" class="px-4 py-10 text-center text-sm text-slate-500">No resumes yet.</td></tr>
                <?php else: foreach ($rows as $r): $pct = max(0, min(100, (int) $r->completion_score)); ?>
                    <tr class="transition hover:bg-slate-50/70 dark:hover:bg-slate-700/30">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-violet-100 text-violet-700 dark:bg-violet-900/40 dark:text-violet-300">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                </span>
                                <p class="truncate font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($r->title ?: 'Untitled', ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="truncate text-slate-700 dark:text-slate-200"><?= htmlspecialchars($r->full_name ?: 'â€”', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="truncate text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($r->email ?: '', ENT_QUOTES, 'UTF-8'); ?></p>
                        </td>
                        <td class="px-4 py-3">
                            <?php if (!empty($r->template_name)): ?>
                                <span class="rounded-full bg-indigo-100 px-2 py-1 text-[11px] font-bold text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300"><?= htmlspecialchars($r->template_name, ENT_QUOTES, 'UTF-8'); ?></span>
                            <?php else: ?>
                                <span class="text-xs text-slate-400">â€”</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="h-2 flex-1 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                                    <div class="h-full rounded-full bg-gradient-to-r <?= $pct >= 70 ? 'from-emerald-500 to-teal-500' : ($pct >= 30 ? 'from-amber-500 to-orange-500' : 'from-rose-500 to-pink-500'); ?>" style="width:<?= $pct; ?>%"></div>
                                </div>
                                <span class="w-10 shrink-0 text-right text-xs font-bold text-slate-700 dark:text-slate-200"><?= $pct; ?>%</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400"><?= date('d M Y, H:i', strtotime($r->updated_at)); ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




