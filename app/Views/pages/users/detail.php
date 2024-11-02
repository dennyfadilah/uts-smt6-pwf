<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-4 mb-2">
                        <div class="d-flex justify-content-center">
                            <?php if (!empty($user['profile_picture_url']) && file_exists('uploads/profiles/' . $user['profile_picture_url'])) : ?>
                            <img src="<?= base_url('uploads/profiles/' . $user['profile_picture_url']) ?>"
                                alt="Profile Picture" width="250">
                            <?php else : ?>
                            <div class="card bg-secondary" style="width: 250px; height: 250px;"></div>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="col-md-8">
                        <h5 class="card-title">Informasi Pribadi</h5>

                        <div class="form-group">
                            <label for="full_name">Nama Lengkap</label>
                            <input type="text" name="full_name" id="full_name" class="form-control"
                                placeholder="Nama Lengkap" value="<?= $user['full_name'] ?>" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birthdate">Tanggal Lahir</label>
                                    <input type="text" name="birthdate" id="birthdate" class="form-control"
                                        placeholder="Tanggal Lahir"
                                        value="<?= date('d F Y', strtotime($user['birthdate'])) ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <input type="text" name="gender" id="gender" class="form-control"
                                        value="<?= ucfirst($user['gender']) ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Informasi Kontak</h5>

                <div class="form-group">
                    <label for="phone_number">Nomor Telepon</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                        value="<?= $user['phone_number'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address" class="form-control" style="height: 80px;"
                        readonly><?= $user['address'] ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Informasi Akun</h5>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                        value="<?= $user['username'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                        value="<?= $user['email'] ?>" readonly>
                </div>

                <?php if (session()->get('user')['role'] == 'admin') : ?>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" name="role" id="role" class="form-control" value="<?= ucfirst($user['role']) ?>"
                        readonly>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (session()->get('user')['role'] == 'admin') : ?>
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Status Akun</h5>

                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="form-control"
                        value="<?= ucfirst($user['status']) ?>" readonly>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <a href="<?= site_url('users/edit/' . $user['id']) ?>" class="btn btn-warning mb-2 w-100">Edit</a>
        <?php
        if (session()->get('user')['role'] == 'admin' && $user['id'] != session()->get('user')['id']) {
            echo '<a href="' . site_url('users/delete/' . $user['id']) . '" class="btn btn-danger w-100" onclick="return confirm(\'Apakah Anda yakin ingin menghapus user ini?\')">Delete</a>';
        }
        ?>
    </div>
</div>
<?= $this->endSection() ?>