<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Mon Profil</h1>
    <a href="<?= site_url('logout') ?>" style="color: #d9534f; text-decoration: none; font-weight: bold; border: 1px solid #d9534f; padding: 8px 15px; border-radius: 4px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#d9534f'; this.style.color='#fff'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#d9534f'">
        Déconnexion
    </a>
</div>

<div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 30px;">
    <h2 style="margin-top: 0;">Informations Personnelles</h2>
    <p><strong>Nom :</strong> <?= esc($nom ?? '') ?></p>
    <p><strong>Rôle :</strong> <?= esc(session()->get('role_libelle')) ?></p>
</div>

<h2>Mon Historique d'Emprunts</h2>

<?php if (empty($historique)): ?>
    <div style="background: #fff; padding: 20px; border-radius: 8px; text-align: center; color: #666;">
        <p>Vous n'avez aucun historique d'emprunt pour le moment.</p>
    </div>
<?php else: ?>
    <table style="width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
        <thead>
            <tr style="background: #4A6572; color: #fff;">
                <th style="padding: 12px; text-align: left;">Livre</th>
                <th style="padding: 12px; text-align: left;">Date d'emprunt</th>
                <th style="padding: 12px; text-align: left;">Date de retour</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historique as $emprunt): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;"><?= esc($emprunt['titre_livre'] ?? 'Inconnu') ?></td>
                    <td style="padding: 12px;"><?= date('d/m/Y H:i', strtotime($emprunt['date_emprunt'])) ?></td>
                    <td style="padding: 12px;">
                        <?php if (!empty($emprunt['date_retour'])): ?>
                            <?= date('d/m/Y H:i', strtotime($emprunt['date_retour'])) ?>
                        <?php else: ?>
                            <span style="display: inline-block; padding: 4px 8px; background-color: #f0ad4e; color: #fff; border-radius: 4px; font-size: 0.9em;">En cours</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?= $this->endSection() ?>
