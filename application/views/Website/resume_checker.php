<div class="relative overflow-hidden bg-gradient-to-b from-emerald-50/60 to-white">
    <div class="absolute top-1/4 -right-20 w-[28rem] h-[28rem] rounded-full border border-emerald-200/60 ra-float-slow pointer-events-none opacity-60"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
        <div class="ra-animate-in max-w-3xl mx-auto text-center">
            <p class="text-sm font-semibold uppercase tracking-wider text-emerald-600">ATS &amp; quality</p>
            <h1 class="mt-2 font-display text-4xl sm:text-5xl font-extrabold text-slate-900">Resume Checker</h1>
            <p class="mt-4 text-lg text-slate-600">
                Check your resume for keywords, structure, readability, and common mistakes. Upload your PDF or DOC below (demo)—AI scoring and instant feedback are coming soon.
            </p>
        </div>

        <div class="ra-animate-in ra-animate-in-delay-1 mt-12 max-w-2xl mx-auto">
            <div class="rounded-3xl border-2 border-dashed border-emerald-300 bg-white/80 backdrop-blur px-8 py-14 text-center hover:border-emerald-500 hover:bg-emerald-50/30 transition duration-500 cursor-pointer group">
                <div class="mx-auto w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-700 grid place-items-center group-hover:scale-110 transition-transform duration-300">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                </div>
                <p class="mt-4 font-semibold text-slate-900">Drop resume here</p>
                <p class="mt-1 text-sm text-slate-500">PDF, max 5MB — coming soon: instant score + suggestions</p>
                <span class="mt-4 inline-block text-xs font-bold uppercase tracking-wide text-emerald-600 animate-pulse">Upload pipeline in development</span>
            </div>
        </div>

        <div class="ra-animate-in ra-animate-in-delay-2 mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php
            $checks = [
                ['t' => 'ATS headings', 'd' => 'Clear H1-style name + one-line title'],
                ['t' => 'Keywords', 'd' => 'Mirror 5–10 skills from the job description'],
                ['t' => 'Bullet power', 'd' => 'Action verb + number + result'],
                ['t' => 'Length', 'd' => '1–2 pages, white space balanced'],
            ];
            foreach ($checks as $i => $c):
            ?>
                <div class="rounded-xl border border-slate-200 bg-white p-4 hover:border-emerald-200 hover:shadow-md transition" style="animation-delay: <?= $i * 0.05; ?>s">
                    <p class="font-bold text-slate-900"><?= htmlspecialchars($c['t']); ?></p>
                    <p class="mt-1 text-xs text-slate-600"><?= htmlspecialchars($c['d']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="ra-animate-in ra-animate-in-delay-3 mt-12 text-center">
            <a href="<?= base_url('dashboard'); ?>" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-3 shadow-lg transition">
                Build resume in app
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</div>
