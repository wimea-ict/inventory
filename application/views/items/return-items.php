<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (is_ajax_request() == false) {
    $page = 'return-items';
    require_once(__DIR__ . '/tabbed-nav.php');
}
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

        <?php require_once(__DIR__ . '/../partials/tables/items-given-out.php'); ?>
    </div>
    <!-- /.col-lg-12 -->
</div>