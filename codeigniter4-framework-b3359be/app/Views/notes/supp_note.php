<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3>Supprimer des notes</h3>
    </div>
    <div class="card-body">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success" style="padding:1rem;background-color:#d1fae5;color:#0369a1;border-radius:4px;margin-bottom:1rem;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('notes/delete') ?>" method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">Sélection</th>
                        <th>ID Note</th>
                        <th>Étudiant</th>
                        <th>UE</th>
                        <th>Semestre</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($notes)): ?>
                        <?php foreach($notes as $n): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="notes_ids[]" value="<?= $n['id'] ?>" />
                                </td>
                                <td><?= esc($n['id']) ?></td>
                                <td><?= esc($n['prenom'].' '.$n['nom']) ?></td>
                                <td><?= esc($n['ue_nom']) ?></td>
                                <td><?= esc($n['sem_nom']) ?></td>
                                <td><?= esc($n['note']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6">Aucune note enregistrée.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div style="margin-top: 1rem;">
                <button type="submit" class="btn btn-primary" style="background:#ef4444;border-color:#b91c1c;">Supprimer la sélection</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
