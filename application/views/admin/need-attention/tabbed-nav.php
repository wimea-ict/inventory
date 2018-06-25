<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <ul class="tabbed-nav">
            <li <?= ($page == 'items') ? ' class="active"' : ''; ?>>
                <a href="<?= base_url("admin/need-attention/items"); ?>">Items</a>
            </li>
            <li <?= ($page == 'transactions') ? ' class="active"' : ''; ?>>
                <a href="<?= base_url("admin/need-attention/transactions"); ?>">Transactions</a>
            </li>
        </ul>
    </div>
</div>