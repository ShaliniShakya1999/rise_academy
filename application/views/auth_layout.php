<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data['page_title']) ? htmlspecialchars($data['page_title']).' — Rise Academy' : 'Sign in — Rise Academy'; ?></title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                fontFamily: {
                    sans:    ['Inter','ui-sans-serif','system-ui','sans-serif'],
                    display: ['Plus Jakarta Sans','Inter','sans-serif'],
                },
                colors: { brand: { 50:'#eef4ff',500:'#3b6cff',600:'#2563eb',700:'#1d4ed8',900:'#1e3a8a' } },
            } }
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans min-h-screen bg-slate-50">

<div class="min-h-screen grid lg:grid-cols-2">
    <!-- LEFT — gradient hero -->
    <aside class="hidden lg:flex relative overflow-hidden bg-gradient-to-br from-brand-900 via-brand-700 to-brand-500 text-white p-12 flex-col justify-between">
        <div>
            <a href="<?= base_url(); ?>" class="inline-flex items-center gap-2 text-2xl font-display font-extrabold">
                <span class="inline-grid place-items-center w-10 h-10 rounded-xl bg-white/15 ring-1 ring-white/25 backdrop-blur">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="13" y2="17"/></svg>
                </span>
                Rise Academy
            </a>
        </div>

        <div class="space-y-6 max-w-md">
            <h2 class="text-4xl font-display font-extrabold leading-tight">Build a resume that gets you hired.</h2>
            <p class="text-white/85 text-lg">Pick a template, fill the form, watch your A4 resume update live, and download a pixel-perfect PDF in seconds.</p>
            <ul class="space-y-3 text-white/90">
                <li class="flex gap-3"><span class="mt-1 w-5 h-5 rounded-full bg-white/20 grid place-items-center"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span> 10+ ATS-friendly templates</li>
                <li class="flex gap-3"><span class="mt-1 w-5 h-5 rounded-full bg-white/20 grid place-items-center"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span> Real-time A4 preview</li>
                <li class="flex gap-3"><span class="mt-1 w-5 h-5 rounded-full bg-white/20 grid place-items-center"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span> Unlimited downloads</li>
            </ul>
        </div>

        <p class="text-white/70 text-sm">© <?= date('Y'); ?> Rise Academy. Made for jobseekers.</p>

        <!-- decorative blobs -->
        <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 rounded-full bg-white/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-32 -left-24 w-[28rem] h-[28rem] rounded-full bg-brand-500/30 blur-3xl"></div>
    </aside>

    <!-- RIGHT — form -->
    <section class="flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md">
            <a href="<?= base_url(); ?>" class="lg:hidden inline-flex items-center gap-2 text-xl font-display font-extrabold text-brand-900 mb-8">
                <span class="inline-grid place-items-center w-9 h-9 rounded-lg bg-brand-600 text-white">R</span>
                Rise Academy
            </a>

            <?php
            $content_view = isset($view) ? $view : '';
            $content_data = isset($data) ? $data : array();
            if ($content_view !== '') {
                $this->load->view($content_view, $content_data);
            }
            ?>
        </div>
    </section>
</div>

</body>
</html>
