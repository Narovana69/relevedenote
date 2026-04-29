<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?? 'SysInfo' ?></title>
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />
</head>
<body>

<div class="app">

  <!-- ── Sidebar ──────────────────────────────────────────────────────────── -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="logo-icon">
        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
      </div>
      <div>
        <div class="brand-name">Relevés de Notes</div>
        <div class="brand-sub">IHM S4</div>
      </div>
    </div>

    <div class="sidebar-section">Navigation</div>

    <a href="<?= base_url('etudiants') ?>" class="nav-item">
      <svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
      Liste des Étudiants
    </a>
    <a href="<?= base_url('notes/add') ?>" class="nav-item">
      <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      Ajouter une note
    </a>

    <div class="sidebar-bottom">
      <a href="<?= base_url('login') ?>" class="user-row">
        <div class="avatar">U</div>
        <div class="user-info">
          <div class="name">Connexion</div>
        </div>
      </a>
    </div>
  </aside>

  <!-- ── Main ─────────────────────────────────────────────────────────────── -->
  <div class="main">

    <div class="topbar">
      <div class="topbar-title"><?= $title ?? 'Tableau de bord' ?></div>
    </div>

    <div class="content">

      <div class="page-header">
        <div>
          <h2><?= $title ?? 'Tableau de bord' ?></h2>
        </div>
      </div>

      <?= $this->renderSection('content') ?>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /app -->
<script src="<?= base_url('js/script.js') ?>"></script>
</body>
</html>
