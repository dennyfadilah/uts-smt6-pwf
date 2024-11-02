<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>


<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php
            $errors = session()->getFlashdata('errors');
            if (is_array($errors)) :
                foreach ($errors as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach;
            else : ?>
                <li><?= esc($errors) ?></li>
            <?php endif; ?>

        </ul>
    </div>
<?php endif; ?>

<div class="row">

    <div class="col-md-8">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Detail Penjualan</h5>

                <div class="form-group">
                    <label for="transaction_date">Tanggal Penjualan</label>
                    <input type="datatime" class="form-control" id="transaction_date" name="transaction_date"
                        value="<?= $transaction['transaction_date'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="full_name">Nama Penjual</label>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                        value="<?= $transaction['full_name'] ?>" readonly>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Detail Pengiriman</h5>

                <div class="form-group">
                    <label for="shipping_address">Alamat Pengiriman</label>
                    <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" readonly
                        placeholder="Masukkan Alamat Pengiriman"><?= $transaction['shipping_address'] ?></textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Informasi Produk</h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" class="form-control" id="category" name="category"
                                value="<?= $category ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_id">Nama Produk</label>
                            <input type="text" class="form-control" id="product_id" name="product_id"
                                value="<?= $transaction['product_name'] ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Qty</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required
                                placeholder="Masukkan Jumlah" min="1" value="<?= $transaction['quantity'] ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="unit_price">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text" id="uPrice">Rp</span>
                                <input type="text" class="form-control" id="unit_price" name="unit_price"
                                    placeholder="Harga" aria-label="Harga" min="0" step="0.01" aria-describedby="uPrice"
                                    value="<?= $transaction['unit_price'] ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="count_price">Jumlah Harga</label>
                            <div class="input-group">
                                <span class="input-group-text" id="cPrice">Rp</span>
                                <input type="text" class="form-control" id="count_price" name="count_price"
                                    placeholder="Harga" aria-label="Harga" min="0" value="<?= $count_price ?>"
                                    step="0.01" aria-describedby="cPrice" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="form-group mb-2">
                    <label for="notes">Catatan</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Masukkan Catatan"
                        readonly><?= $transaction['notes'] ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Harga</h5>

                <div class="form-group">
                    <label for="discount_applied">Promo</label>
                    <input type="number" class="form-control" id="discount_applied" name="discount_applied"
                        placeholder="Masukan Promo" step="0.01" min="0" max="100"
                        value="<?= $transaction['discount_applied'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="total_price">Total Harga</label>
                    <div class="input-group bg-white">
                        <span class="input-group-text" id="tPrice">Rp</span>
                        <input type="number" class="form-control" id="total_price" name="total_price" required
                            placeholder="Total Harga" step="0.01" min="0" aria-describedby="tPrice"
                            value="<?= $transaction['total_price'] ?>" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Pembayaran</h5>

                <div class="form-group">
                    <label for="payment_method">Metode Pembayaran</label>
                    <input type="text" class="form-control" id="payment_method" name="payment_method"
                        value="<?= ucfirst($transaction['payment_method']) ?>" readonly>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Status Transaksi</h5>

                <div class="form-group">
                    <label for="payment_method">Status</label>
                    <input type="text" class="form-control" id="payment_method" name="payment_method"
                        value="<?= ucfirst($transaction['transaction_status']) ?>" readonly>
                </div>
            </div>
        </div>
        <a href="<?= site_url('transactions/edit/' . $transaction['id']) ?>" class="btn btn-warning w-100 mb-2">Edit</a>

        <a href="<?= site_url('transactions/delete/' . $transaction['id']) ?>" class="btn btn-danger w-100"
            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
    </div>
</div>

<?= $this->endSection() ?>