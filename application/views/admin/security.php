<?php
/**
 * Admin → Security
 *
 * @var array $logins      login_activity_logs (joined)
 * @var array $admin_logs  admin_activity_logs (joined)
 * @var array $stats
 */
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <?php $this->load->view('admin/_header', [
        'eyebrow' => 'Admin',
        'title'   => 'Security logs',
        'desc'    => 'Sign-in attempts and admin actions across the platform.',
    ]); ?>

    <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <?php
        $cards = [
            ['Login events',    (int) $stats['logins_total'],  'from-cyan-500 to-blue-500'],
            ['Failed logins',   (int) $stats['logins_failed'], 'from-rose-500 to-pink-500'],
            ['Logins (30d)',    (int) $stats['logins_30d'],    'from-emerald-500 to-teal-500'],
            ['Admin actions',   (int) $stats['admin_actions'], 'from-amber-500 to-orange-500'],
        ];
        foreach ($cards as $c): list($l, $v, $g) = $c; ?>
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-gradient-to-br <?= $g; ?> opacity-20 blur-2xl"></div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $l; ?></p>
                <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= number_format((int) $v); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-6 grid gap-4 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-slate-700">
                <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Recent sign-in attempts</h3>
                <span class="rounded-full bg-slate-100 px-2 py-1 text-[10px] font-bold text-slate-600 dark:bg-slate-700 dark:text-slate-300"><?= count($logins); ?></span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                    <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3">Account</th>
                            <th class="px-4 py-3">IP</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">When</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    <?php if (empty($logins)): ?>
                        <tr><td colspan="4" class="px-4 py-10 text-center text-sm text-slate-500">No login events.</td></tr>
                    <?php else: foreach ($logins as $l): $ok = (int) $l->success === 1; ?>
                        <tr>
                            <td class="px-4 py-3">
                                <p class="truncate font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($l->full_name ?: '-', ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="truncate text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($l->email_attempt ?: '', ENT_QUOTES, 'UTF-8'); ?></p>
                            </td>
                            <td class="px-4 py-3 font-mono text-xs text-slate-600 dark:text-slate-300"><?= htmlspecialchars($l->ip_address ?: '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-4 py-3">
                                <?php if ($ok): ?>
                                    <span class="rounded-full bg-emerald-100 px-2 py-1 text-[11px] font-bold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">Success</span>
                                <?php else: ?>
                                    <span class="rounded-full bg-rose-100 px-2 py-1 text-[11px] font-bold text-rose-800 dark:bg-rose-900/40 dark:text-rose-300" title="<?= htmlspecialchars($l->message ?: '', ENT_QUOTES, 'UTF-8'); ?>">Failed</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400"><?= date('d M Y, H:i', strtotime($l->created_at)); ?></td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-slate-700">
                <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Admin actions</h3>
                <span class="rounded-full bg-slate-100 px-2 py-1 text-[10px] font-bold text-slate-600 dark:bg-slate-700 dark:text-slate-300"><?= count($admin_logs); ?></span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                    <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3">Admin</th>
                            <th class="px-4 py-3">Action</th>
                            <th class="px-4 py-3">Target</th>
                            <th class="px-4 py-3">When</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    <?php if (empty($admin_logs)): ?>
                        <tr><td colspan="4" class="px-4 py-10 text-center text-sm text-slate-500">No admin activity yet.</td></tr>
                    <?php else: foreach ($admin_logs as $a): ?>
                        <tr>
                            <td class="px-4 py-3">
                                <p class="truncate font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($a->full_name ?: '-', ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="truncate text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($a->email ?: '', ENT_QUOTES, 'UTF-8'); ?></p>
                            </td>
                            <td class="px-4 py-3"><span class="rounded-full bg-indigo-100 px-2 py-1 text-[11px] font-bold text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300"><?= htmlspecialchars($a->action, ENT_QUOTES, 'UTF-8'); ?></span></td>
                            <td class="px-4 py-3 text-xs text-slate-600 dark:text-slate-300">
                                <?php if (!empty($a->entity)): ?>
                                    <span class="font-mono"><?= htmlspecialchars($a->entity, ENT_QUOTES, 'UTF-8'); ?><?php if (!empty($a->entity_id)): ?> #<?= htmlspecialchars($a->entity_id, ENT_QUOTES, 'UTF-8'); ?><?php endif; ?></span>
                                <?php else: ?>
                                     - 
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400"><?= date('d M Y, H:i', strtotime($a->created_at)); ?></td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




