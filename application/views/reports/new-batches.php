<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (is_ajax_request() == false) {
    $page = 'batches';

    $tab_action_button = [
        'title' => 'Download Report',
        'link' => site_url('reports/download/batches')
    ];
    require_once(__DIR__ . '/tabbed-nav.php');
}
?>

<div class="row" id="content">
    <div class="col-lg-12">
        <?php
        $page_heading = 'New Batches';
		require_once(__DIR__ . '/../partials/page-header.php');

		require_once(__DIR__ . '/../partials/tables/new-batches.php');
		?>
    </div>
    <!-- /.col-lg-12 -->
</div>
