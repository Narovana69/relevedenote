<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Bibliotheque Zen') ?></title>
    <meta name="theme-color" content="#4A6572">
    <link rel="manifest" href="<?= base_url('manifest.webmanifest') ?>">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body>

<header class="topbar">
    <div class="container topbar-inner">
        <a href="<?= site_url('catalogue') ?>" class="brand">Bibliotheque Zen</a>
        <nav class="main-nav">
            <a href="<?= site_url('catalogue') ?>">Catalogue</a>
            <a href="<?= site_url('catalogue/ajouter') ?>">Ajouter</a>
        </nav>
    </div>
</header>

<main class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash flash-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="flash flash-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</main>

<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('<?= base_url('sw.js') ?>');
    });
}
</script>

</body>
</html>
