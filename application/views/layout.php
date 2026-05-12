<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data['page_title']) ? htmlspecialchars($data['page_title']).' — Rise Academy' : 'Rise Academy — Resume Builder'; ?></title>
    <meta name="description" content="Create ATS-friendly, professional resumes in minutes. Modern templates, live preview, instant PDF download.">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50:  '#eef4ff',
                            100: '#dbe6ff',
                            500: '#3b6cff',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    },
                    boxShadow: {
                        soft: '0 1px 2px rgba(15,23,42,.04), 0 8px 24px rgba(15,23,42,.06)',
                    }
                }
            }
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/website/css/site.css?v=4'); ?>">
    <?php if (!empty($data['page_assets']) && is_array($data['page_assets'])): ?>
        <?php if (!empty($data['page_assets']['css'])): ?>
            <link rel="stylesheet" href="<?= base_url($data['page_assets']['css']); ?>">
        <?php endif; ?>
    <?php endif; ?>
</head>
<body class="font-sans bg-slate-50 text-slate-900 antialiased min-h-screen flex flex-col dark:bg-slate-950 dark:text-slate-100" x-data x-init="if (localStorage.getItem('ra_dark') === '1') document.documentElement.classList.add('dark')">

<?php $this->load->view('partials/navbar'); ?>

<?php
$content_view = isset($view) ? $view : '';
$content_data = isset($data) ? $data : array();
$user_shell  = !empty($data['use_user_shell']);
$admin_shell = !empty($data['use_admin_shell']);
$page_title  = isset($data['page_title']) ? $data['page_title'] : '';
?>

<?php if ($user_shell):
    $CI = &get_instance();
    $sidebar_wishlist_count = 0;
    if ($CI->session->userdata('logged_in')) {
        $CI->load->model('wishlist_model');
        $sidebar_wishlist_count = $CI->wishlist_model->count_for_user((int) $CI->session->userdata('user_id'));
    }
?>
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="sticky top-14 z-30 flex items-center gap-3 border-b border-slate-200/90 bg-white/95 px-4 py-2.5 backdrop-blur-md dark:border-slate-800 dark:bg-slate-950/95 lg:hidden">
            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-800 shadow-sm active:scale-95 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" @click="$dispatch('ra-open-sidebar')" aria-label="Open menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg>
            </button>
            <span class="truncate text-sm font-bold text-slate-800 dark:text-slate-100"><?= htmlspecialchars((string) $page_title, ENT_QUOTES, 'UTF-8'); ?></span>
        </div>
        <div class="flex min-h-0 flex-1">
            <?php $this->load->view('partials/user_sidebar', [
                'active'               => isset($data['sidebar_active']) ? $data['sidebar_active'] : 'dashboard',
                'shell_avg_completion' => isset($data['shell_avg_completion']) ? $data['shell_avg_completion'] : null,
                'wishlist_count'       => $sidebar_wishlist_count,
            ]); ?>
            <div class="flex min-h-0 min-w-0 flex-1 flex-col bg-slate-50 transition-colors dark:bg-slate-950">
                <main class="min-h-0 flex-1 overflow-y-auto">
                    <?php if ($content_view !== '') {
                        $this->load->view($content_view, $content_data);
                    } ?>
                </main>
            </div>
        </div>
    </div>

<?php elseif ($admin_shell): ?>
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="sticky top-14 z-30 flex items-center gap-3 border-b border-slate-700/80 bg-slate-900/95 px-4 py-2.5 text-white backdrop-blur-md lg:hidden">
            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-600 bg-slate-800 active:scale-95" @click="$dispatch('ra-open-admin-sidebar')" aria-label="Open admin menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg>
            </button>
            <span class="truncate text-sm font-bold"><?= htmlspecialchars((string) $page_title, ENT_QUOTES, 'UTF-8'); ?></span>
        </div>
        <div class="flex min-h-0 flex-1">
            <?php $this->load->view('partials/admin_sidebar', [
                'active' => isset($data['sidebar_active']) ? $data['sidebar_active'] : 'admin',
            ]); ?>
            <div class="flex min-h-0 min-w-0 flex-1 flex-col bg-slate-100 transition-colors dark:bg-slate-900">
                <main class="min-h-0 flex-1 overflow-x-auto overflow-y-auto">
                    <?php if ($content_view !== '') {
                        $this->load->view($content_view, $content_data);
                    } ?>
                </main>
            </div>
        </div>
    </div>

<?php else: ?>
<main class="flex-1">
<?php
if ($content_view !== '') {
    $this->load->view($content_view, $content_data);
}
?>
</main>
<?php endif; ?>

<?php $this->load->view('partials/footer', ['compact_top' => ($user_shell || $admin_shell)]); ?>

<?php if (!empty($data['page_assets']) && is_array($data['page_assets']) && !empty($data['page_assets']['js'])): ?>
    <script src="<?= base_url($data['page_assets']['js']); ?>"></script>
<?php endif; ?>
<script src="<?= base_url('assets/website/js/site.js?v=3'); ?>"></script>
</body>
</html>
