<?php
/**
 * Preview mockups â€” must be defined before first use (PHP executes top-to-bottom).
 */
if (!function_exists('_render_template_preview')) {
    function _render_template_preview($slug)
    {
        $slug = strtolower((string) $slug);
        $path = base_url('assets/website/images/previews/');
        
        // Map slug to image filename
        $img = 'basic.png'; // Default
        if ($slug === 'creative' || $slug === 'modern') $img = 'creative.png';
        if ($slug === 'classic' || $slug === 'professional') $img = 'standard.png';
        if ($slug === 'standard') $img = 'standard.png';
        if ($slug === 'minimal' || $slug === 'compact') $img = 'basic.png';

        ob_start();
        ?>
        <div class="h-full w-full bg-white flex items-center justify-center">
            <img src="<?= $path . $img; ?>" alt="Template Preview" class="w-full h-full object-cover object-top">
        </div>
        <?php
        return ob_get_clean();
    }
}

/**
 * `resume_templates` in jobportal has no `category` column â€” derive filter bucket from slug.
 *
 * @param object $t Template row
 * @param array  $category_label map key => display label
 * @return array{key:string,label:string}
 */
if (!function_exists('ra_template_display_category')) {
    function ra_template_display_category($t, array $category_label)
    {
        $raw = '';
        if (is_object($t) && isset($t->category)) {
            $raw = trim((string) $t->category);
        }
        if ($raw !== '') {
            $key = strtolower($raw);
        } else {
            $slug = isset($t->slug) ? strtolower((string) $t->slug) : '';
            if (in_array($slug, ['compact', 'minimal'], true)) {
                $key = 'minimal';
            } elseif ($slug === 'creative') {
                $key = 'creative';
            } else {
                $key = 'professional';
            }
        }
        $label = isset($category_label[$key]) ? $category_label[$key] : ucfirst($key);
        return ['key' => $key, 'label' => $label];
    }
}

$is_logged_in = (bool) $this->session->userdata('logged_in');
$go_url       = function ($id) use ($is_logged_in) {
    return $is_logged_in ? base_url('resume/create/' . $id) : base_url('register');
};

$category_label = [
    'professional' => 'Professional',
    'minimal'      => 'Minimal',
    'creative'     => 'Creative',
    'modern'       => 'Modern',
];
?>

<!-- HERO -->
<section class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-gradient-to-b from-brand-50 via-white to-white"></div>
    <div class="absolute -z-10 inset-x-0 top-0 h-[28rem] bg-[radial-gradient(36rem_18rem_at_50%_-10%,rgba(245,158,11,.15),transparent)]"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-16 pb-10 text-center">
        <span class="inline-flex items-center gap-2 rounded-full bg-brand-100 text-brand-700 text-xs font-semibold px-3 py-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
            <?= count($templates); ?> professional templates â€¢ Free forever
        </span>
        <h1 class="mt-5 font-display text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05] tracking-tight text-slate-900">
            Resume templates that<br/>
            <span class="bg-gradient-to-r from-brand-600 to-brand-900 bg-clip-text text-transparent">recruiters love.</span>
        </h1>
        <p class="mt-5 text-lg text-slate-600 max-w-2xl mx-auto">
            Every template is ATS-friendly, hand-crafted, and fully customizable. Switch designs anytime â€” your content stays put.
        </p>

        <!-- quick stats -->
        <div class="mt-10 inline-flex flex-wrap items-center justify-center gap-6 text-sm text-slate-500">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.296a1 1 0 010 1.408l-8 8a1 1 0 01-1.408 0l-4-4a1 1 0 011.408-1.408L8 12.586l7.296-7.29a1 1 0 011.408 0z" clip-rule="evenodd"/></svg>
                ATS-friendly
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.296a1 1 0 010 1.408l-8 8a1 1 0 01-1.408 0l-4-4a1 1 0 011.408-1.408L8 12.586l7.296-7.29a1 1 0 011.408 0z" clip-rule="evenodd"/></svg>
                A4 export
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.296a1 1 0 010 1.408l-8 8a1 1 0 01-1.408 0l-4-4a1 1 0 011.408-1.408L8 12.586l7.296-7.29a1 1 0 011.408 0z" clip-rule="evenodd"/></svg>
                Customize colors &amp; fonts
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.296a1 1 0 010 1.408l-8 8a1 1 0 01-1.408 0l-4-4a1 1 0 011.408-1.408L8 12.586l7.296-7.29a1 1 0 011.408 0z" clip-rule="evenodd"/></svg>
                Unlimited downloads
            </div>
        </div>
    </div>
</section>

<?php if (empty($templates)): ?>
    <div class="mx-auto max-w-3xl px-4 py-16 text-center">
        <p class="text-slate-500">No templates available yet. Import <code class="text-sm bg-slate-100 px-1 rounded">application/sql/jobportal_full.sql</code> or ensure <code>resume_templates</code> has active rows.</p>
    </div>
