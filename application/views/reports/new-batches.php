<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <?php
        $page_heading = 'New Batches';
        $heading_button = [
            'title' => 'Download Report',
            'link' => base_url('reports/download/batches')
        ];
        require_once(__DIR__ . '/../partials/page-header.php');

        require_once(__DIR__ . '/../partials/tables/new-batches.php');
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>