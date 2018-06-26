<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <?php
        $page_heading = 'Items Returned';
        $heading_button = [
            'title' => 'Download Report',
            'link' => base_url('reports/download/items-returned')
        ];
        require_once(__DIR__ . '/../partials/page-header.php');

        require_once(__DIR__ . '/../partials/tables/items-returned.php');
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>