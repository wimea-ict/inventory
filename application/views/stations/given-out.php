<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row" id="content">
    <div class="col-lg-12">
		<?php
        $page_heading = 'Stations Given Out';
        require_once(__DIR__ . '/../partials/page-header.php');
        ?>
        <?php require_once(__DIR__ . '/../partials/tables/stations-given-out.php'); ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
