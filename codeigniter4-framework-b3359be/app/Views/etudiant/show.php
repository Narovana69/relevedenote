<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3>Tableau de bord de <?= esc($etudiant['prenom'] . ' ' . $etudiant['nom']) ?></h3>
    </div>
    <div class="card-body">
        <p>Sélectionnez un relevé de notes à consulter :</p>
        <div class="stat-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
            
            <!-- Semestre 3 -->
            <div class="stat-card" style="cursor:pointer;" onclick="window.location.href='<?= base_url('releve/s3/' . $etudiant['id']) ?>'">
                <div class="stat-title">Semestre 3</div>
                <div class="stat-val" style="font-size:1.2rem;">Tronc Commun</div>
            </div>

            <!-- Semestre 4 -->
            <div class="stat-card" style="cursor:pointer;" onclick="window.location.href='<?= base_url('releve/s4/dev/' . $etudiant['id']) ?>'">
                <div class="stat-title">Semestre 4</div>
                <div class="stat-val" style="font-size:1.2rem;">Option Développement</div>
            </div>
            <div class="stat-card" style="cursor:pointer;" onclick="window.location.href='<?= base_url('releve/s4/bddres/' . $etudiant['id']) ?>'">
                <div class="stat-title">Semestre 4</div>
                <div class="stat-val" style="font-size:1.2rem;">Option BDD & Réseaux</div>
            </div>
            <div class="stat-card" style="cursor:pointer;" onclick="window.location.href='<?= base_url('releve/s4/web/' . $etudiant['id']) ?>'">
                <div class="stat-title">Semestre 4</div>
                <div class="stat-val" style="font-size:1.2rem;">Option Web & Design</div>
            </div>

            <!-- Année L2 -->
            <div class="stat-card" style="cursor:pointer; background:#f0f9ff; border-color:#bae6fd;" onclick="window.location.href='<?= base_url('releve/l2/dev/' . $etudiant['id']) ?>'">
                <div class="stat-title">Année L2</div>
                <div class="stat-val" style="font-size:1.2rem;">Moyenne Globale Dev</div>
            </div>
            <div class="stat-card" style="cursor:pointer; background:#f0f9ff; border-color:#bae6fd;" onclick="window.location.href='<?= base_url('releve/l2/bddres/' . $etudiant['id']) ?>'">
                <div class="stat-title">Année L2</div>
                <div class="stat-val" style="font-size:1.2rem;">Moyenne Globale BDD/Res</div>
            </div>
            <div class="stat-card" style="cursor:pointer; background:#f0f9ff; border-color:#bae6fd;" onclick="window.location.href='<?= base_url('releve/l2/web/' . $etudiant['id']) ?>'">
                <div class="stat-title">Année L2</div>
                <div class="stat-val" style="font-size:1.2rem;">Moyenne Globale Web</div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
