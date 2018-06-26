<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Settings';
        require_once(__DIR__ . '/../partials/page-header.php');
        ?>

        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-dismissable alert-<?= $_SESSION['message_class']; ?>">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <?= $_SESSION['message']; ?>
            </div>
        <?php
            unset($_SESSION['message']);
            endif;
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">Change Password</div>
            <div class="panel-body">
                <form action="<?= base_url('users/change-password'); ?>" method="post" id="change-password-form">
                    <div class="form-group">
                        <label for="old-password">Old Password</label>
                        <input type="password" name="old_password" id="old-password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password1">New Password</label>
                        <input type="password" name="password1" id="password1" class="form-control" minlength="5" required>
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" name="password2" id="password2" class="form-control" minlength="5" required>
                    </div>

                    <input type="submit" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>