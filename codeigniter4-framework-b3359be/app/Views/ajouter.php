<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<a href="<?= site_url('catalogue') ?>" class="back-link">Retour au catalogue</a>

<div class="form-container">
    <h1 class="form-title">Ajouter un nouvel ouvrage</h1>

    <form action="<?= site_url('catalogue/ajouter') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="titre">Titre du livre *</label>
            <input type="text" id="titre" name="titre" value="<?= esc(old('titre')) ?>" required>
            <?php if (session()->has('errors') && isset(session('errors')['titre'])): ?>
                <span class="error-message"><?= esc(session('errors')['titre']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="auteur">Auteur *</label>
            <input type="text" id="auteur" name="auteur" value="<?= esc(old('auteur')) ?>" required>
            <?php if (session()->has('errors') && isset(session('errors')['auteur'])): ?>
                <span class="error-message"><?= esc(session('errors')['auteur']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="isbn">Numero ISBN *</label>
            <input type="text" id="isbn" name="isbn" value="<?= esc(old('isbn')) ?>" required>
            <?php if (session()->has('errors') && isset(session('errors')['isbn'])): ?>
                <span class="error-message"><?= esc(session('errors')['isbn']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="annee_publication">Annee de sortie *</label>
            <input type="number" id="annee_publication" name="annee_publication" value="<?= esc(old('annee_publication')) ?>" max="<?= date('Y') ?>" required>
            <?php if (session()->has('errors') && isset(session('errors')['annee_publication'])): ?>
                <span class="error-message"><?= esc(session('errors')['annee_publication']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="categorie">Categorie *</label>
            <select id="categorie" name="categorie" required>
                <option value="">Selectionnez une categorie</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= esc($cat) ?>" <?= old('categorie') === $cat ? 'selected' : '' ?>>
                        <?= esc($cat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (session()->has('errors') && isset(session('errors')['categorie'])): ?>
                <span class="error-message"><?= esc(session('errors')['categorie']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="resume">Resume</label>
            <textarea id="resume" name="resume" rows="4"><?= esc(old('resume')) ?></textarea>
        </div>

        <div class="form-group">
            <label for="couverture">Couverture (jpeg, png, webp - max 2 Mo)</label>
            <input type="file" id="couverture" name="couverture" accept="image/jpeg,image/png,image/webp">
            <?php if (session()->has('errors') && isset(session('errors')['couverture'])): ?>
                <span class="error-message"><?= esc(session('errors')['couverture']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-submit">Enregistrer</button>
    </form>
</div>
<?= $this->endSection() ?>
