<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="col-md-12 d-flex justify-content-center mb-3">
    <img src="<?= base_url('assets/image/background/welcome.svg') ?>" alt="" class="img-fluid" style="width: 500px">
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card p-3">
            <div class="container my-3">
                <h5 class="card-title">Transaksi Perbulan</h5>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-people-fill fs-1"></i>
                        </div>
                        <div>
                            <h5 class="m-0"><?= $transaksiPerbulan['total'] ?></h5>
                            <p class="m-0">Total</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            <div class="container my-3">
                <h5 class="card-title">Total Transaksi</h5>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-people-fill fs-1"></i>
                        </div>
                        <div>
                            <h5 class="m-0"><?= $totalTransaksi['total'] ?></h5>
                            <p class="m-0">Total</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            <div class="container my-3">
                <h5 class="card-title">Transaksi Selesai</h5>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-people-fill fs-1"></i>
                        </div>
                        <div>
                            <h5 class="m-0"><?= $transaksiSelesai['total'] ?></h5>
                            <p class="m-0">Total</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection() ?>