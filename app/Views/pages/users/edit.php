<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<form action="<?= site_url('users/edit/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Informasi Pribadi</h5>

                    <div class="form-group">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" name="full_name" id="full_name" class="form-control"
                            placeholder="Nama Lengkap" value="<?= $user['full_name'] ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthdate">Tanggal Lahir</label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control"
                                    placeholder="Tanggal Lahir" value="<?= $user['birthdate'] ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-select" required>
                                    <option value="male" <?= $user['gender'] == 'male' ? 'selected' : '' ?>>Male
                                    </option>
                                    <option value="female" <?= $user['gender'] == 'female' ? 'selected' : '' ?>>Female
                                    </option>
                                    <option value="other" <?= $user['gender'] == 'other' ? 'selected' : '' ?>>Other
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="profile_picture_url">Foto Profil</label>
                        <input type="file" name="profile_picture_url" id="profile_picture_url" class="form-control"
                            placeholder="Foto Profil" accept=".jpg, .jpeg, .png">
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Informasi Kontak</h5>

                    <div class="form-group">
                        <label for="phone_number">Nomor Telepon</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                            value="<?= $user['phone_number'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" class="form-control" style="height: 80px;"
                            required><?= $user['address'] ?></textarea>
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
                            value="<?= $user['username'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                            value="<?= $user['email'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password_hash">Password</label>
                        <input type="password" name="password_hash" id="password_hash" class="form-control"
                            placeholder="Password">
                    </div>

                    <?php if (session()->get('user')['role'] == 'admin') : ?>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Status Akun</h5>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="active" <?= $user['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= $user['status'] == 'inactive' ? 'selected' : '' ?>>Inactive
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Simpan</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>