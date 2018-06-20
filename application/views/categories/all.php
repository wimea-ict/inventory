<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('page-header.php');
?>

<div class="row">
    <div class="col-lg-12">
        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['message_class']; ?>"><?= $_SESSION['message']; ?></div>
        <?php endif; ?>

        <!-- Categories -->
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
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
                        <td><a href="<?= base_url("categories/edit/{$category['id']}"); ?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
</div>
