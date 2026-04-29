<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3>Ajouter une nouvelle note</h3>
    </div>
    <div class="card-body">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success" style="padding:1rem;background-color:#d1fae5;color:#0369a1;border-radius:4px;margin-bottom:1rem;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('notes/add') ?>" method="POST" class="form-grid">
            
            <div class="form-group">
                <label>Étudiant</label>
                <select name="idEtudiant" class="form-control" required>
                    <option value="">-- Sélectionnez un étudiant --</option>
                    <?php foreach($etudiants as $e): ?>
                        <option value="<?= $e['id'] ?>"><?= esc($e['nom'].' '.$e['prenom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Semestre / Option</label>
                <select name="idSemestre" class="form-control" required>
                    <option value="">-- Sélectionnez un semestre --</option>
                    <?php foreach($semestres as $s): ?>
                        <option value="<?= $s['id'] ?>"><?= esc($s['nom']) ?> (Option ID: <?= esc($s['idOption']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Unité d'Enseignement (UE)</label>
                <select name="UE" class="form-control" required>
                    <option value="">-- Sélectionnez une UE --</option>
                    <?php foreach($ues as $ue): ?>
                        <option value="<?= $ue['id'] ?>"><?= esc($ue['libelle']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Note (sur 20)</label>
                <input type="number" name="note" class="form-control" step="0.01" min="0" max="20" required />
            </div>

            <div class="form-group" style="grid-column: 1 / -1; margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Enregistrer la note</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