<?php else: ?>

<!-- FILTER + GRID -->
<section x-data="{ filter: 'all' }" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-20">

    <!-- Filter pills -->
    <div class="flex items-center justify-center gap-2 flex-wrap">
        <?php
        $cats = ['all' => 'All'];
        foreach ($templates as $t) {
            $dc            = ra_template_display_category($t, $category_label);
            $cats[$dc['key']] = $dc['label'];
        }
        foreach ($cats as $key => $label):
        ?>
            <button @click="filter = '<?= htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8'); ?>'"
                    :class="filter === '<?= htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8'); ?>' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-slate-700 border-slate-200 hover:border-slate-300'"
                    class="border rounded-full text-sm font-medium px-4 py-1.5 transition">
                <?= htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8'); ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Grid -->
    <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($templates as $t):
            $dc = ra_template_display_category($t, $category_label);
            $slug = isset($t->slug) ? (string) $t->slug : '';
            $desc = isset($t->description) ? (string) $t->description : '';
            ?>
            <article x-show="filter === 'all' || filter === '<?= htmlspecialchars($dc['key'], ENT_QUOTES, 'UTF-8'); ?>'"
                     x-transition.opacity
                     class="group relative rounded-2xl bg-white border border-slate-200 hover:border-brand-200 hover:shadow-soft transition overflow-hidden">

                <!-- Preview area (1/âˆš2 = A4 ratio) -->
                <div class="relative aspect-[1/1.414] bg-gradient-to-br from-slate-50 to-slate-100 border-b border-slate-200 overflow-hidden">
                    <div class="absolute inset-4 bg-white rounded shadow-sm overflow-hidden">
                        <?= _render_template_preview($slug); ?>
                    </div>

                    <!-- Hover overlay -->
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <a href="<?= $go_url((int) $t->id); ?>"
                           class="inline-flex items-center gap-2 rounded-lg bg-white text-slate-900 font-semibold px-5 py-2.5 shadow-soft hover:bg-brand-50 transition">
                            Use this template
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>

                    <!-- Free badge -->
                    <span class="absolute top-3 right-3 inline-flex items-center gap-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-[11px] font-semibold px-2 py-0.5">FREE</span>
                </div>

                <!-- Meta -->
                <div class="p-5">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="font-display text-lg font-bold text-slate-900"><?= htmlspecialchars((string) $t->name, ENT_QUOTES, 'UTF-8'); ?></h3>
                        <span class="shrink-0 inline-flex items-center rounded-full bg-slate-100 text-slate-600 text-[11px] font-medium px-2 py-0.5">
                            <?= htmlspecialchars($dc['label'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>
                    <p class="mt-1.5 text-sm text-slate-500 line-clamp-2"><?= htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?></p>

                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-center gap-1">
                            <?php
                            $swatches = ['#f59e0b', '#d97706', '#10b981', '#ef4444', '#6366f1'];
                            foreach ($swatches as $sw):
                            ?>
                                <span class="w-3.5 h-3.5 rounded-full ring-2 ring-white" style="background:<?= htmlspecialchars($sw, ENT_QUOTES, 'UTF-8'); ?>"></span>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?= $go_url((int) $t->id); ?>" class="text-sm font-semibold text-brand-600 hover:text-brand-700 inline-flex items-center gap-1">
                            Use template
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>

        <!-- Coming soon teaser -->
        <article class="rounded-2xl border-2 border-dashed border-slate-200 bg-white p-5 flex flex-col items-center justify-center text-center min-h-[24rem]">
            <div class="grid place-items-center w-12 h-12 rounded-xl bg-brand-50 text-brand-600">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <h3 class="mt-3 font-display font-bold text-slate-900">More coming soon</h3>
            <p class="mt-1 text-sm text-slate-500 max-w-xs">Creative, Executive, Tech and Graduate templates are in the works.</p>
        </article>
    </div>
</section>

<!-- CTA strip -->
<section class="pb-24">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-700 to-brand-900 text-white p-10 sm:p-14 text-center">
            <div class="relative z-10">
                <h2 class="font-display text-3xl sm:text-4xl font-extrabold">Found your style?</h2>
                <p class="mt-3 text-white/85">Pick any template and start filling. You can switch designs anytime without losing data.</p>
                <a href="<?= $is_logged_in ? base_url('dashboard') : base_url('register'); ?>"
                   class="mt-7 inline-flex items-center gap-2 rounded-xl bg-white text-brand-700 hover:bg-brand-50 font-semibold px-6 py-3.5 transition">
                    <?= $is_logged_in ? 'Go to dashboard' : 'Get started â€” free'; ?>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
            <div class="pointer-events-none absolute -top-24 -right-16 w-96 h-96 rounded-full bg-white/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -left-12 w-96 h-96 rounded-full bg-brand-500/30 blur-3xl"></div>
        </div>
    </div>
</section>

<?php endif; ?>




