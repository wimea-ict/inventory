<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: skyblue;">
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
                <li><a href="#"><i class="fa fa-user fa-fw"></i> Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
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
                    <a href="<?= base_url("admin/dashboard"); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-plus-square fa-fw"></i> New Transaction<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= base_url("transactions/new-batch"); ?>">New Batch</a>
                        </li>
                        <li>
                            <a href="<?= base_url("transactions/return-items"); ?>">Return Items</a>
                        </li>
                        <li>
                            <a href="<?= base_url("transactions/give-items-out"); ?>">Give Out Items</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-exchange fa-fw"></i> Transactions<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= base_url("transactions/new-batches"); ?>">New Batches</a>
                        </li>
                        <li>
                            <a href="<?= base_url("transactions/items-returned"); ?>">Items Returned</a>
                        </li>
                        <li>
                            <a href="<?= base_url("transactions/items-given-out"); ?>">Items Given Out</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-tags fa-fw"></i> Categories<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= base_url("categories"); ?>">View Categories</a>
                        </li>
                        <li>
                            <a href="<?= base_url("categories/create"); ?>">Create New Category</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-list fa-fw"></i> Items<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= base_url("items"); ?>">View Items</a>
                        </li>
                        <li>
                            <a href="<?= base_url("items/create"); ?>">Create New Item</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= base_url("users"); ?>">Manage Users</a>
                        </li>
                        <li>
                            <a href="<?= base_url("users/create"); ?>">Create New User</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= base_url("reports/items"); ?>">All Items</a>
                        </li>
                        <li>
                            <a href="<?= base_url("reports/batches"); ?>">Batches</a>
                        </li>
                        <li>
                            <a href="<?= base_url("reports/items-returned"); ?>">Items Returned</a>
                        </li>
                        <li>
                            <a href="<?= base_url("reports/items-out"); ?>">Items Given Out</a>
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