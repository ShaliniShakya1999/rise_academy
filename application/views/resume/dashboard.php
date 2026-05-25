<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">

    <?php if ($flash = $this->session->flashdata('success')): ?>
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm dark:border-emerald-900 dark:bg-emerald-950/40 dark:text-emerald-200">
            <?= htmlspecialchars($flash, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <div id="ra-stats" class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Welcome back,</p>
            <h1 class="font-display text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl"><?= htmlspecialchars(isset($full_name) ? $full_name : 'there', ENT_QUOTES, 'UTF-8'); ?> <span class="inline-block origin-bottom-right animate-[ra-wave_1.2s_ease-in-out_infinite]">👋</span></h1>
            <p class="mt-2 max-w-xl text-slate-600 dark:text-slate-400">Pick up where you left off, or start something new.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="<?= base_url('templates'); ?>" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-800 shadow-sm transition hover:-translate-y-0.5 hover:border-brand-300 hover:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:hover:border-brand-500">
                Browse templates
            </a>
            <a href="<?= base_url('resume/create/1'); ?>" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-brand-900 to-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-brand-900/30 transition hover:-translate-y-0.5 hover:from-brand-700 hover:to-brand-500">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                New resume
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="mt-10 grid grid-cols-2 gap-4 lg:grid-cols-4">
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-lg shadow-slate-200/40 ring-1 ring-slate-100 transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-900 dark:shadow-none dark:ring-slate-800">
            <div class="absolute -right-4 -top-4 h-20 w-20 rounded-full bg-gradient-to-br from-brand-500/20 to-transparent opacity-0 transition group-hover:opacity-100 dark:from-brand-500/20"></div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Total resumes</p>
            <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= count($resumes); ?></p>
        </div>
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-lg shadow-slate-200/40 ring-1 ring-slate-100 transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-900 dark:shadow-none dark:ring-slate-800">
            <div class="absolute -right-4 -top-4 h-20 w-20 rounded-full bg-gradient-to-br from-amber-200/60 to-transparent opacity-0 transition group-hover:opacity-100 dark:from-amber-500/20"></div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Templates</p>
            <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white"><?= count($templates); ?></p>
        </div>
        <div id="downloads" class="group relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-lg shadow-slate-200/40 ring-1 ring-slate-100 transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-700 dark:bg-slate-900 dark:shadow-none dark:ring-slate-800">
            <div class="absolute -right-4 -top-4 h-20 w-20 rounded-full bg-gradient-to-br from-amber-200/60 to-transparent opacity-0 transition group-hover:opacity-100 dark:from-amber-600/20"></div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Downloads</p>
            <p class="mt-2 font-display text-3xl font-extrabold text-slate-900 dark:text-white">0</p>
            <p class="mt-1 text-[11px] text-slate-400 dark:text-slate-500">PDF exports appear here soon.</p>
        </div>
        <div class="group relative overflow-hidden rounded-2xl border border-emerald-200/80 bg-gradient-to-br from-emerald-50 to-teal-50 p-5 shadow-lg shadow-emerald-200/50 ring-1 ring-emerald-100 transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-emerald-900/50 dark:from-emerald-950/40 dark:to-teal-950/30 dark:ring-emerald-900/40">
            <p class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-300">Plan</p>
            <p class="mt-2 font-display text-3xl font-extrabold text-emerald-700 dark:text-emerald-300">Free</p>
            <p class="mt-1 text-[11px] font-medium text-emerald-800/80 dark:text-emerald-400/90">Upgrade paths coming later.</p>
        </div>
    </div>

    <!-- Resumes grid -->
    <section id="your-resumes" class="mt-14 scroll-mt-28">
        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <h2 class="font-display text-xl font-extrabold text-slate-900 dark:text-white sm:text-2xl">Your resumes</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Drafts auto-save while you edit.</p>
        </div>

        <?php if (empty($resumes)): ?>
            <div class="rounded-3xl border-2 border-dashed border-slate-200 bg-white/80 p-12 text-center shadow-inner dark:border-slate-700 dark:bg-slate-900/50">
                <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-gradient-to-br from-brand-900 to-brand-600 text-white shadow-lg shadow-brand-900/30">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <h3 class="mt-4 font-display text-lg font-bold text-slate-900 dark:text-white">No resumes yet</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Create your first resume in under five minutes.</p>
                <a href="<?= base_url('resume/create/1'); ?>" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-brand-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-brand-600/25 transition hover:bg-brand-700">Create my first resume</a>
            </div>
        <?php else: ?>
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                <?php foreach ($resumes as $r):
                    $pct = (int) ($r->completion_score ?? 0);
                    $bar = max(6, min(100, $pct));
                ?>
                    <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-lg shadow-slate-200/50 ring-1 ring-slate-100 transition duration-300 hover:-translate-y-1 hover:border-brand-200/80 hover:shadow-2xl hover:shadow-brand-500/10 dark:border-slate-700 dark:bg-slate-900 dark:shadow-none dark:ring-slate-800 dark:hover:border-brand-500/40">
                        <div class="relative aspect-[1/1.414] overflow-hidden bg-white">
                            <?php 
                                $slug = strtolower((string) ($r->template_slug ?? 'basic'));
                                $path = base_url('assets/website/images/previews/');
                                $img = 'basic.png';
                                if (in_array($slug, ['creative', 'modern'])) $img = 'creative.png';
                                elseif (in_array($slug, ['classic', 'professional', 'standard'])) $img = 'standard.png';
                                elseif (in_array($slug, ['minimal', 'compact'])) $img = 'basic.png';
                            ?>
                            <img src="<?= $path . $img; ?>" alt="Preview" class="h-full w-full object-cover object-top transition duration-500 group-hover:scale-105">
                        </div>
                        <div class="absolute right-3 top-3 rounded-full bg-white/90 px-2 py-0.5 text-[10px] font-bold text-brand-700 shadow-sm backdrop-blur dark:bg-slate-900/90 dark:text-brand-300"><?= $pct; ?>%</div>
                        <div class="flex flex-1 flex-col border-t border-slate-100 p-5 dark:border-slate-800">
                            <div class="min-w-0 flex-1">
                                <h3 class="truncate font-display text-lg font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($r->title, ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($r->template_name ?: 'Template', ENT_QUOTES, 'UTF-8'); ?> · <?= date('M j, Y', strtotime($r->updated_at)); ?></p>
                                <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                                    <div class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-brand-600 transition-all duration-500" style="width: <?= $bar; ?>%"></div>
                                </div>
                            </div>
                            <div class="mt-5 flex gap-2">
                                <a href="<?= base_url('resume/edit/' . $r->id); ?>" class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl bg-gradient-to-r from-brand-900 to-brand-600 px-3 py-2.5 text-sm font-semibold text-white shadow-md shadow-brand-900/20 transition hover:from-brand-700 hover:to-brand-500">Edit</a>
                                <?= form_open(base_url('resume/delete/' . $r->id), ['class' => 'shrink-0', 'onsubmit' => "return confirm('Delete this resume?');"]); ?>
                                    <button type="submit" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-500 transition hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600 dark:border-slate-600 dark:hover:border-rose-900 dark:hover:bg-rose-950/50" title="Delete">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- Templates strip -->
    <?php if (!empty($templates)): ?>
    <section id="templates-strip" class="mt-16 scroll-mt-28">
        <div class="mb-6 flex items-center justify-between gap-4">
            <h2 class="font-display text-xl font-extrabold text-slate-900 dark:text-white sm:text-2xl">Start from a template</h2>
            <a href="<?= base_url('templates'); ?>" class="text-sm font-semibold text-brand-600 transition hover:text-brand-700 dark:text-brand-400">View all  → </a>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($templates as $t): ?>
                <a href="<?= base_url('resume/create/' . $t->id); ?>" class="group overflow-hidden rounded-2xl border border-slate-200/90 bg-white p-5 shadow-md shadow-slate-200/40 ring-1 ring-slate-100 transition duration-300 hover:-translate-y-1 hover:border-brand-200 hover:shadow-xl dark:border-slate-700 dark:bg-slate-900 dark:shadow-none dark:ring-slate-800">
                    <div class="aspect-[1/1.414] overflow-hidden rounded-xl bg-white ring-1 ring-slate-200/80 transition group-hover:ring-brand-300">
                        <?php 
                            $slug = strtolower((string) ($t->slug ?? 'basic'));
                            $path = base_url('assets/website/images/previews/');
                            $img = 'basic.png';
                            if (in_array($slug, ['creative', 'modern'])) $img = 'creative.png';
                            elseif (in_array($slug, ['classic', 'professional', 'standard'])) $img = 'standard.png';
                            elseif (in_array($slug, ['minimal', 'compact'])) $img = 'basic.png';
                        ?>
                        <img src="<?= $path . $img; ?>" alt="Preview" class="h-full w-full object-cover object-top transition duration-500 group-hover:scale-105">
                    </div>
                    <h3 class="mt-4 font-display font-bold text-slate-900 dark:text-white"><?= htmlspecialchars((string) $t->name, ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="mt-1 line-clamp-2 text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars((string) ($t->description ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

</div>




