<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Catalogue des livres</h1>

<div class="catalogue-head">
    <a href="<?= site_url('catalogue/ajouter') ?>" class="add-book-link">Ajouter un nouveau livre</a>
</div>

<form class="filter-bar" method="get" action="<?= site_url('catalogue') ?>">
    <input type="text" name="search" placeholder="Titre..." value="<?= esc($search ?? '') ?>" autocomplete="off">

    <select name="category">
        <option value="">Toutes les categories</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= esc($cat) ?>" <?= ($selected_category === $cat) ? 'selected' : '' ?>>
                <?= esc($cat) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Rechercher</button>
</form>

<?php if (!empty($livres) && is_array($livres)): ?>
    <div class="table-wrap">
        <table class="catalogue-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Annee</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td>
                            <a href="<?= site_url('catalogue/details/' . (int) $livre['id']) ?>" class="book-link">
                                <?= esc($livre['titre']) ?>
                            </a>
                        </td>
                        <td><?= esc($livre['auteur'] ?? 'Inconnu') ?></td>
                        <td><?= esc($livre['annee_publication']) ?></td>
                        <td>
                            <span class="status-chip <?= ($livre['statut'] ?? '') === 'disponible' ? 'status-chip-dispo' : 'status-chip-prete' ?>">
                                <?= esc($livre['statut'] ?? 'inconnu') ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <?php if (($livre['statut'] ?? '') === 'disponible'): ?>
                                    <form action="<?= site_url('mouvements/preter/' . (int) $livre['id']) ?>" method="post" class="emprunt-form">
                                        <?= csrf_field() ?>
                                        <input type="text" name="emprunteur" required placeholder="Nom emprunteur">
                                        <button type="submit" class="btn btn-preter">Preter</button>
                                    </form>
                                <?php else: ?>
                                    <div class="last-borrower">Dernier : <?= esc($livre['dernier_emprunteur'] ?? 'Inconnu') ?></div>
                                    <form action="<?= site_url('mouvements/retourner/' . (int) $livre['id']) ?>" method="post">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-retourner">Retourner</button>
                                    </form>
                                <?php endif; ?>

                                <form action="<?= site_url('catalogue/supprimer/' . (int) $livre['id']) ?>" method="post" onsubmit="return confirm('Supprimer ce livre ?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-delete">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="empty-state">Aucun livre trouve dans le catalogue.</p>
<?php endif; ?>

<?php if (!empty($pager)): ?>
    <div class="pager-wrap">
        <?= $pager->links('livres', 'default_full') ?>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
