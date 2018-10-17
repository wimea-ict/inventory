<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <?php
        $page_heading = 'Users';
        if ($_SESSION['user']['username'] == 'admin') {
            $heading_button = [
                'title' => 'New User',
                'link' => site_url('users/create')
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

        <!-- Users -->
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
            <!-- Fix width of columns -->
            <colgroup>
                <col style="width: 7.1833%">
                <col style="width: 30.4715%">
                <col style="width: 29.6664%">
                <col style="width: 15.9875%">
                <col>
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contacts</th>
                    <th>Since</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($users as $user):
                ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= ucwords($user['name']); ?></td>
                        <td><?= $user['email']; ?></td>
                        <td>
                            <?php
                            $contacts = explode('/', $user['contacts']);
                            foreach ($contacts as $contact) {
                                echo "{$contact}<br>";
                            }
                            ?>
                        </td>
                        <td><?= (new DateTime($user['date_entered']))->format('F jS, Y'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
</div>