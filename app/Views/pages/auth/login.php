<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="card col-md-3 col-10 p-3">
    <h3 class="text-decoration-underline text-center">Masuk</h3>

    <?= $this->include('components/Alert') ?>

    <form method="post" action="<?= site_url('/login') ?>" class="pt-3">
        <?= csrf_field() ?>

        <div class="form-floating mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" autofocus required>
            <label for="email" class="form-label">Email</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="password_hash" id="password_hash" class="form-control" placeholder="Password"
                required>
            <label for="password_hash" class="form-label">Password</label>
        </div>

        <button type="submit" class="btn btn-success w-100 mb-3">Masuk</button>
    </form>

    <p class="text-center">Belum punya akun?
        <a href="<?= site_url('/register') ?>" class="text-decoration-none">Daftar</a>
    </p>
</div>
<?= $this->endSection() ?>