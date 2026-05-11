<?php
$is_logged_in = (bool) $this->session->userdata('logged_in');
$user_name    = $this->session->userdata('full_name') ?: 'Account';
$is_admin     = (int) $this->session->userdata('role_id') === 1;
$page_title   = isset($data['page_title']) ? $data['page_title'] : 'Editor';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title); ?> — Rise Academy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/website/css/editor.css?v=1'); ?>" rel="stylesheet">
</head>
<body class="re-body">

<!-- Sticky top navbar -->
<nav class="re-topnav">
    <div class="re-topnav__inner">
        <a class="re-topnav__brand" href="<?= base_url(); ?>">
            <span class="re-topnav__logo"><i class="fa-solid fa-file-lines"></i></span>
            <span class="re-topnav__title">Rise<span class="text-gradient">Academy</span></span>
        </a>

        <ul class="re-topnav__menu d-none d-lg-flex">
            <li><a href="<?= base_url('dashboard'); ?>"><i class="fa-solid fa-grip me-1"></i>Dashboard</a></li>
            <li><a href="<?= base_url('templates'); ?>"><i class="fa-solid fa-layer-group me-1"></i>Templates</a></li>
            <li><a href="<?= base_url('jobs'); ?>"><i class="fa-solid fa-briefcase me-1"></i>Jobs</a></li>
            <li><a href="<?= base_url('internship'); ?>"><i class="fa-solid fa-graduation-cap me-1"></i>Internships</a></li>
        </ul>

        <div class="re-topnav__right">
            <span class="re-autosave" id="autosaveBadge">
                <i class="fa-solid fa-circle-check"></i> <span class="re-autosave__text">Saved</span>
            </span>

            <?php if ($is_logged_in): ?>
                <div class="dropdown re-profile">
                    <button class="re-profile__btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="re-profile__avatar"><?= strtoupper(substr($user_name, 0, 1)); ?></span>
                        <span class="re-profile__name d-none d-md-inline"><?= htmlspecialchars($user_name); ?></span>
                        <i class="fa-solid fa-chevron-down small ms-1"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end re-profile__menu shadow-lg">
                        <li><a class="dropdown-item" href="<?= base_url('dashboard'); ?>"><i class="fa-solid fa-house fa-fw me-2"></i>Dashboard</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('templates'); ?>"><i class="fa-solid fa-palette fa-fw me-2"></i>Templates</a></li>
                        <?php if ($is_admin): ?>
                            <li><a class="dropdown-item text-primary fw-bold" href="<?= base_url('admin'); ?>"><i class="fa-solid fa-shield-halved fa-fw me-2"></i>Admin Panel</a></li>
                        <?php endif; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= base_url('logout'); ?>"><i class="fa-solid fa-right-from-bracket fa-fw me-2"></i>Sign out</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="<?= base_url('login'); ?>" class="re-btn re-btn--ghost">Sign in</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="re-main">
    <?php
    $content_view = isset($view) ? $view : '';
    $content_data = isset($data) ? $data : [];
    if ($content_view !== '') {
        $this->load->view($content_view, $content_data);
    }
    ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.RE_BASE_URL = "<?= base_url(); ?>";
</script>
<script src="<?= base_url('assets/website/js/editor.js?v=1'); ?>"></script>
</body>
</html>
