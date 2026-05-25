<?php
/**
 * Admin â†’ Users
 *
 * @var array  $rows
 * @var int    $total
 * @var int    $page
 * @var int    $per_page
 * @var string $q
 * @var array  $resume_counts  user_id => count
 * @var array  $totals
 */
$totalPages = max(1, (int) ceil($total / $per_page));
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
        'title'   => 'Users',
        'desc'    => 'Manage everyone who has signed up â€” search by name, email, or mobile.',
    ]); ?>

    <!-- summary tiles -->
    <div class="mt-6 grid gap-3 sm:grid-cols-4">
        <?php
        $tiles = [
            ['All users',     (int) $total,             'bg-indigo-500/10  text-indigo-600 dark:text-indigo-300'],
            ['Admins',        (int) $totals['admins'],  'bg-amber-500/10   text-amber-600  dark:text-amber-300'],
            ['Verified',      (int) $totals['verified'],'bg-emerald-500/10 text-emerald-600 dark:text-emerald-300'],
            ['New (30 days)', (int) $totals['new_30d'], 'bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-300'],
        ];
        foreach ($tiles as $t):
            list($lab, $val, $cls) = $t; ?>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $lab; ?></p>
                <p class="mt-2 inline-flex items-baseline gap-2">
                    <span class="font-display text-2xl font-extrabold text-slate-900 dark:text-white"><?= number_format($val); ?></span>
                    <span class="rounded-full px-2 py-0.5 text-[10px] font-bold <?= $cls; ?>">live</span>
                </p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- search + table -->
    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="flex flex-col gap-3 border-b border-slate-200 p-4 sm:flex-row sm:items-center sm:justify-between dark:border-slate-700">
            <form method="get" action="<?= base_url('admin/users'); ?>" class="flex w-full max-w-md items-center gap-2">
                <div class="relative w-full">
                    <span class="pointer-events-none absolute inset-y-0 left-3 grid place-items-center text-slate-400">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
                    </span>
                    <input type="text" name="q" value="<?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>"
                           placeholder="Search name, email or mobile"
                           class="w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 shadow-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
                </div>
                <button class="rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-700">Search</button>
            </form>
            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Showing <?= count($rows); ?> of <?= number_format($total); ?></span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                    <tr>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Mobile</th>
                        <th class="px-4 py-3">Resumes</th>
                        <th class="px-4 py-3">Verified</th>
                        <th class="px-4 py-3">Last login</th>
                        <th class="px-4 py-3">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                <?php if (empty($rows)): ?>
                    <tr><td colspan="7" class="px-4 py-10 text-center text-sm text-slate-500">No users match.</td></tr>
                <?php else: foreach ($rows as $u):
                    $rid = (int) $u->role_id;
                    $resumes = isset($resume_counts[(int) $u->id]) ? $resume_counts[(int) $u->id] : 0;
                ?>
                    <tr class="transition hover:bg-slate-50/70 dark:hover:bg-slate-700/30">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-gradient-to-br from-indigo-500 to-fuchsia-500 text-xs font-bold text-white"><?= $initial($u->full_name ?: $u->email); ?></span>
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($u->full_name ?: 'â€”', ENT_QUOTES, 'UTF-8'); ?></p>
                                    <p class="truncate text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($u->email, ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <?php if ($rid === 1): ?>
                                <span class="rounded-full bg-amber-100 px-2 py-1 text-[11px] font-bold text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">Admin</span>
                            <?php else: ?>
                                <span class="rounded-full bg-slate-100 px-2 py-1 text-[11px] font-bold text-slate-700 dark:bg-slate-700 dark:text-slate-300">User</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300"><?= htmlspecialchars($u->mobile ?: 'â€”', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 font-semibold text-slate-700 dark:text-slate-200"><?= (int) $resumes; ?></td>
                        <td class="px-4 py-3">
                            <?php if (!empty($u->email_verified_at)): ?>
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2 py-1 text-[11px] font-bold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    Verified
                                </span>
                            <?php else: ?>
                                <span class="rounded-full bg-rose-100 px-2 py-1 text-[11px] font-bold text-rose-800 dark:bg-rose-900/40 dark:text-rose-300">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400"><?= $u->last_login_at ? date('d M Y, H:i', strtotime($u->last_login_at)) : 'â€”'; ?></td>
                        <td class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400"><?= date('d M Y', strtotime($u->created_at)); ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalPages > 1): ?>
            <div class="flex items-center justify-between gap-3 border-t border-slate-200 px-4 py-3 dark:border-slate-700">
                <p class="text-xs text-slate-500">Page <?= $page; ?> of <?= $totalPages; ?></p>
                <div class="flex items-center gap-1">
                    <?php
                    $qs = $q !== '' ? '&q=' . urlencode($q) : '';
                    $prev = max(1, $page - 1);
                    $next = min($totalPages, $page + 1);
                    ?>
                    <a href="?page=<?= $prev . $qs; ?>" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700">Prev</a>
                    <a href="?page=<?= $next . $qs; ?>" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700">Next</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>




