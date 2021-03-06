<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (is_ajax_request() == false) {
    $page = 'items';

    $tab_action_button = [
        'title' => 'Download Report',
        'link' => site_url('reports/download/items')
    ];
    require_once(__DIR__ . '/tabbed-nav.php');
}
?>

<div class="row" id="content">
    <div class="col-lg-12">
        <?php
        $page_heading = 'All Items';
		require_once(__DIR__ . '/../partials/page-header.php');

		require_once(__DIR__ . '/../partials/tables/items.php');
		?>
    </div>
    <!-- /.col-lg-12 -->
</div>
