<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <ul class="tabbed-nav">
            <li <?= ($page == 'new-batches') ? ' class="active"' : ''; ?>>
                <a href="<?= base_url("transactions/new-batches"); ?>">New Batches</a>
            </li>
            <li <?= ($page == 'items-returned') ? ' class="active"' : ''; ?>>
                <a href="<?= base_url("transactions/items-returned"); ?>">Items Returned</a>
            </li>
            <li <?= ($page == 'items-given-out') ? ' class="active"' : ''; ?>>
                <a href="<?= base_url("transactions/items-given-out"); ?>">Items Given Out</a>
            </li>
        </ul>
    </div>
</div>