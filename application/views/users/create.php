<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$page_heading = 'Users';
require_once(__DIR__ . '/../partials/page-header.php');
?>

<div class="row">
    <div class="col-lg-8">
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
            <div class="panel-heading"><?= $panel_heading; ?></div>
            <div class="panel-body">
                <form action="" method="post" id="create-user-form">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="first-name">First Name</label>
                                <input type="text" name="first_name" id="first-name" class="form-control" minlength="2"
                                    <?= isset($user) ? " value='{$user['first_name']}'" : ''; ?> required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="other-names">Other Names</label>
                                <input type="text" name="other_names" id="other-names" class="form-control" minlength="2"
                                    <?= isset($user) ? " value='{$user['other_names']}'" : ''; ?> required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            <?= isset($user) ? " value='{$user['email']}'" : ''; ?> required>
                    </div>
                    <div class="form-group">
                        <label for="contacts">Phone Numbers</label>
                        <input type="text" name="contacts" id="contacts" class="form-control" minlength="10"
                            <?= isset($user) ? " value='{$user['contacts']}'" : ''; ?> required>
                        <span class="help-block">Separate multiple contacts with the slash(/) character</span>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" minlength="4"
                            <?= isset($user) ? " value='{$user['username']}'" : ''; ?> required>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password1" id="password" class="form-control" minlength="5" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" name="password2" id="confirm-password" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>