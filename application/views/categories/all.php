<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <?php
        $page_heading = 'Categories';
        $heading_button = [
            'title' => 'New Category',
            'link' => site_url('categories/create')
        ];
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

        <!-- Categories -->
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
            <!-- Fix width of columns -->
            <colgroup>
                <col style="width: 7.1833%">
                <col style="width: 45.0413%">
                <col style="width: 17.3252%">
                <col style="width: 17.3252%">
                <col>
            </colgroup>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Number of Items</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($categories as $category):
                ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= ucwords($category['name']); ?></td>
                        <td><?= $category['num_items']; ?></td>
                        <td><?= (new DateTime($category['date_entered']))->format('F jS, Y'); ?></td>
                        <td><a href="<?= site_url("categories/edit/{$category['id']}"); ?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
</div>
