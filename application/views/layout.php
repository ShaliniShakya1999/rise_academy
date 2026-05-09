<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rise Academy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/website/css/site.css'); ?>">
</head>
<body>
<?php $this->load->view('partials/navbar'); ?>

<main class="ra-content">
    <?php
    $content_view = isset($view) ? $view : '';
    $content_data = isset($data) ? $data : array();
    if ($content_view !== '') {
        $this->load->view($content_view, $content_data);
    }
    ?>
</main>

<?php $this->load->view('partials/footer'); ?>
<script src="<?= base_url('assets/website/js/site.js'); ?>"></script>
</body>
</html>
