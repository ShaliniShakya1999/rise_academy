<?php
/** @var array $jobs */
/** @var array $internships */
/** @var int   $total */

$flash_ok = $this->session->flashdata('wish_ok');
?>
<div class="relative overflow-hidden bg-gradient-to-b from-rose-50/60 via-white to-white">
    <div class="absolute top-10 right-0 w-96 h-96 bg-rose-200/30 rounded-full blur-3xl ra-float-slow pointer-events-none"></div>
    <div class="absolute bottom-10 left-0 w-80 h-80 bg-violet-200/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 sm:py-20">

        <!-- Hero -->
        <div class="ra-animate-in lg:flex lg:items-end lg:justify-between gap-8">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-wider text-rose-600">Saved for later</p>
                <h1 class="mt-2 font-display text-4xl sm:text-5xl font-extrabold text-slate-900">My Wishlist</h1>
                <p class="mt-4 text-lg text-slate-600">
                    Quick access to the jobs and internships you've bookmarked. Apply when you're ready.
                </p>
            </div>
            <div class="ra-animate-in ra-animate-in-delay-2 mt-6 lg:mt-0">
                <div class="rounded-2xl bg-gradient-to-r from-rose-500 to-pink-600 text-white px-5 py-3 shadow-lg">
                    <p class="text-xs opacity-90">Saved items</p>
                    <p class="text-2xl font-display font-extrabold"><?= (int) $total; ?></p>
                </div>
            </div>
        </div>

        <?php if ($flash_ok): ?>
            <div class="ra-animate-in mt-8 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-medium">
                <?= htmlspecialchars($flash_ok); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($jobs) && empty($internships)): ?>
            <!-- Empty state -->
            <div class="ra-animate-in mt-14 rounded-3xl border-2 border-dashed border-slate-200 bg-white px-8 py-20 text-center">
                <div class="mx-auto w-16 h-16 grid place-items-center rounded-2xl bg-rose-50 text-rose-500">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </div>
                <h3 class="mt-5 font-display text-xl font-bold text-slate-900">Your wishlist is empty</h3>
                <p class="mt-2 text-sm text-slate-500 max-w-md mx-auto">
                    Browse jobs and internships, then click the heart icon to save them here for quick access later.
                </p>
                <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                    <a href="<?= base_url('jobs'); ?>" class="inline-flex items-center gap-2 rounded-xl bg-violet-600 hover:bg-violet-700 text-white font-semibold px-5 py-2.5 transition">
                        Browse jobs →
                    </a>
                    <a href="<?= base_url('internship'); ?>" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 hover:border-violet-400 hover:text-violet-700 text-slate-700 font-semibold px-5 py-2.5 transition">
                        Browse internships
                    </a>
                </div>
            </div>
        <?php else: ?>

            <!-- Jobs section -->
            <?php if (!empty($jobs)): ?>
                <section class="mt-12">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="font-display text-2xl font-bold text-slate-900">
                            <span class="inline-block w-2 h-6 rounded-full bg-violet-600 align-middle mr-2"></span>
                            Saved Jobs
                            <span class="text-sm font-medium text-slate-500 ml-1">(<?= count($jobs); ?>)</span>
                        </h2>
                        <a href="<?= base_url('jobs'); ?>" class="text-sm font-semibold text-violet-700 hover:text-violet-900">Browse more →</a>
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($jobs as $idx => $j): ?>
                            <article class="ra-animate-in ra-animate-in-delay-<?= min($idx + 1, 4); ?> relative rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-violet-200 transition-all duration-300">
                                <form method="post" action="<?= base_url('wishlist/remove/' . (int) $j['_row_id']); ?>" class="absolute top-4 right-4">
                                    <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-rose-50 border border-rose-200 text-rose-600 hover:bg-rose-100 transition" title="Remove from wishlist">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                    </button>
                                </form>
                                <div class="flex items-start gap-3 pr-10">
                                    <div class="shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-violet-600 to-indigo-700 text-white grid place-items-center font-bold">
                                        <?= htmlspecialchars($j['logo'] ?? 'CO'); ?>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-bold text-slate-900 truncate"><?= htmlspecialchars($j['title'] ?? 'Untitled'); ?></h3>
                                        <p class="text-sm text-slate-500 truncate"><?= htmlspecialchars($j['company'] ?? ''); ?></p>
                                    </div>
                                </div>
                                <div class="mt-4 flex flex-wrap gap-2 text-xs text-slate-600">
                                    <?php if (!empty($j['location'])): ?>
                                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                            <?= htmlspecialchars($j['location']); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($j['salary'])): ?>
                                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 text-amber-700 px-2.5 py-1 font-medium"><?= htmlspecialchars($j['salary']); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($j['employment_type'])): ?>
                                        <span class="inline-flex items-center gap-1 rounded-full bg-violet-50 text-violet-700 px-2.5 py-1 font-medium"><?= htmlspecialchars(ucfirst($j['employment_type'])); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs">
                                    <span class="text-slate-400">Saved <?= htmlspecialchars($j['savedDate'] ?? ''); ?></span>
                                    <a href="<?= base_url('jobs'); ?>" class="font-semibold text-violet-700 hover:text-violet-900">Apply →</a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Internships section -->
            <?php if (!empty($internships)): ?>
                <section class="mt-12">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="font-display text-2xl font-bold text-slate-900">
                            <span class="inline-block w-2 h-6 rounded-full bg-indigo-600 align-middle mr-2"></span>
                            Saved Internships
                            <span class="text-sm font-medium text-slate-500 ml-1">(<?= count($internships); ?>)</span>
                        </h2>
                        <a href="<?= base_url('internship'); ?>" class="text-sm font-semibold text-indigo-700 hover:text-indigo-900">Browse more →</a>
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($internships as $idx => $i): ?>
                            <article class="ra-animate-in ra-animate-in-delay-<?= min($idx + 1, 4); ?> relative rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-indigo-200 transition-all duration-300">
                                <form method="post" action="<?= base_url('wishlist/remove/' . (int) $i['_row_id']); ?>" class="absolute top-4 right-4">
                                    <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-rose-50 border border-rose-200 text-rose-600 hover:bg-rose-100 transition" title="Remove from wishlist">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                    </button>
                                </form>
                                <div class="flex items-start gap-3 pr-10">
                                    <div class="shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-600 to-purple-700 text-white grid place-items-center font-bold">
                                        <?= htmlspecialchars($i['logo'] ?? 'IN'); ?>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-bold text-slate-900 truncate"><?= htmlspecialchars($i['title'] ?? 'Untitled'); ?></h3>
                                        <p class="text-sm text-slate-500 truncate"><?= htmlspecialchars($i['company'] ?? ''); ?></p>
                                    </div>
                                </div>
                                <div class="mt-4 flex flex-wrap gap-2 text-xs text-slate-600">
                                    <?php if (!empty($i['location'])): ?>
                                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                            <?= htmlspecialchars($i['location']); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($i['salary'])): ?>
                                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 text-amber-700 px-2.5 py-1 font-medium"><?= htmlspecialchars($i['salary']); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($i['duration_weeks'])): ?>
                                        <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 text-indigo-700 px-2.5 py-1 font-medium"><?= (int) $i['duration_weeks']; ?> weeks</span>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs">
                                    <span class="text-slate-400">Saved <?= htmlspecialchars($i['savedDate'] ?? ''); ?></span>
                                    <a href="<?= base_url('internship'); ?>" class="font-semibold text-indigo-700 hover:text-indigo-900">Apply →</a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>
