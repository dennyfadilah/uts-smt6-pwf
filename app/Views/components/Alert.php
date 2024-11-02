<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger">
        <ul class="list-unstyled my-0">
            <?php
            $errors = session()->getFlashdata('errors');
            if (is_array($errors)) :
                foreach ($errors as $error) : ?>
                    <li><i class="bi bi-x-circle"></i> <?= esc($error) ?></li>
                <?php endforeach;
            else : ?>
                <li><i class="bi bi-x-circle"></i> <?= esc($errors) ?></li>
            <?php endif; ?>

        </ul>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>