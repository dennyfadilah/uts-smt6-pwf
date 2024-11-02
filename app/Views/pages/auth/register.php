<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<div class="card col-10 col-md-7 form-floating p-3">
    <h3 class="text-decoration-underline text-center">Daftar</h3>

    <?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
            <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('/register') ?>" class="pt-3" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row">

            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Nama Lengkap"
                        autofocus required>
                    <label for="full_name">Nama Lengkap</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                        required>
                    <label for="username" class="form-label">Username</label>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-floating">
                    <input type="date" name="birthdate" id="birthdate" class="form-control" placeholder="Tanggal Lahir"
                        required>
                    <label for="birthdate" class="form-label">Tanggal Lahir</label>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-floating">
                    <select class="form-select" id="gender" name="gender" aria-label="Gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <label for="gender" class="form-label">Gender</label>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-floating">
                    <input type="number" name="phone_number" id="phone_number" class="form-control"
                        placeholder="No. Telepon" required>
                    <label for="phone_number" class="form-label">No. Telepon</label>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="form-floating">
                    <textarea name="address" id="address" placeholder="Alamat" class="form-control"
                        style="height: 100px" required></textarea>
                    <label for="address" class="form-label">Alamat</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                    <label for="email" class="form-label">Email</label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="form-floating">
                    <input type="password" name="password_hash" id="password_hash" class="form-control"
                        placeholder="Password" required>
                    <label for="password_hash" class="form-label">Password</label>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="profile_picture_url">Foto Profile</label>
                    <input type="file" class="form-control form-control-md" id="profile_picture_url"
                        name="profile_picture_url" accept=".jpg, .jpeg, .png">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100 mb-3">Daftar</button>
    </form>

    <p class="text-center my-0">Sudah punya akun?
        <a href="<?= site_url('/login') ?>" class="text-decoration-none">Masuk</a>
    </p>

</div>
<?= $this->endSection() ?>