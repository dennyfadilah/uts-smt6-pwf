<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card mb-2">
            <div class="row justify-content-between p-3">
                <div class="col-md-4">
                    <?php if (!empty($product['image_url']) && file_exists('uploads/products/' . $product['image_url'])) : ?>
                    <img src="<?= base_url('uploads/products/' . $product['image_url']) ?>" alt="Profile Picture"
                        class="img-fluid">
                    <?php else : ?>
                    <div class="card bg-secondary" style="min-width: 50%; height: 250px;"></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-8">
                    <h5 class="card-title">Informasi Produk</h5>

                    <div class="form-group">
                        <label for="product_name" class="fw-medium">Nama Produk</label>
                        <input type="text" name="product_name" id="product_name" class="form-control"
                            placeholder="Nama Produk" value="<?= $product['product_name'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="category" class="fw-medium">Kategori</label>
                        <input type="text" name="category" id="category" class="form-control" value="<?= $category ?>"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Deskripsi"
                            rows="3" readonly><?= $product['description'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="supplier_name" class="fw-medium">Supplier</label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control"
                            placeholder="Supplier" value="<?= $product['supplier_name'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" name="stock" id="stock" class="form-control" placeholder="Stok" min="0"
                            value="<?= $product['stock'] ?>" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-2 p-3">
            <div class="card-body">
                <h5 class="card-title">Informasi Harga</h5>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text" id="price1">Rp</span>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Harga"
                            aria-label="Harga" min="0" aria-describedby="price1" onchange="calculateUnitPrice()"
                            value="<?= $product['unit_price'] / (1 - $product['discount_percentage'] / 100) ?>"
                            readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="discount_percentage">Diskon (%)</label>
                    <input type="number" class="form-control" id="discount_percentage" name="discount_percentage"
                        placeholder="Masukkan Diskon" step="0.01" min="0" max="100" onchange="calculateUnitPrice()"
                        value="<?= $product['discount_percentage'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="unit_price">Harga Satuan Setelah Diskon</label>
                    <div class="input-group">
                        <span class="input-group-text" id="price2">Rp</span>
                        <input type="number" class="form-control" id="unit_price" name="unit_price" placeholder="Harga"
                            aria-label="Harga" min="0" aria-describedby="price2" value="<?= $product['unit_price'] ?>"
                            onchange="calculateUnitPrice()" readonly>
                    </div>
                </div>

            </div>
        </div>

        <?php if (session()->get('user')['role'] == 'admin'): ?>
        <a href="<?= site_url('products/edit/' . $product['id']) ?>" class="btn btn-warning mb-2 w-100">Edit</a>
        <a href="<?= site_url('products/delete/' . $product['id']) ?>" class="btn btn-danger w-100"
            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Delete</a>

        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>