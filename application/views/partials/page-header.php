<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            <?= $page_heading; ?>
            <?php if (isset($heading_button)): ?>
                <a href="<?= $heading_button['link']; ?>" class="pull-right btn btn-primary"><?= $heading_button['title']; ?></a>
            <?php endif; ?>
        </h4>
    </div>
    <!-- /.col-lg-12 -->
</div>