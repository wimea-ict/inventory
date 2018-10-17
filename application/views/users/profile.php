<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Profile';

        if ($user['id'] == $_SESSION['user']['id']) {
            $heading_button = [
                'title' => 'Edit Profile',
                'link' => site_url("users/edit-profile/{$_SESSION['user']['id']}")
            ];
        }

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

        <table width="100%" class="table table-striped table-bordered table-hover">
            <thead>
                <col style="width: 20%">
                <col style="width: 60%">
                <col>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Name</th>
                    <td><?= ucwords($user['name']); ?></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?= $user['email']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Contacts</th>
                    <td>
                        <?php
                        $contacts = explode('/', $user['contacts']);
                        foreach ($contacts as $contact) {
                            echo "{$contact}<br>";
                        }
                        ?>
                    </td>
                </tr>

                <?php if ($user['id'] == $_SESSION['user']['id']): ?>
                    <tr>
                        <th scope="row">Password</th>
                        <td><a href="<?= site_url('users/change-password'); ?>">Change Password</a></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
</div>