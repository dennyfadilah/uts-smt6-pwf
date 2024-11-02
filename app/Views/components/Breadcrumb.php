<?php
$title = [
    '' => 'Dashboard',
    'transactions' => 'Transaksi',
    'products' => 'Produk',
    'users' => 'Users',
    'detail' => 'Detail',
    'create' => 'Tambah',
    'edit' => 'Edit',
];

$uri = service('uri');
$segment1 = $uri->getSegment(1);
$segment2 = null;

if ($uri->getTotalSegments() >= 2) {
    $segment2 = $uri->getSegment(2);
}
?>

<div class="row justify-content-between align-items-center mb-3">
    <div class="col-md-6">
        <h3 class="my-0">
            <?php
            if ($segment2) {
                echo ucfirst($title[$segment2]) . ' ' . ucfirst($title[$segment1]);
            } else {
                echo ucfirst($title[$segment1]);
            }
            ?>
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>" class="text-black">
                        <i class="bi bi-house-door"></i>
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-black text-decoration-none"
                        href="<?= base_url('/' . $segment1) ?>"><?= $title[$segment1] ?? 'Dashboard' ?></a>
                </li>

                <?php if ($segment2) : ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= ucfirst($segment2) ?>
                </li>
                <?php endif ?>
            </ol>
        </nav>
    </div>

    <div class="col-md-6">
        <div class="d-flex justify-content-end"><?= $this->include('components/Alert') ?></div>
    </div>
</div>