<!-- HERO -->
<section class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-gradient-to-b from-brand-50 via-white to-white"></div>
    <div class="absolute -z-10 inset-x-0 top-0 h-[40rem] bg-[radial-gradient(40rem_20rem_at_50%_-10%,rgba(59,108,255,.15),transparent)]"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-16 pb-20 lg:pt-24 lg:pb-28">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-brand-100 text-brand-700 text-xs font-semibold px-3 py-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                    New • Live A4 preview & instant PDF
                </span>
                <h1 class="mt-5 font-display text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05] tracking-tight text-slate-900">
                    Build a resume that<br/>
                    <span class="bg-gradient-to-r from-brand-600 to-brand-900 bg-clip-text text-transparent">lands interviews.</span>
                </h1>
                <p class="mt-6 text-lg text-slate-600 max-w-xl">
                    Pick a professional template, fill simple forms, watch your resume update in real-time, and download a pixel-perfect PDF — all in minutes.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="<?= base_url('register'); ?>" class="inline-flex items-center gap-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold px-6 py-3.5 shadow-soft transition">
                        Build my resume — Free
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a href="<?= base_url('templates'); ?>" class="inline-flex items-center gap-2 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 text-slate-800 font-semibold px-6 py-3.5 transition">
                        Browse templates
                    </a>
                </div>

                <div class="mt-10 flex items-center gap-6 text-sm text-slate-500">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-rose-400 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-amber-400 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-emerald-400 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-sky-400 border-2 border-white"></div>
                    </div>
                    <p><strong class="text-slate-900">10,000+</strong> resumes built this month</p>
                </div>
            </div>

            <!-- Resume mock preview -->
            <div class="relative">
                <div class="absolute -inset-4 rounded-3xl bg-gradient-to-br from-brand-500/20 to-brand-900/10 blur-2xl"></div>
                <div class="relative rounded-2xl bg-white shadow-soft border border-slate-200 p-3 rotate-1 hover:rotate-0 transition-transform duration-500">
                    <div class="aspect-[1/1.414] bg-slate-50 rounded-xl overflow-hidden grid grid-cols-3">
                        <div class="col-span-1 bg-gradient-to-b from-brand-700 to-brand-900 p-4 text-white text-[8px] sm:text-[10px] space-y-3">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-white/20"></div>
                            <div class="space-y-1">
                                <div class="h-2 w-3/4 bg-white/40 rounded"></div>
                                <div class="h-1.5 w-1/2 bg-white/30 rounded"></div>
                            </div>
                            <div class="pt-2 space-y-1.5">
                                <div class="h-1.5 w-full bg-white/30 rounded"></div>
                                <div class="h-1.5 w-5/6 bg-white/30 rounded"></div>
                                <div class="h-1.5 w-3/4 bg-white/30 rounded"></div>
                            </div>
                            <div class="pt-2 space-y-1.5">
                                <div class="h-2 w-1/2 bg-white/50 rounded"></div>
                                <div class="h-1.5 w-full bg-white/30 rounded"></div>
                                <div class="h-1.5 w-full bg-white/30 rounded"></div>
                                <div class="h-1.5 w-2/3 bg-white/30 rounded"></div>
                            </div>
                        </div>
                        <div class="col-span-2 p-4 space-y-3">
                            <div class="h-3 w-2/5 bg-slate-800 rounded"></div>
                            <div class="space-y-1.5">
                                <div class="h-1.5 w-full bg-slate-200 rounded"></div>
                                <div class="h-1.5 w-5/6 bg-slate-200 rounded"></div>
                                <div class="h-1.5 w-3/4 bg-slate-200 rounded"></div>
                            </div>
                            <div class="pt-3">
                                <div class="h-2.5 w-1/3 bg-brand-600 rounded"></div>
                                <div class="mt-2 space-y-1.5">
                                    <div class="h-1.5 w-full bg-slate-200 rounded"></div>
                                    <div class="h-1.5 w-5/6 bg-slate-200 rounded"></div>
                                    <div class="h-1.5 w-4/6 bg-slate-200 rounded"></div>
                                </div>
                            </div>
                            <div class="pt-2">
                                <div class="h-2.5 w-1/4 bg-brand-600 rounded"></div>
                                <div class="mt-2 space-y-1.5">
                                    <div class="h-1.5 w-full bg-slate-200 rounded"></div>
                                    <div class="h-1.5 w-5/6 bg-slate-200 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- floating chips -->
                <div class="absolute -left-4 top-12 bg-white rounded-xl shadow-soft border border-slate-200 px-3 py-2 text-xs font-semibold text-emerald-600 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Live preview
                </div>
                <div class="absolute -right-2 bottom-10 bg-white rounded-xl shadow-soft border border-slate-200 px-3 py-2 text-xs font-semibold text-brand-700">
                    A4 • ATS-ready
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section id="features" class="py-20 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <p class="text-brand-600 text-sm font-semibold uppercase tracking-wider">Everything you need</p>
            <h2 class="mt-3 font-display text-3xl sm:text-4xl font-extrabold text-slate-900">A resume builder, not a chore</h2>
            <p class="mt-4 text-slate-600">Designed to help you focus on content. We handle the design, formatting, and ATS rules.</p>
        </div>

        <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $features = [
                ['icon' => '<path d="M3 7h18M3 12h18M3 17h18"/>',                    'title' => 'Drag-free editor',  'desc' => 'Simple form-based editor. No fighting with layouts or text boxes.'],
                ['icon' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16h3"/>', 'title' => 'Live A4 preview',   'desc' => 'See exactly what your printed PDF will look like — pixel for pixel.'],
                ['icon' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>', 'title' => 'One-click PDF',     'desc' => 'Download high-quality PDF instantly. Unlimited downloads.'],
                ['icon' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/>',  'title' => '10+ templates',     'desc' => 'Modern, classic, minimal, creative — pick what matches your industry.'],
                ['icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 0 20M12 2a15.3 15.3 0 0 0 0 20"/>', 'title' => 'ATS-friendly',  'desc' => 'Clean structure that breezes through applicant tracking systems.'],
                ['icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>', 'title' => 'Secure & private', 'desc' => 'Your data is yours. Encrypted storage, no sharing without consent.'],
            ];
            foreach ($features as $f):
            ?>
                <div class="group rounded-2xl bg-white border border-slate-200 hover:border-brand-200 hover:shadow-soft p-6 transition">
                    <div class="grid place-items-center w-11 h-11 rounded-xl bg-brand-50 text-brand-700 group-hover:bg-brand-600 group-hover:text-white transition">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= $f['icon']; ?></svg>
                    </div>
                    <h3 class="mt-4 font-semibold text-slate-900"><?= $f['title']; ?></h3>
                    <p class="mt-1.5 text-sm text-slate-600"><?= $f['desc']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-700 to-brand-900 text-white p-10 sm:p-14">
            <div class="relative z-10 max-w-2xl">
                <h2 class="font-display text-3xl sm:text-4xl font-extrabold leading-tight">Ready to build your next resume?</h2>
                <p class="mt-3 text-white/85 text-lg">Sign up free, no credit card. Build, preview, and download in under 10 minutes.</p>
                <a href="<?= base_url('register'); ?>" class="mt-7 inline-flex items-center gap-2 rounded-xl bg-white text-brand-700 hover:bg-brand-50 font-semibold px-6 py-3.5 transition">
                    Get started — it's free
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
            <div class="pointer-events-none absolute -top-24 -right-16 w-96 h-96 rounded-full bg-white/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -left-12 w-96 h-96 rounded-full bg-brand-500/30 blur-3xl"></div>
        </div>
    </div>
</section>
