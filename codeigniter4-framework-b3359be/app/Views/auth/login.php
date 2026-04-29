<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div style="max-width: 400px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h1 style="text-align: center; margin-bottom: 20px;">Connexion</h1>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>
        
        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Adresse Email :</label>
            <input type="email" name="email" id="email" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 5px;">Mot de passe :</label>
            <input type="password" name="password" id="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <button type="submit" style="width: 100%; padding: 12px; background-color: #4A6572; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
            Se connecter
        </button>
    </form>
</div>
<?= $this->endSection() ?>
