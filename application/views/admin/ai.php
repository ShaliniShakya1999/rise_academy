<?php
/**
 * Admin → AI Tools
 *
 * @var array $reports
 * @var array $buckets   ['0-25'=>n,'26-50'=>n,'51-75'=>n,'76-100'=>n]
 * @var array $stats
 */
$total_in_buckets = array_sum(array_values($buckets)) ?: 1;
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <?php $this->load->view('admin/_header', [
        'eyebrow' => 'Admin',
        'title'   => 'AI tools',
        'desc'    => 'ATS resume checker activity and AI usage across the platform.',
    ]); ?>

    <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <?php
        $cards = [
            ['ATS reports',     (int) $stats['reports'],     'from-violet-500 to-fuchsia-500'],
            ['Resume uploads',  (int) $stats['uploads'],     'from-cyan-500 to-blue-500'],
            ['Avg ATS score',   $stats['avg_score'] . '%',   'from-emerald-500 to-teal-500'],
            ['Reports (30d)',   (int) $stats['reports_30d'], 'from-amber-500 to-orange-500'],
        ];
        foreach ($cards as $c): list($l, $v, $g) = $c; ?>
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-gradient-to-br <?= $g; ?> opacity-20 blur-2xl"></div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $l; ?></p>
                <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-6 grid gap-4 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Score distribution</h3>
            <div class="mt-4 space-y-3">
                <?php
                $colors = [
                    '0-25'   => 'from-rose-500 to-pink-500',
                    '26-50'  => 'from-amber-500 to-orange-500',
                    '51-75'  => 'from-sky-500 to-blue-500',
                    '76-100' => 'from-emerald-500 to-teal-500',
                ];
                foreach ($buckets as $k => $v):
                    $pct = (int) round(($v / $total_in_buckets) * 100);
                ?>
                <div>
                    <div class="flex items-center justify-between text-xs font-semibold">
                        <span class="text-slate-600 dark:text-slate-300"><?= htmlspecialchars($k, ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="text-slate-500 dark:text-slate-400"><?= (int) $v; ?> · <?= $pct; ?>%</span>
                    </div>
                    <div class="mt-1 h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                        <div class="h-full rounded-full bg-gradient-to-r <?= $colors[$k]; ?>" style="width:<?= $pct; ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2 dark:border-slate-700 dark:bg-slate-800">
            <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Recent ATS reports</h3>
            <div class="-mx-5 mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                    <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                        <tr>
                            <th class="px-5 py-3">User</th>
                            <th class="px-5 py-3">File</th>
                            <th class="px-5 py-3 w-32">Score</th>
                            <th class="px-5 py-3">When</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    <?php if (empty($reports)): ?>
                        <tr><td colspan="4" class="px-5 py-10 text-center text-sm text-slate-500">No ATS reports yet.</td></tr>
                    <?php else: foreach ($reports as $r): $score = (int) $r->score; ?>
                        <tr>
                            <td class="px-5 py-3">
                                <p class="font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($r->full_name ?: 'User #' . $r->user_id, ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="truncate text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($r->email ?: '', ENT_QUOTES, 'UTF-8'); ?></p>
                            </td>
                            <td class="px-5 py-3 text-slate-600 dark:text-slate-300"><?= htmlspecialchars($r->original_name ?: '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="h-2 w-20 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                                        <div class="h-full rounded-full bg-gradient-to-r <?= $score >= 70 ? 'from-emerald-500 to-teal-500' : ($score >= 40 ? 'from-amber-500 to-orange-500' : 'from-rose-500 to-pink-500'); ?>" style="width:<?= $score; ?>%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-200"><?= $score; ?>%</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-xs text-slate-500 dark:text-slate-400"><?= date('d M Y, H:i', strtotime($r->created_at)); ?></td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




