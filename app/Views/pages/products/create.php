<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<form method="post" action="<?= site_url('products/create') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Informasi Produk</h5>

                    <div class="form-group">
                        <label for="category" class="fw-medium">Kategori <span
                                class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <select class="form-select" aria-label="Kategori" name="category" id="category" required>
                            <option disabled selected>Pilih Kategori</option>
                            <option value="BW">Body Wash</option>
                            <option value="FW">Face Wash</option>
                            <option value="HS">Hand Soap</option>
                            <option value="DG">Deterjen</option>
                            <option value="SG">Softener</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="product_name" class="fw-medium">Nama Produk <span
                                class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <input type="text" name="product_name" id="product_name" class="form-control"
                            placeholder="Nama Produk" required>
                    </div>

                    <div class="form-group">
                        <label for="supplier_name" class="fw-medium">Supplier <span
                                class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control"
                            placeholder="Supplier" required>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Detail Produk</h5>

                    <div class="form-group">
                        <label for="image_url" class="form-label">Gambar <span
                                class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <input type="file" name="image_url" class="form-control" id="image_url" placeholder="Gambar"
                            accept=".jpg, .jpeg, .png" required>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi <span
                                class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <textarea class="form-control" name="description" id="description" placeholder="Deskripsi"
                            required></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Pengelolaan Produk</h5>

                    <div class="form-group">
                        <label for="stock" class="form-label">Stok <span
                                class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <input type="number" name="stock" id="stock" class="form-control" placeholder="Stok" min="0"
                            required />
                    </div>

                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Harga</h5>

                    <div class="form-group">
                        <label for="price">Harga <span class="badge rounded-pill text-bg-warning">Wajib</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="price1">Rp</span>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Harga"
                                aria-label="Harga" min="0" aria-describedby="price1" onchange="calculateUnitPrice()"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="discount_percentage">Diskon (%)</label>
                        <input type="number" class="form-control" id="discount_percentage" name="discount_percentage"
                            placeholder="Masukkan Diskon" step="0.01" min="0" max="100" value="0"
                            onchange="calculateUnitPrice()" required>
                    </div>

                    <div class="form-group">
                        <label for="unit_price">Harga Satuan</label>
                        <div class="input-group">
                            <span class="input-group-text" id="price2">Rp</span>
                            <input type="number" class="form-control" id="unit_price" name="unit_price"
                                placeholder="Harga" aria-label="Harga" min="0" aria-describedby="price2" readonly
                                onchange="calculateUnitPrice()">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Simpan</button>
        </div>
    </div>
</form>



<?= $this->endSection() ?>