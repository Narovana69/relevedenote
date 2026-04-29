<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3>Étudiants inscrits</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($etudiants)): ?>
                    <?php foreach($etudiants as $e): ?>
                        <tr>
                            <td><?= esc($e['id']) ?></td>
                            <td><?= esc($e['nom']) ?></td>
                            <td><?= esc($e['prenom']) ?></td>
                            <td>
                                <a href="<?= base_url('etudiants/'.$e['id']) ?>" class="btn btn-primary btn-sm">Détails</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Aucun étudiant trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
