<?php
$q          = isset($filters['q']) ? $filters['q'] : '';
$cat_active = isset($filters['category']) ? $filters['category'] : '';
$remote     = !empty($filters['is_remote']);

$is_logged = (bool) $this->session->userdata('logged_in');
$saved_ids = isset($saved_internship_ids) && is_array($saved_internship_ids) ? $saved_internship_ids : [];
$back_url = current_url() . ($this->input->server('QUERY_STRING') ? '?' . $this->input->server('QUERY_STRING') : '');

$flash_ok = $this->session->flashdata('wish_ok');
$flash_info = $this->session->flashdata('info');
?>

<?php if ($flash_ok || $flash_info): ?>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-6">
        <?php if ($flash_ok): ?>
            <div class="rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-medium ra-animate-in">
                <?= htmlspecialchars($flash_ok); ?>
            </div>
        <?php endif; ?>
        <?php if ($flash_info): ?>
            <div class="rounded-xl bg-brand-50 border border-brand-200 text-brand-800 px-4 py-3 text-sm font-medium ra-animate-in">
                <?= htmlspecialchars($flash_info); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<div class="relative overflow-hidden bg-gradient-to-b from-brand-50/80 to-white">
    <div class="absolute inset-x-0 top-0 h-64 bg-gradient-to-b from-brand-100/50 to-transparent pointer-events-none"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 sm:py-20">

        <!-- Hero -->
        <div class="ra-animate-in lg:flex lg:items-end lg:justify-between gap-8">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-wider text-brand-600">Learning</p>
                <h1 class="mt-2 font-display text-4xl sm:text-5xl font-extrabold text-slate-900">Internship</h1>
                <p class="mt-4 text-lg text-slate-600">
                    Hands-on internships with real projects, mentorship, and portfolio building. Browse partner programs across design, engineering, marketing and more.
                </p>
            </div>
            <div class="ra-animate-in ra-animate-in-delay-2 mt-6 lg:mt-0">
                <div class="rounded-2xl bg-brand-600 text-white px-5 py-3 shadow-lg ra-glow-pulse">
                    <p class="text-xs opacity-90">Live internships</p>
                    <p class="text-2xl font-display font-extrabold"><?= (int) ($total ?? 0); ?></p>
                </div>
            </div>
        </div>

        <!-- Search + filter -->
        <form method="get" action="<?= base_url('internship'); ?>"
              class="ra-animate-in ra-animate-in-delay-1 mt-10 rounded-2xl bg-white border border-slate-200 shadow-sm p-3 sm:p-4 flex flex-col sm:flex-row gap-3 sm:items-center">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </span>
                <input type="search" name="q" value="<?= htmlspecialchars($q); ?>"
                       placeholder="Search internships by title, company or skill…"
                       class="w-full pl-10 pr-3 py-2.5 rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500">
            </div>
            <select name="category" class="rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 py-2.5">
                <option value="">All categories</option>
                <?php foreach (($categories ?? []) as $c): ?>
                    <option value="<?= htmlspecialchars($c); ?>" <?= $cat_active === $c ? 'selected' : ''; ?>><?= htmlspecialchars(ucfirst($c)); ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inline-flex items-center gap-2 text-sm text-slate-700 px-2">
                <input type="checkbox" name="remote" value="1" <?= $remote ? 'checked' : ''; ?> class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                Remote only
            </label>
            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold px-5 py-2.5 transition">Filter</button>
        </form>

        <!-- Results -->
        <?php if (empty($internships)): ?>
            <div class="mt-12 rounded-3xl border-2 border-dashed border-slate-200 bg-white px-8 py-16 text-center">
                <div class="mx-auto w-14 h-14 grid place-items-center rounded-xl bg-brand-50 text-brand-700">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                </div>
                <h3 class="mt-4 font-bold text-slate-900">No internships match your filters</h3>
                <p class="mt-1 text-sm text-slate-500">Try clearing the search or selecting a different category.</p>
                <a href="<?= base_url('internship'); ?>" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-brand-700 hover:text-brand-900">Clear filters →</a>
            </div>
        <?php else: ?>
            <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <?php $idx = 1; foreach ($internships as $i):
                    $is_saved = in_array((int) $i->id, $saved_ids, true);
                ?>
                    <article class="ra-animate-in ra-animate-in-delay-<?= min($idx++, 4); ?> group relative rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-brand-200 transition-all duration-300">

                        <!-- Save button (heart) -->
                        <form method="post" action="<?= base_url('wishlist/toggle'); ?>" class="absolute top-4 right-4 z-10 ra-wish-form" data-item-type="internship" data-item-id="<?= (int) $i->id; ?>">
                            <input type="hidden" name="item_type" value="internship">
                            <input type="hidden" name="item_id" value="<?= (int) $i->id; ?>">
                            <input type="hidden" name="back" value="<?= htmlspecialchars($back_url); ?>">
                            <button type="submit"
                                    class="ra-wish-btn inline-flex items-center justify-center w-9 h-9 rounded-full border transition <?= $is_saved ? 'bg-rose-50 border-rose-200 text-rose-600 ra-wish-saved' : 'bg-white border-slate-200 text-slate-400 hover:text-rose-500 hover:border-rose-300'; ?>"
                                    aria-label="<?= $is_saved ? 'Remove from wishlist' : 'Save to wishlist'; ?>"
                                    title="<?= $is_saved ? 'Saved — click to remove' : 'Save to wishlist'; ?>">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="<?= $is_saved ? 'currentColor' : 'none'; ?>" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                            </button>
                        </form>

                        <div class="flex items-start gap-3 pr-10">
                            <div class="shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-brand-900 to-brand-600 text-white grid place-items-center font-bold">
                                <?= htmlspecialchars($i->logo_text ?: 'IN'); ?>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h2 class="font-bold text-slate-900 truncate group-hover:text-brand-700 transition"><?= htmlspecialchars($i->title); ?></h2>
                                <p class="text-sm text-slate-500 truncate"><?= htmlspecialchars($i->company); ?></p>
                            </div>
                            <span class="shrink-0 text-[11px] font-semibold rounded-full px-2 py-0.5 bg-brand-100 text-brand-800">
                                <?= htmlspecialchars(ucfirst($i->category)); ?>
                            </span>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2 text-xs text-slate-600">
                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <?= htmlspecialchars($i->location ?: 'Anywhere'); ?>
                            </span>
                            <?php if ($i->is_remote): ?>
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 font-medium">Remote</span>
                            <?php endif; ?>
                            <?php if (!empty($i->stipend_label)): ?>
                                <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 text-amber-700 px-2.5 py-1 font-medium">
                                    <?= htmlspecialchars($i->stipend_label); ?>
                                </span>
                            <?php endif; ?>
                            <?php if (!empty($i->duration_weeks)): ?>
                                <span class="inline-flex items-center gap-1 rounded-full bg-brand-50 text-brand-700 px-2.5 py-1 font-medium">
                                    <?= (int) $i->duration_weeks; ?> weeks
                                </span>
                            <?php endif; ?>
                        </div>

                        <p class="mt-3 text-sm text-slate-600 line-clamp-2"><?= htmlspecialchars($i->description); ?></p>

                        <?php if (!empty($i->requirements)): ?>
                            <p class="mt-3 text-xs text-slate-500"><span class="font-semibold text-slate-700">Requirements:</span> <?= htmlspecialchars($i->requirements); ?></p>
                        <?php endif; ?>

                        <a href="<?= $this->session->userdata('logged_in') ? base_url('dashboard') : base_url('register'); ?>"
                           class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-brand-600 hover:text-brand-800">
                            Apply now
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- How to apply strip -->
        <div class="ra-animate-in ra-animate-in-delay-4 mt-14 rounded-2xl bg-slate-900 text-white p-8 sm:p-10">
            <h3 class="font-display text-2xl font-bold">How to apply</h3>
            <ol class="mt-4 space-y-3 list-decimal list-inside text-slate-300 text-sm sm:text-base">
                <li>Create an account (Register).</li>
                <li>Use <strong class="text-white">Project Submission</strong> to send your sample work, GitHub, or portfolio link.</li>
                <li>We shortlist candidates and email you with next steps.</li>
            </ol>
            <a href="<?= base_url('project-submission'); ?>" class="mt-6 inline-flex rounded-xl bg-white text-slate-900 font-bold px-5 py-3 hover:bg-brand-100 transition">
                Submit application
            </a>
        </div>
    </div>
</div>
