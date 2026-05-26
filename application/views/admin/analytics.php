<?php
/**
 * Admin → Analytics
 *
 * @var array $kpis
 * @var array $series        ['signups'=>[...], 'resumes'=>[...], 'downloads'=>[...], 'logins'=>[...]]
 * @var array $template_split
 * @var array $top_locations
 */
$series = $series + ['signups' => [], 'resumes' => [], 'downloads' => [], 'logins' => []];

/** Render a sparkline-style mini bar chart from a date=>count array */
$spark = function (array $data, $accent = 'from-indigo-400 to-violet-500') {
    if (empty($data)) {
        echo '<div class="grid h-24 place-items-center text-xs text-slate-400">No data</div>';
        return;
    }
    $max = max(array_values($data));
    if ($max < 1) $max = 1;
    $cols = count($data);
    echo '<div class="flex h-24 items-end gap-1">';
    $i = 0;
    foreach ($data as $date => $count) {
        $h = max(4, (int) round(($count / $max) * 96));
        $title = htmlspecialchars($date . ' · ' . $count, ENT_QUOTES, 'UTF-8');
        echo '<div title="' . $title . '" class="flex-1 rounded-t bg-gradient-to-t ' . $accent . ' opacity-90 transition hover:opacity-100" style="height:' . $h . 'px"></div>';
        $i++;
    }
    echo '</div>';
};
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <?php $this->load->view('admin/_header', [
        'eyebrow' => 'Admin',
        'title'   => 'Analytics',
        'desc'    => 'Last 30 days of activity, plus a snapshot of total platform usage.',
    ]); ?>

    <!-- KPI cards -->
    <div class="mt-8 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <?php
        $cards = [
            ['Users',          (int) $kpis['users'],         'from-cyan-500 to-blue-600'],
            ['Resumes',        (int) $kpis['resumes'],       'from-violet-500 to-purple-600'],
            ['Downloads',      (int) $kpis['downloads'],     'from-emerald-500 to-teal-600'],
            ['ATS reports',    (int) $kpis['ats_reports'],   'from-amber-500 to-orange-600'],
            ['Jobs live',      (int) $kpis['jobs'],          'from-pink-500 to-rose-600'],
            ['Internships',    (int) $kpis['internships'],   'from-fuchsia-500 to-pink-600'],
            ['Logins (30d)',   (int) $kpis['logins_30d'],    'from-sky-500 to-indigo-600'],
            ['New users (30d)', (int) $kpis['new_users_30d'], 'from-lime-500 to-emerald-600'],
        ];
        foreach ($cards as $c):
            list($label, $value, $grad) = $c;
        ?>
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-slate-700 dark:bg-slate-800">
            <div class="absolute -right-6 -top-6 h-16 w-16 rounded-full bg-gradient-to-br <?= $grad; ?> opacity-20 blur-2xl transition group-hover:opacity-30"></div>
            <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $label; ?></p>
            <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= number_format($value); ?></p>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Time-series charts -->
    <div class="mt-8 grid gap-4 lg:grid-cols-2">
        <?php
        $charts = [
            ['Signups',   $series['signups'],   'from-cyan-400 to-blue-500'],
            ['Resumes',   $series['resumes'],   'from-violet-400 to-fuchsia-500'],
            ['Downloads', $series['downloads'], 'from-emerald-400 to-teal-500'],
            ['Logins',    $series['logins'],    'from-amber-400 to-orange-500'],
        ];
        foreach ($charts as $ch):
            list($lab, $data, $acc) = $ch;
            $tot = array_sum(array_values($data));
        ?>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= $lab; ?> · last 30 days</p>
                    <p class="mt-1 font-display text-2xl font-extrabold text-slate-900 dark:text-white"><?= number_format($tot); ?></p>
                </div>
                <span class="rounded-full bg-slate-100 px-2 py-1 text-[10px] font-bold text-slate-600 dark:bg-slate-700 dark:text-slate-300">30d</span>
            </div>
            <div class="mt-4"><?php $spark($data, $acc); ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Template split + top locations -->
    <div class="mt-8 grid gap-4 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2 dark:border-slate-700 dark:bg-slate-800">
            <div class="flex items-center justify-between">
                <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Template usage</h3>
                <a href="<?= base_url('admin/templates'); ?>" class="text-xs font-semibold text-indigo-600 hover:underline dark:text-indigo-400">Manage</a>
            </div>
            <?php if (empty($template_split)): ?>
                <p class="mt-4 text-sm text-slate-500">No templates yet.</p>
            <?php else: ?>
                <?php
                $totalUsed = 0;
                foreach ($template_split as $t) $totalUsed += (int) $t->used;
                if ($totalUsed < 1) $totalUsed = 1;
                ?>
                <div class="mt-4 space-y-3">
                <?php foreach ($template_split as $t):
                    $pct = (int) round(((int) $t->used / $totalUsed) * 100);
                ?>
                    <div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-medium text-slate-700 dark:text-slate-200"><?= htmlspecialchars($t->name, ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="font-semibold text-slate-500 dark:text-slate-400"><?= (int) $t->used; ?> <span class="opacity-60">(<?= $pct; ?>%)</span></span>
                        </div>
                        <div class="mt-1 h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                            <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-violet-500" style="width:<?= $pct; ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Top job locations</h3>
            <?php if (empty($top_locations)): ?>
                <p class="mt-4 text-sm text-slate-500">No job data yet.</p>
            <?php else: ?>
                <ul class="mt-4 space-y-2 text-sm">
                <?php foreach ($top_locations as $loc): ?>
                    <li class="flex items-center justify-between">
                        <span class="truncate font-medium text-slate-700 dark:text-slate-200"><?= htmlspecialchars($loc->location, ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-bold text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300"><?= (int) $loc->c; ?></span>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>




