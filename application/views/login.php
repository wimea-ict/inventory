<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login - WIMEA-ICT INVENTORY MANAGEMENT SYSTEM</title>

        <!-- Bootstrap core CSS -->
        <link href="<?= base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link rel="stylesheet" href="<?= base_url("css/login.css"); ?>">
    </head>

    <body>
        <form action="<?= base_url("auth/login"); ?>" method="post">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['message']; ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <input type="submit" value="Login" class="btn btn-primary">
        </form>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?= base_url("assets/vendor/jquery/jquery.min.js"); ?>"></script>
        <script src="<?= base_url("assets/vendor/bootstrap/js/bootstrap.min.js"); ?>"></script>
    </body>
</html>
