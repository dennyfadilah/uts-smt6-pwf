<nav class="navbar dark:bg-dark bg-success sticky-top shadow-md">
    <div class="container-fluid px-3">
        <button class="btn d-none d-md-block" id="btnSidebar" type="button">
            <i class="bi bi-list text-light"></i>
        </button>

        <a class="navbar-brand d-md-none text-light fw-bold" href="<?= base_url('/') ?>">Denny Fadilah</a>

        <div class="d-flex align-items-center gap-2">


            <div class="btn-group">
                <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if (!empty(session()->get('user')['profile_picture_url']) && file_exists('uploads/profiles/' . session()->get('user')['profile_picture_url'])) : ?>
                        <img src="<?= base_url('uploads/profiles/' . session()->get('user')['profile_picture_url']) ?>"
                            alt="Profile Picture" style="width: 25px; height: 25px;" class="rounded-circle"> <span
                            class="fw-bold d-none d-md-block"><?= session()->get('user')['full_name'] ?></span>
                    <?php else : ?>
                        <img src="<?= base_url('assets/image/avatar/man-1.png') ?>" alt="profile" class=""
                            style="width: 25px;"> <span
                            class="fw-bold d-none d-md-block"><?= session()->get('user')['full_name'] ?></span>
                    <?php endif; ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="<?= site_url('users/detail/' . session()->get('user')['id']) ?>">
                            <i class="bi bi-person"></i> Profile</a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item" href="<?= site_url('logout') ?>">
                            <i class="bi bi-box-arrow-right"></i> Logout</a>
                    </li>
                </ul>
            </div>

            <button class="navbar-toggler d-md-none btn-outline-light" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-light"></span>
            </button>
        </div>


        <div class="offcanvas offcanvas-end d-md-none bg-dark" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?= $this->include('components/partials/Menubar') ?>
            </div>
        </div>
    </div>
</nav>