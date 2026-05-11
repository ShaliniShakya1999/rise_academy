<?php
/**
 * Reusable admin page header — eyebrow, title, optional description + actions.
 *
 * @var string $eyebrow  small uppercase label above title
 * @var string $title    big page title
 * @var string $desc     short helper text under title
 * @var string $actions  raw HTML for action area on the right (optional)
 */
$eyebrow = isset($eyebrow) ? $eyebrow : 'Admin';
$title   = isset($title) ? $title : 'Section';
$desc    = isset($desc) ? $desc : '';
$actions = isset($actions) ? $actions : '';
?>
<div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div class="min-w-0">
        <p class="text-[11px] font-bold uppercase tracking-widest text-indigo-400"><?= htmlspecialchars($eyebrow, ENT_QUOTES, 'UTF-8'); ?></p>
        <h1 class="mt-1 truncate font-display text-2xl font-extrabold text-slate-900 sm:text-3xl dark:text-white"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
        <?php if ($desc !== ''): ?>
            <p class="mt-1 max-w-2xl text-sm text-slate-600 dark:text-slate-400"><?= htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
    </div>
    <?php if ($actions !== ''): ?>
        <div class="flex shrink-0 flex-wrap items-center gap-2"><?= $actions; ?></div>
    <?php endif; ?>
</div>
