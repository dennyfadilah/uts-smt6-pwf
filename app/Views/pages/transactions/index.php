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
                        <th>Tanggal</th>
                        <th>Nama Sales</th>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transactions)) : ?>
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($transactions as $key => $value) : ?>
                            <tr onclick="location.href='<?= site_url('transactions/detail/' . $value['id']) ?>'">
                                <th><?= $key + 1 ?></th>
                                <td><?= esc(date('d F Y', strtotime($value['transaction_date']))) ?></td>
                                <td><?= esc($value['full_name']) ?></td>
                                <td><?= esc($value['product_name']) ?></td>
                                <td><?= esc($value['quantity']) ?></td>
                                <td>Rp <?= esc($value['unit_price']) ?></td>
                                <td>Rp <?= esc($value['total_price']) ?></td>
                                <td>
                                    <?php
                                    $badge = [
                                        'completed' => 'success',
                                        'pending' => 'warning text-dark',
                                        'cancelled' => 'danger'
                                    ];

                                    echo '<span class="badge bg-' . $badge[$value['transaction_status']] . '">' . ucfirst($value['transaction_status']) . '</span>';
                                    ?>
                                </td>
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