<?php
/**
 * Admin â†’ Content (Jobs + Internships)
 *
 * @var array $jobs
 * @var array $internships
 * @var array $stats
 */
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10"
     x-data="{ tab: 'jobs' }">
    <?php $this->load->view('admin/_header', [
        'eyebrow' => 'Admin',
        'title'   => 'Content',
        'desc'    => 'Jobs and internships content shown across the public site.',
    ]); ?>

    <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <?php
        $cards = [
            ['Jobs live',    (int) $stats['jobs'],        'from-rose-500 to-pink-500'],
            ['Internships',  (int) $stats['internships'], 'from-indigo-500 to-violet-500'],
            ['Remote jobs',  (int) $stats['remote_jobs'], 'from-cyan-500 to-blue-500'],
            ['Saved items',  (int) $stats['wishlists'],   'from-amber-500 to-orange-500'],
        ];
        foreach ($cards as $c): list($l, $v, $g) = $c; ?>
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-gradient-to-br <?= $g; ?> opacity-20 blur-2xl"></div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $l; ?></p>
                <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= number_format((int) $v); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-6 inline-flex rounded-xl border border-slate-200 bg-white p-1 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <button @click="tab='jobs'" :class="tab==='jobs' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:text-slate-900 dark:text-slate-300'" class="rounded-lg px-4 py-2 text-sm font-semibold transition">Jobs (<?= count($jobs); ?>)</button>
        <button @click="tab='internships'" :class="tab==='internships' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:text-slate-900 dark:text-slate-300'" class="rounded-lg px-4 py-2 text-sm font-semibold transition">Internships (<?= count($internships); ?>)</button>
    </div>

    <!-- JOBS -->
    <div x-show="tab==='jobs'" class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                    <tr>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Company</th>
                        <th class="px-4 py-3">Location</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Salary</th>
                        <th class="px-4 py-3">Posted</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                <?php if (empty($jobs)): ?>
                    <tr><td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">No jobs configured.</td></tr>
                <?php else: foreach ($jobs as $j): ?>
                    <tr class="transition hover:bg-slate-50/70 dark:hover:bg-slate-700/30">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-gradient-to-br from-rose-500 to-pink-500 text-xs font-bold text-white"><?= htmlspecialchars($j->logo_text ?: 'CO', ENT_QUOTES, 'UTF-8'); ?></span>
                                <p class="font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($j->title, ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-700 dark:text-slate-200"><?= htmlspecialchars($j->company, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300">
                            <?= htmlspecialchars($j->location ?: '-', ENT_QUOTES, 'UTF-8'); ?>
                            <?php if ((int) $j->is_remote === 1): ?>
                                <span class="ml-1 rounded-full bg-cyan-100 px-1.5 py-0.5 text-[10px] font-bold text-cyan-800 dark:bg-cyan-900/40 dark:text-cyan-300">Remote</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3"><span class="rounded-full bg-slate-100 px-2 py-1 text-[11px] font-bold text-slate-700 dark:bg-slate-700 dark:text-slate-300"><?= htmlspecialchars($j->employment_type, ENT_QUOTES, 'UTF-8'); ?></span></td>
                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300"><?= htmlspecialchars($j->salary_label ?: '-', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400"><?= date('d M Y', strtotime($j->created_at)); ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- INTERNSHIPS -->
    <div x-show="tab==='internships'" x-cloak class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
                <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:bg-slate-900/40 dark:text-slate-400">
                    <tr>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Company</th>
                        <th class="px-4 py-3">Location</th>
                        <th class="px-4 py-3">Stipend</th>
                        <th class="px-4 py-3">Duration</th>
                        <th class="px-4 py-3">Posted</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                <?php if (empty($internships)): ?>
                    <tr><td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">No internships configured.</td></tr>
                <?php else: foreach ($internships as $iN): ?>
                    <tr class="transition hover:bg-slate-50/70 dark:hover:bg-slate-700/30">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-gradient-to-br from-indigo-500 to-violet-500 text-xs font-bold text-white"><?= htmlspecialchars($iN->logo_text ?: 'IN', ENT_QUOTES, 'UTF-8'); ?></span>
                                <p class="font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($iN->title, ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-700 dark:text-slate-200"><?= htmlspecialchars($iN->company, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300">
                            <?= htmlspecialchars($iN->location ?: '-', ENT_QUOTES, 'UTF-8'); ?>
                            <?php if ((int) $iN->is_remote === 1): ?>
                                <span class="ml-1 rounded-full bg-cyan-100 px-1.5 py-0.5 text-[10px] font-bold text-cyan-800 dark:bg-cyan-900/40 dark:text-cyan-300">Remote</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300"><?= htmlspecialchars($iN->stipend_label ?: '-', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300"><?= $iN->duration_weeks ? ((int) $iN->duration_weeks . ' wks') : ' - '; ?></td>
                        <td class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400"><?= date('d M Y', strtotime($iN->created_at)); ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




