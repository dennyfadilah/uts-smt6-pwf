<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<title>App</title>

<div class="container p-5">
    <div class="card p-2 bg-warning text-center">
        <i class="bi bi-exclamation-triangle fs-1"></i>
        <p class="lead my-0">Views/app</p>
    </div>
</div>
<?= $this->endSection() ?>