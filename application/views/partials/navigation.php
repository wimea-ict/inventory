<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: skyblue; border-bottom: 1px solid rgb(34, 99, 99);">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html" style="color: rgb(34, 99, 99)">WIMEA-ICT IMS</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?= site_url("users/profile/{$_SESSION['user']['id']}"); ?>"><i class="fa fa-user fa-fw"></i> Profile</a></li>
                <li class="divider"></li>
                <li><a href="<?= site_url("auth/logout"); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?= site_url("admin/dashboard"); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-plus-square fa-fw"></i> New Transaction<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= site_url("items/new-batch"); ?>">New Batch</a>
                        </li>
                        <li>
                            <a href="<?= site_url("items/return-items"); ?>">Return Items</a>
                        </li>
                        <li>
                            <a href="<?= site_url("items/give-out"); ?>">Give Out Items</a>
                        </li>
						<li>
							<a href="<?= site_url("stations/give-out"); ?>">Give Out Station</a>
						</li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-exchange fa-fw"></i> Transactions<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= site_url("transactions/new-batches"); ?>">New Batches</a>
                        </li>
                        <li>
                            <a href="<?= site_url("transactions/items-returned"); ?>">Items Returned</a>
                        </li>
                        <li>
                            <a href="<?= site_url("transactions/items-given-out"); ?>">Items Given Out</a>
                        </li>
						<li>
							<a href="<?= site_url("transactions/stations-given-out"); ?>">Stations Given Out</a>
						</li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-tags fa-fw"></i> Categories<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= site_url("categories"); ?>">View Categories</a>
                        </li>
                        <li>
                            <a href="<?= site_url("categories/create"); ?>">Create New Category</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-list fa-fw"></i> Items<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= site_url("items"); ?>">View Items</a>
                        </li>
                        <li>
                            <a href="<?= site_url("items/create"); ?>">Create New Item</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-share-alt fa-fw"></i> Nodes<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= site_url("station-nodes"); ?>">View Nodes</a>
                        </li>
                        <li>
                            <a href="<?= site_url("station-nodes/create"); ?>">Create New Node</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= site_url("users"); ?>">View Users</a>
                        </li>

                        <!-- Only allow the default admin to create new users. -->
                        <?php if ($_SESSION['user']['username'] == 'admin'): ?>
                            <li>
                                <a href="<?= site_url("users/create"); ?>">Create New User</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= site_url("reports/items"); ?>">All Items</a>
                        </li>
                        <li>
                            <a href="<?= site_url("reports/batches"); ?>">Batches</a>
                        </li>
                        <li>
                            <a href="<?= site_url("reports/items-returned"); ?>">Items Returned</a>
                        </li>
                        <li>
                            <a href="<?= site_url("reports/items-given-out"); ?>">Items Given Out</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
