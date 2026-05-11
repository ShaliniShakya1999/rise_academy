<?php
/**
 * Admin → Subscriptions / Payments
 *
 * @var array $rows
 * @var array $totals  ['count','paid','pending','gross_inr']
 */
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <?php $this->load->view('admin/_header', [
        'eyebrow' => 'Admin',
        'title'   => 'Subscriptions',
        'desc'    => 'Razorpay payments captured by the platform (internships, downloads, plans).',
    ]); ?>

    <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <?php
        $cards = [
            ['Transactions', (int) $totals['count'],   'from-indigo-500 to-violet-500', ''],
            ['Successful',   (int) $totals['paid'],    'from-emerald-500 to-teal-500', ''],
            ['Pending',      (int) $totals['pending'], 'from-amber-500 to-orange-500', ''],
            ['Gross revenue', '₹' . number_format((float) $totals['gross_inr'], 2), 'from-pink-500 to-rose-500', ''],
        ];
        foreach ($cards as $c): list($l, $v, $g, $_) = $c; ?>
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-gradient-to-br <?= $g; ?> opacity-20 blur-2xl"></div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $l; ?></p>
                <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-slate-700">
            <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Recent payments</h3>
            <span class="rounded-full bg-slate-100 px-2 py-1 text-[10px] font-bold text-slate-600 dark:bg-slate-700 dark:text-slate-300"><?= count($rows); ?> shown</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Purpose</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Provider</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                <?php if (empty($rows)): ?>
                    <tr><td colspan="7" class="px-4 py-10 text-center text-sm text-slate-500">No payments captured yet.</td></tr>
                <?php else: foreach ($rows as $p):
                    $status = strtolower((string) $p->status);
                    $badge = $status === 'paid' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300'
                          : ($status === 'failed' ? 'bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-300'
                          : 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300');
                ?>
                    <tr class="transition hover:bg-slate-50/70 dark:hover:bg-slate-700/30">
                        <td class="px-4 py-3 font-mono text-xs text-slate-500">#<?= (int) $p->id; ?></td>
                        <td class="px-4 py-3">
                            <p class="font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($p->full_name ?: '—', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="truncate text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($p->email ?: '', ENT_QUOTES, 'UTF-8'); ?></p>
                        </td>
                        <td class="px-4 py-3"><span class="rounded-full bg-slate-100 px-2 py-1 text-[11px] font-bold text-slate-700 dark:bg-slate-700 dark:text-slate-300"><?= htmlspecialchars($p->purpose, ENT_QUOTES, 'UTF-8'); ?></span></td>
                        <td class="px-4 py-3 font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($p->currency, ENT_QUOTES, 'UTF-8'); ?> <?= number_format(((int) $p->amount_paise) / 100, 2); ?></td>
                        <td class="px-4 py-3 text-xs uppercase text-slate-500 dark:text-slate-400"><?= htmlspecialchars($p->provider, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3"><span class="rounded-full px-2 py-1 text-[11px] font-bold uppercase <?= $badge; ?>"><?= htmlspecialchars($p->status, ENT_QUOTES, 'UTF-8'); ?></span></td>
                        <td class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400"><?= date('d M Y, H:i', strtotime($p->created_at)); ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
