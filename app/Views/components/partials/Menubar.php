<?php
$uri = service('uri');
$segment = $uri->getSegment(1);
?>

<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a class="nav-link <?= ($segment === '') ? 'bg-success active' : '' ?>" href="<?= base_url('/') ?>">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?= ($segment === 'products') ? 'bg-success active' : '' ?>"
            href="<?= base_url('/products') ?>">
            <i class="bi bi-box-seam"></i> Produk
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?= ($segment === 'transactions') ? 'bg-success active' : '' ?>"
            href="<?= base_url('/transactions') ?>">
            <i class="bi bi-receipt"></i> Transaksi
        </a>
    </li>

    <?php if (session()->get('user')['role'] == 'admin') : ?>
        <li class="nav-item">
            <a class="nav-link <?= ($segment === 'users') ? 'bg-success active' : '' ?>" href="<?= base_url('/users') ?>">
                <i class="bi bi-person-gear"></i> Manage Users
            </a>
        </li>
    <?php endif; ?>
</ul>