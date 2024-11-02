<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="card">

    <?= $this->include('components/Cardheader') ?>

    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover" id="users">
                <thead>
                    <tr>
                        <th scope="col" class="col-1">#</th>
                        <th scope="col">Kode Produk</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)) : ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                    <?php else : ?>
                    <?php foreach ($products as $key => $value) : ?>
                    <tr onclick="location.href='<?= site_url('products/detail/' . $value['id']) ?>'">
                        <th><?= $key + 1 ?></th>
                        <td><?= esc($value['product_code']) ?></td>
                        <td><?= esc($value['product_name']) ?></td>
                        <td><?= esc($value['stock']) ?></td>
                        <td>Rp <?= esc($value['unit_price']) ?></td>
                        <td class="text-truncate" style="max-width: 150px;"><?= esc(($value['description'])) ?></td>
                        <td>
                            <div class="d-flex justify-content-end ">
                                <a class="user-select-none icon-link icon-link-hover text-decoration-none">Detail <i
                                        class="bi bi-chevron-right" style="margin-bottom: 10px;"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

        <?= $this->include('components/partials/pagination') ?>
    </div>
</div>


<?= $this->endSection() ?>