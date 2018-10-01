<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Nodes';
        require_once(__DIR__ . '/../partials/page-header.php');
        ?>

        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-dismissable alert-<?= $_SESSION['message_class']; ?>">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <?= $_SESSION['message']; ?>
            </div>
        <?php
            unset($_SESSION['message']);
            endif; 
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">Add Items - <?= $node['name']; ?></div>
            <div class="panel-body">
                <form action="<?= site_url("station_node/add-items/{$node['id']}") ?>" method="post" id="create-node-form">
                    <fieldset>
                        <legend class="text-success">
                            Items
                            <a href="#" class="pull-right" id="more-items"><i class="fa fa-plus-circle"></i></a></legend>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group" id="items">
                                    <label for="item">Item</label>
                                    <select name="items[]" id="item" class="form-control" required>
                                        <?php foreach ($items as $item): ?>
                                            <?php if ($item['number_in'] > 0): ?>
                                                <!-- Only give out items that are still in stock. -->
                                                <option value="<?= $item['id']; ?>"><?= ucwords($item['name']); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4" id="quantities">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantities[]" min="1" id="quantity" class="form-control" required>
                            </div>
                        </div>
                    </fieldset>

                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
