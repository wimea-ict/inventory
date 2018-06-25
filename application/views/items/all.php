<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <?php
        $page_heading = 'Items';
        $heading_button = [
            'title' => 'New Item',
            'link' => base_url('items/create')
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
        
        <!-- Items -->
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
            <!-- Fix width of the columns -->
            <colgroup>
                <col style="width: 7.1833%">
                <col style="width: 19.1989%">
                <col style="width: 14.1786%">
                <col style="width: 15.6555%">
                <col style="width: 15.171%">
                <col style="width: 16.6786%">
                <col>
            </colgroup>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Since</th>
                    <th>Number In</th>
                    <th>Number Out</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($items as $item):
                ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= ucwords($item['name']); ?></td>
                        <td><?= ucwords($item['category_name']); ?></td>
                        <td><?= (new DateTime($item['date_entered']))->format('F jS, Y'); ?></td>
                        <td<?= ($item['number_in'] == 0) ? ' class="bg-red"' : ''; ?>>
                            <?= $item['number_in']; ?>
                        </td>
                        <td><?= $item['number_out']; ?></td>
                        <td><a href="<?= base_url("items/edit/{$item['id']}"); ?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
</div>