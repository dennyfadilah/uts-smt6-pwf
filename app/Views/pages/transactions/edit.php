<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<form method="post" action="<?= site_url('transactions/edit/' . $transaction['id']) ?>">
    <?= csrf_field() ?>

    <input type="hidden" name="user_id" value="<?= $transaction['user_id'] ?>">
    <div class="row">

        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Detail Pengiriman</h5>

                    <div class="form-group">
                        <label for="shipping_address">Alamat Pengiriman</label>
                        <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3"
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
                                <select class="form-select" aria-label="Kategori" name="category" id="category"
                                    required>
                                    <option disabled selected>Pilih Kategori</option>
                                    <option value="BW" <?= $transaction['category'] == 'BW' ? 'selected' : '' ?>>Body
                                        Wash</option>
                                    <option value="FW" <?= $transaction['category'] == 'FW' ? 'selected' : '' ?>>Face
                                        Wash</option>
                                    <option value="HS" <?= $transaction['category'] == 'HS' ? 'selected' : '' ?>>Hand
                                        Soap</option>
                                    <option value="DG" <?= $transaction['category'] == 'DG' ? 'selected' : '' ?>>
                                        Deterjen</option>
                                    <option value="SG" <?= $transaction['category'] == 'SG' ? 'selected' : '' ?>>
                                        Softener</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_id">Nama Produk</label>
                                <select class="form-select" aria-label="Nama Produk" name="product_id" id="product_id"
                                    required>
                                    <option disabled>Pilih Produk</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?= $product['id'] ?>"
                                            <?= ($product['id'] == $transaction['product_id']) ? 'selected' : '' ?>>
                                            <?= $product['product_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantity">Qty</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required
                                    placeholder="Masukkan Jumlah" min="1" value="<?= $transaction['quantity'] ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="unit_price">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="uPrice">Rp</span>
                                    <input type="text" class="form-control" id="unit_price" name="unit_price"
                                        placeholder="Harga" aria-label="Harga" min="0" step="0.01"
                                        aria-describedby="uPrice" value="<?= $transaction['unit_price'] ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="count_price">Jumlah Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="cPrice">Rp</span>
                                    <input type="text" class="form-control" id="count_price" name="count_price"
                                        placeholder="Harga" aria-label="Harga" min="0" step="0.01"
                                        aria-describedby="cPrice" value="<?= $count_price ?>" readonly>
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
                        <textarea class="form-control" id="notes" name="notes" rows="3"
                            placeholder="Masukkan Catatan"><?= $transaction['notes'] ?></textarea>
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
                            value="<?= $transaction['discount_applied'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="total_price">Total Harga</label>
                        <div class="input-group bg-white">
                            <span class="input-group-text" id="tPrice">Rp</span>
                            <input type="number" class="form-control" id="total_price" name="total_price" readonly
                                placeholder="Total Harga" step="0.01" min="0" aria-describedby="tPrice"
                                value="<?= $transaction['total_price'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Pembayaran</h5>

                    <div class="form-group mb-3">
                        <label for="payment_method">Metode Pembayaran</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option disabled>Pilih Metode Pembayaran</option>
                            <option value="cash" <?= $transaction['payment_method'] == 'cash' ? 'selected' : '' ?>>Tunai
                            </option>
                            <option value="credit" <?= $transaction['payment_method'] == 'credit' ? 'selected' : '' ?>>
                                Kartu Kredit</option>
                            <option value="debit" <?= $transaction['payment_method'] == 'debit' ? 'selected' : '' ?>>
                                Kartu Debit</option>
                            <option value="e-wallet"
                                <?= $transaction['payment_method'] == 'e-wallet' ? 'selected' : '' ?>>E-Wallet</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Status Transaksi</h5>

                    <div class="form-group">
                        <label for="transaction_status">Status</label>
                        <select class="form-select" id="transaction_status" name="transaction_status" required>
                            <option disabled>Pilih Status</option>
                            <option value="pending"
                                <?= $transaction['transaction_status'] == 'pending' ? 'selected' : '' ?>>
                                Pending
                            </option>
                            <option value="completed"
                                <?= $transaction['transaction_status'] == 'completed' ? 'selected' : '' ?>>
                                Selesai</option>
                            <option value="cancelled"
                                <?= $transaction['transaction_status'] == 'cancelled' ? 'selected' : '' ?>>
                                Dibatalkan</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Submit</button>
        </div>
    </div>
</form>

<?= $this->endSection() ?>