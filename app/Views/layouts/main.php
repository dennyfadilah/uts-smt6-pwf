<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= base_url('vendor/bootstrap/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('vendor/bootstrap-icons/font/bootstrap-icons.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body class="bg-body-tertiary">
    <?= $this->renderSection('auth') ?>
    <?= $this->renderSection('dashboard') ?>


    <script src="<?= base_url('vendor/jquery/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('vendor/bootstrap/bootstrap.bundle.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/script.js') ?>" type="text/javascript"></script>


</body>

</html>