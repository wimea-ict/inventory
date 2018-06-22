<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$page_heading = 'Items';
require_once(__DIR__ . '/../partials/page-header.php');
?>

<div class="row">
    <div class="col-lg-12">
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
                        <td><?= $item['number_in']; ?></td>
                        <td><?= $item['number_out']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?= base_url("items/edit/{$item['id']}"); ?>">Edit</a></li>
                                    <li><a href="#">Transactions</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
</div>