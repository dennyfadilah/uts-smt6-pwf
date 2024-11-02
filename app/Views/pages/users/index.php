<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="card">

    <?= $this->include('components/Cardheader'); ?>

    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover" id="users">
                <thead>
                    <tr>
                        <th scope="col" class="col-1">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No. Telepon</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)) : ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                    <?php else : ?>
                    <?php foreach ($users as $key => $value) : ?>
                    <tr onclick="location.href='<?= site_url('/users/detail/' . $value['id']) ?>'">
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><?= esc($value['full_name']) ?></td>
                        <td><?= esc($value['phone_number']) ?></td>
                        <td><?= esc($value['email']) ?></td>
                        <td><?= esc($value['role'] == 'admin' ? 'Admin' : 'User') ?></td>
                        <td>
                            <div class="d-flex justify-content-end ">
                                <a class="user-select-none icon-link icon-link-hover text-decoration-none">Detail <i
                                        class="bi bi-chevron-right" style="margin-bottom: 10px;"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?= $this->include('components/partials/pagination') ?>
    </div>
</div>


<?= $this->endSection() ?>