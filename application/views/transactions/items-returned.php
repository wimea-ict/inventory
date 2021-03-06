<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (is_ajax_request() == false) {
    $page = 'items-returned';
    require_once(__DIR__ . '/tabbed-nav.php');
}
?>

<div class="row" id="content">
    <div class="col-lg-12">
        <?php
        $page_heading = 'Items Returned';
		require_once(__DIR__ . '/../partials/page-header.php');

		require_once(__DIR__ . '/../partials/tables/items-returned.php');
		?>
    </div>
    <!-- /.col-lg-12 -->
</div>
