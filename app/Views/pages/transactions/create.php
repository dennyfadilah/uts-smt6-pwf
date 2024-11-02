<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<form method="post" action="<?= site_url('transactions/create') ?>">
    <?= csrf_field() ?>
    <div class="row">

        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Detail Pengiriman</h5>

                    <div class="form-group">
                        <label for="shipping_address">Alamat Pengiriman <span
                                class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required
                            placeholder="Masukkan Alamat Pengiriman"></textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Informasi Produk</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Kategori <span
                                        class="badge rounded-pill text-bg-warning">Wajib</span></label>
                                <select class="form-select" aria-label="Kategori" name="category" id="category"
                                    required>
                                    <option disabled selected>Pilih Kategori</option>
                                    <option value="BW">Body Wash</option>
                                    <option value="FW">Face Wash</option>
                                    <option value="HS">Hand Soap</option>
                                    <option value="DG">Deterjen</option>
                                    <option value="SG">Softener</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_id">Nama Produk <span
                                        class="badge rounded-pill text-bg-warning">Wajib</span></label>
                                <select class="form-select" aria-label="Nama Produk" name="product_id" id="product_id"
                                    required>
                                    <option disabled>Pilih Produk</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantity">Qty <span
                                        class="badge rounded-pill text-bg-warning">Wajib</span></label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required
                                    placeholder="Masukkan Jumlah" min="1">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="unit_price">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="uPrice">Rp</span>
                                    <input type="text" class="form-control" id="unit_price" name="unit_price"
                                        placeholder="Harga" aria-label="Harga" min="0" value="0" step="0.01"
                                        aria-describedby="uPrice" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="count_price">Jumlah Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="cPrice">Rp</span>
                                    <input type="text" class="form-control" id="count_price" name="count_price"
                                        placeholder="Harga" aria-label="Harga" min="0" value="0" step="0.01"
                                        aria-describedby="cPrice" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="notes">Catatan <span class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"
                            placeholder="Masukkan Catatan"></textarea>
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
                            placeholder="Masukan Promo" step="0.01" min="0" max="100">
                    </div>

                    <div class="form-group">
                        <label for="total_price">Total Harga</label>
                        <div class="input-group bg-white">
                            <span class="input-group-text" id="tPrice">Rp</span>
                            <input type="number" class="form-control" id="total_price" name="total_price" required
                                placeholder="Total Harga" step="0.01" min="0" aria-describedby="tPrice" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pembayaran</h5>

                    <div class="form-group mb-3">
                        <label for="payment_method">Metode Pembayaran <span
                                class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <select class="form-control" id="payment_method" name="payment_method" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="cash">Tunai</option>
                            <option value="credit">Kartu Kredit</option>
                            <option value="debit">Kartu Debit</option>
                            <option value="e-wallet">E-Wallet</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>