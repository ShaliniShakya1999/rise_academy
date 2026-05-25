<?php
/**
 * Admin â†’ Templates
 *
 * @var array $rows  resume_templates rows
 * @var array $usage template_id => count
 * @var array $stats
 */
$accents = ['from-violet-500 to-fuchsia-500', 'from-cyan-500 to-blue-500', 'from-emerald-500 to-teal-500', 'from-amber-500 to-orange-500', 'from-pink-500 to-rose-500'];
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <?php $this->load->view('admin/_header', [
        'eyebrow' => 'Admin',
        'title'   => 'Resume templates',
        'desc'    => 'Templates available to users in the resume builder.',
    ]); ?>

    <div class="mt-6 grid gap-3 sm:grid-cols-3">
        <?php
        $cards = [
            ['Total',     (int) $stats['total'],    'from-indigo-500 to-violet-500'],
            ['Active',    (int) $stats['active'],   'from-emerald-500 to-teal-500'],
            ['Inactive',  (int) $stats['inactive'], 'from-rose-500 to-orange-500'],
        ];
        foreach ($cards as $c): list($l, $v, $g) = $c; ?>
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-gradient-to-br <?= $g; ?> opacity-20 blur-2xl"></div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $l; ?></p>
                <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= number_format((int) $v); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <?php if (empty($rows)): ?>
            <div class="sm:col-span-2 lg:col-span-3 rounded-2xl border border-dashed border-slate-300 p-10 text-center text-sm text-slate-500 dark:border-slate-600">No templates configured.</div>
        <?php else: foreach ($rows as $i => $t):
            $used = isset($usage[(int) $t->id]) ? $usage[(int) $t->id] : 0;
            $acc = $accents[$i % count($accents)];
        ?>
            <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-slate-700 dark:bg-slate-800">
                <div class="relative grid h-40 place-items-center bg-gradient-to-br <?= $acc; ?> text-white">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.25),_transparent_60%)]"></div>
                    <span class="font-display text-4xl font-extrabold tracking-tight drop-shadow"><?= strtoupper(substr((string) $t->slug, 0, 1)); ?></span>
                    <span class="absolute right-3 top-3 rounded-full bg-white/20 px-2 py-0.5 text-[10px] font-bold uppercase tracking-widest backdrop-blur"><?= htmlspecialchars($t->slug, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h3 class="font-display text-lg font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($t->name, ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="mt-1 line-clamp-2 text-sm text-slate-600 dark:text-slate-400"><?= htmlspecialchars($t->description ?: 'No description', ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                        <?php if ((int) $t->is_active === 1): ?>
                            <span class="shrink-0 rounded-full bg-emerald-100 px-2 py-1 text-[11px] font-bold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">Active</span>
                        <?php else: ?>
                            <span class="shrink-0 rounded-full bg-slate-200 px-2 py-1 text-[11px] font-bold text-slate-700 dark:bg-slate-700 dark:text-slate-300">Inactive</span>
                        <?php endif; ?>
                    </div>
                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs dark:border-slate-700">
                        <span class="font-semibold text-slate-500 dark:text-slate-400"><?= (int) $used; ?> resume<?= $used === 1 ? '' : 's'; ?> use this</span>
                        <span class="text-slate-400">#<?= (int) $t->id; ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; endif; ?>
    </div>
</div>




