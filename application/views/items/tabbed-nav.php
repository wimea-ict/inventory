<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <ul class="tabbed-nav">
            <li <?= ($page == 'new-batch') ? ' class="active"' : ''; ?>>
                <a href="<?= site_url("items/new-batch"); ?>">New Batch</a>
            </li>
            <li <?= ($page == 'return-items') ? ' class="active"' : ''; ?>>
                <a href="<?= site_url("items/return-items"); ?>">Return Items</a>
            </li>
            <li <?= ($page == 'give-out-items') ? ' class="active"' : ''; ?>>
                <a href="<?= site_url("items/give-out"); ?>">Give Out Items</a>
            </li>
        </ul>
    </div>
</div>