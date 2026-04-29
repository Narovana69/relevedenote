<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<a href="<?= site_url('catalogue') ?>" class="back-link">Retour au catalogue</a>

<div class="details-container">
    <div class="details-cover">
        <?php if (!empty($livre['couverture'])): ?>
            <img src="<?= base_url('uploads/' . esc($livre['couverture'])) ?>" alt="Couverture de <?= esc($livre['titre']) ?>" style="object-fit: cover;">
        <?php else: ?>
            <div class="book-placeholder" style="height: 450px; font-size: 1.5rem;">Aucune couverture</div>
        <?php endif; ?>
    </div>

    <div class="details-info">
        <div class="badges" style="margin-bottom: 0.5rem;">
            <span class="badge badge-genre"><?= esc($livre['categorie'] ?? 'Divers') ?></span>
            <?php if (($livre['statut'] ?? '') === 'disponible'): ?>
                <span class="badge status-dispo">Disponible</span>
            <?php else: ?>
                <span class="badge status-prete">Prête</span>
            <?php endif; ?>
        </div>

        <h1 style="text-align: left; margin-bottom: 0.5rem;"><?= esc($livre['titre']) ?></h1>
        <h2 class="details-author">Auteur: <?= esc($livre['auteur'] ?? 'Inconnu') ?></h2>

        <p><strong>Annee de sortie :</strong> <?= esc($livre['annee_publication']) ?></p>
        <p><strong>ISBN :</strong> <?= esc($livre['isbn']) ?></p>

        <div class="resume-box">
            <strong>Resume :</strong><br>
            <?= nl2br(esc($livre['resume'] ?? 'Aucun resume disponible pour le moment.')) ?>
        </div>

        <h3>Dernier emprunt</h3>
        <?php if (!empty($dernier_emprunt)): ?>
            <p><strong>Emprunteur :</strong> <?= esc($dernier_emprunt['nom_emprunteur']) ?></p>
            <p><strong>Date d'emprunt :</strong> <?= esc($dernier_emprunt['date_emprunt']) ?></p>
        <?php else: ?>
            <p class="empty-state">Aucun emprunt enregistre pour ce livre.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
