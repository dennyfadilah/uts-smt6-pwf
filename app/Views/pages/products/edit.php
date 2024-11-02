<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<form method="post" action="<?= site_url('products/edit/' . $product['id']) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Informasi Produk</h5>

                    <div class="form-group">
                        <label for="category" class="fw-medium">Kategori</label>
                        <select class="form-select" aria-label="Kategori" name="category" id="category" required>
                            <option disabled selected>Pilih Kategori</option>
                            <option value="BW" <?= $product['category'] == 'BW' ? 'selected' : '' ?>>Body Wash</option>
                            <option value="FW" <?= $product['category'] == 'FW' ? 'selected' : '' ?>>Face Wash</option>
                            <option value="HS" <?= $product['category'] == 'HS' ? 'selected' : '' ?>>Hand Soap</option>
                            <option value="DG" <?= $product['category'] == 'DG' ? 'selected' : '' ?>>Deterjen</option>
                            <option value="SG" <?= $product['category'] == 'SG' ? 'selected' : '' ?>>Softener</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="product_name" class="fw-medium">Nama Produk</label>
                        <input type="text" name="product_name" id="product_name" class="form-control"
                            placeholder="Nama Produk" value="<?= $product['product_name'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="supplier_name" class="fw-medium">Supplier</label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control"
                            placeholder="Supplier" value="<?= $product['supplier_name'] ?>" required>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Detail Produk</h5>

                    <div class="form-group">
                        <label for="image_url" class="form-label">Gambar</label>
                        <input type="file" name="image_url" class="form-control" id="image_url" placeholder="Gambar"
                            accept=".jpg, .jpeg, .png" value="<?= $product['image_url'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Deskripsi"
                            required><?= $product['description'] ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Pengelolaan Produk</h5>

                    <div class="form-group">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" name="stock" id="stock" class="form-control" placeholder="Stok" min="0"
                            value="<?= $product['stock'] ?>" required />
                    </div>

                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Harga</h5>

                    <div class="form-group">
                        <label for="price">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text" id="price1">Rp</span>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Harga"
                                aria-label="Harga" min="0" aria-describedby="price1" onchange="calculateUnitPrice()"
                                value="<?= $product['unit_price'] / (1 - $product['discount_percentage'] / 100) ?>"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="discount_percentage">Diskon (%)</label>
                        <input type="number" class="form-control" id="discount_percentage" name="discount_percentage"
                            placeholder="Masukkan Diskon" step="0.01" min="0" max="100" onchange="calculateUnitPrice()"
                            value="<?= $product['discount_percentage'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="unit_price">Harga Satuan</label>
                        <div class="input-group">
                            <span class="input-group-text" id="price2">Rp</span>
                            <input type="number" class="form-control" id="unit_price" name="unit_price"
                                placeholder="Harga" aria-label="Harga" min="0" aria-describedby="price2"
                                value="<?= $product['unit_price'] ?>" onchange="calculateUnitPrice()" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Simpan</button>
        </div>
    </div>
</form>



<?= $this->endSection() ?>