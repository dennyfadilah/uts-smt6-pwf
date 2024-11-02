<?= $this->extend('layouts/main') ?>

<?= $this->section('auth') ?>
<div class="custom-bg ">
    <div class="position-relative z-1 d-flex justify-content-center align-items-center flex-column min-vh-100">
        <?= $this->renderSection('content') ?>
    </div>
</div>
<?= $this->endSection() ?>