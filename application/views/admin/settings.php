<?php
/**
 * Admin → Settings
 *
 * @var array $info
 * @var array $tables
 */
?>
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <?php $this->load->view('admin/_header', [
        'eyebrow' => 'Admin',
        'title'   => 'Settings',
        'desc'    => 'Read-only configuration snapshot of the running CodeIgniter app.',
    ]); ?>

    <div class="mt-6 grid gap-4 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2 dark:border-slate-700 dark:bg-slate-800">
            <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Application</h3>
            <dl class="mt-4 grid grid-cols-1 gap-3 text-sm sm:grid-cols-2">
                <?php
                $items = [
                    'Base URL'      => $info['base_url'],
                    'Environment'   => $info['environment'],
                    'PHP version'   => $info['php_version'],
                    'MySQL version' => $info['mysql_version'],
                    'Charset'       => $info['charset'],
                    'Language'      => $info['language'],
                    'Index page'    => $info['index_page'] ?: '(empty)',
                    'Session driver' => $info['session'],
                    'DB host'       => $info['db_host'],
                    'DB name'       => $info['db_name'],
                ];
                foreach ($items as $k => $v): ?>
                    <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-700/40">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400"><?= htmlspecialchars($k, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="mt-1 break-all font-mono text-xs text-slate-800 dark:text-slate-100"><?= htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php endforeach; ?>
            </dl>

            <div class="mt-6 rounded-xl border border-dashed border-slate-300 bg-slate-50/60 p-4 text-xs text-slate-600 dark:border-slate-600 dark:bg-slate-700/30 dark:text-slate-300">
                <p class="font-semibold text-slate-800 dark:text-slate-100">Editing settings</p>
                <p class="mt-1">Edit the underlying config files in <code class="rounded bg-white px-1 py-0.5 dark:bg-slate-800">application/config/</code> — these are not editable from the UI to keep production safe.</p>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-800">
            <h3 class="font-display text-base font-bold text-slate-900 dark:text-white">Database tables</h3>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400"><?= count($tables); ?> tables present.</p>
            <ul class="mt-3 max-h-[420px] space-y-1 overflow-y-auto pr-1 text-sm">
                <?php foreach ($tables as $tbl): ?>
                    <li class="flex items-center justify-between rounded-lg px-2 py-1 hover:bg-slate-50 dark:hover:bg-slate-700/40">
                        <span class="font-mono text-xs text-slate-700 dark:text-slate-200"><?= htmlspecialchars($tbl, ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="rounded-full bg-indigo-50 px-2 py-0.5 text-[10px] font-bold text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300"><?= (int) $this->db->count_all($tbl); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
