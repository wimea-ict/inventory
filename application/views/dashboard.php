<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tags fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $num_categories; ?></div>
                        <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="<?= site_url("categories"); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $num_items; ?></div>
                        <div>Items</div>
                    </div>
                </div>
            </div>
            <a href="<?= site_url("items"); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-exchange fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $num_transactions; ?></div>
                        <div>Transactions</div>
                    </div>
                </div>
            </div>
            <a href="<?= site_url("transactions"); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-warning fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $num_need_attention['items'] + $num_need_attention['transactions']; ?></div>
                        <div>Need Attention!</div>
                    </div>
                </div>
            </div>
            <a href="<?= site_url("admin/need-attention"); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-clock-o fa-fw"></i> Timeline
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="timeline">
                    <?php foreach ($timeline_items as $item): ?>
                        <?php if (isset($item['username'])):  // User Created ?>
                        <li>
                            <div class="timeline-badge danger"><i class="fa fa-user-plus"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">New User Created</h4>
                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?= (new DateTime($item['date_entered']))->format('F jS, Y') ?></small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>Name: <a href="<?= site_url("users/profile/{$item['id']}"); ?>"><?= ucwords($item['name']); ?></a>.</p>
                                </div>
                            </div>
                        </li>
                        <?php elseif (isset($item['category_id'])):  // Item Created ?>
                        <li>
                            <div class="timeline-badge success"><i class="fa fa-list"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">New Item Created</h4>
                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?= (new DateTime($item['date_entered']))->format('F jS, Y') ?></small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>Item Name: <span class="text-green"><?= $item['name']; ?></span>.</p>
                                </div>
                            </div>
                        </li>
                        <?php elseif (isset($item['date_out'])):  // Items Given Out ?>
                        <li>
                            <div class="timeline-badge warning"><i class="fa fa-angle-double-right"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Items Given Out</h4>
                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?= (new DateTime($item['date_out']))->format('F jS, Y') ?></small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        <a href="<?= site_url("transactions/view/items-out/{$item['id']}") ?>">
                                            <?= count($item['items']); ?> <?= count($item['items']) > 1 ? "items" : "item"; ?> given out to <?= ucwords($item['name']); ?>.
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <?php elseif (isset($item['date_returned'])):  // Items Returned ?>
                        <li class="timeline-inverted">
                            <div class="timeline-badge info"><i class="fa fa-angle-double-left"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Items Returned</h4>
                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?= (new DateTime($item['date_returned']))->format('F jS, Y') ?></small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        <a href="<?= site_url("transactions/view/items-returned/{$item['id']}"); ?>">
                                            <?= count($item['items']); ?> <?= count($item['items']) > 1 ? "items" : "item"; ?> returned by <?= ucwords($item['name']); ?>.
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <?php elseif (isset($item['date_brought'])):  // New Batch ?>
                        <li class="timeline-inverted">
                            <div class="timeline-badge info"><i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">New Batch Brought</h4>
                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?= (new DateTime($item['date_brought']))->format('F jS, Y') ?></small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        <a href="<?= site_url("transactions/view/new-batch/{$item['id']}"); ?>">
                                            New batch brought containing <?= count($item['items']); ?> <?= count($item['items']) > 1 ? "items" : "item"; ?>.
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <?php else:  // Category ?>
                        <li>
                            <div class="timeline-badge primary"><i class="fa fa-tag"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">New Category Created</h4>
                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?= (new DateTime($item['date_entered']))->format('F jS, Y') ?></small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>Category Name: <span class="text-green"><?= $item['name']; ?></span>.</p>
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-8 -->
</div>
<!-- /.row -->