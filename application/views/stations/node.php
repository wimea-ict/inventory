<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = $node['name'];
        $heading_button = [
            'title' => 'Add Items',
            'link' => site_url("station-node/add-items/{$node['id']}")
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
        
        <?php require_once(__DIR__ . '/../partials/tables/node.php'); ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
