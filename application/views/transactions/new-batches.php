<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (is_ajax_request() == false) {
    $page = 'new-batches';
    require_once(__DIR__ . '/tabbed-nav.php');
}
?>

<div class="row">
    <div class="col-lg-12">
        <?php require_once(__DIR__ . '/../partials/tables/new-batches.php'); ?>
    </div>
    <!-- /.col-lg-12 -->                
</div>