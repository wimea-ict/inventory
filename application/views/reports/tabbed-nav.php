<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <ul class="tabbed-nav">
            <li <?= ($page == 'items') ? ' class="active"' : ''; ?>>
                <a href="<?= site_url("reports/items"); ?>">Items</a>
            </li>
            <li <?= ($page == 'batches') ? ' class="active"' : ''; ?>>
                <a href="<?= site_url("reports/batches"); ?>">New Batches</a>
            </li>
            <li <?= ($page == 'items-returned') ? ' class="active"' : ''; ?>>
                <a href="<?= site_url("reports/items-returned"); ?>">Items Returned</a>
            </li>
            <li <?= ($page == 'items-given-out') ? ' class="active"' : ''; ?>>
                <a href="<?= site_url("reports/items-given-out"); ?>">Items Given Out</a>
            </li>

            <?php if (isset($tab_action_button)): ?>
                <a href="<?= $tab_action_button['link']; ?>" class="nav-right btn btn-primary" id="tab-action-button"><?= $tab_action_button['title']; ?></a>
            <?php endif; ?>
        </ul>
    </div>
</div>