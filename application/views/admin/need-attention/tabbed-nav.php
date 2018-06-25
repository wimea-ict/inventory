<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <ul class="tabbed-nav">
            <li <?= ($page == 'items') ? ' class="active"' : ''; ?>>
                <a href="<?= base_url("admin/need-attention/items"); ?>">
                    Items
                    <?php if ($num_need_attention['items'] > 0): ?>
                        <span class="badge"><?= $num_need_attention['items']; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li <?= ($page == 'transactions') ? ' class="active"' : ''; ?>>
                <a href="<?= base_url("admin/need-attention/transactions"); ?>">
                    Transactions
                    <?php if ($num_need_attention['transactions'] > 0): ?>
                        <span class="badge"><?= $num_need_attention['transactions']; ?></span>
                    <?php endif; ?>
                </a>
            </li>
        </ul>
    </div>
</div>