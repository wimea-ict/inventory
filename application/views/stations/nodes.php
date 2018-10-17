<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Nodes';
        $heading_button = [
            'title' => 'New Node',
            'link' => site_url('station-node/create')
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
        
        <?php require_once(__DIR__ . '/../partials/tables/nodes.php'); ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
