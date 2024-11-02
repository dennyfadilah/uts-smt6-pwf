<?php
$uri = service('uri');
$segment = $uri->getSegment(1);
?>

<div class="card-header bg-white">
    <div class="row">
        <div class="col-md-4">
            <div class="d-flex gap-2 justify-content-between">
                <form method="post" action="<?= base_url($segment) ?>" style="min-width: 25%;">
                    <select class="form-select  my-1" aria-label="Item List" name="limit" onchange="this.form.submit()">
                        <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
                        <option value="15" <?= $limit == 15 ? 'selected' : '' ?>>15</option>
                        <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20</option>
                    </select>
                </form>

                <form method="post" action="<?= base_url($segment) ?>" class="w-100">
                    <div class="input-group border rounded  my-0">
                        <input type="text" name="search" class="form-control border-0" placeholder="Cari..."
                            value="<?= $search ?? '' ?>">
                        <button class="btn border-0" type="button" data-bs-toggle="tooltip" data-bs-title="Reset"
                            data-bs-placement="bottom">
                            <i class="bi bi-x icon"
                                onclick="location.replace('<?= base_url($segment) ?>')"></i></button>
                        <button class="btn btn-primary border-2" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <?php if ((session()->get('user')['role'] == 'user' && $segment == 'transactions') || (session()->get('user')['role'] == 'admin' && $segment != 'users')) : ?>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <a href="<?= base_url($segment . '/create') ?>" class="btn btn-success">Tambah</a>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>