<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Profile';
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
            <div class="panel-heading">Edit Profile</div>
            <div class="panel-body">
                <form action="<?= base_url("users/edit-profile/{$_SESSION['user']['id']}") ?>" method="post" id="edit-profile-form">
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

                    <input type="submit" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>