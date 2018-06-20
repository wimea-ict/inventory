<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('partials/header.php');
require_once('partials/navigation.php');
?>

<div id="wrapper">
    <div id="page-wrapper">
        <?= $content; ?>
    </div>
</div>
<!-- /#wrapper -->

<?php require_once('partials/footer.php'); ?>