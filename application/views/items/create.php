<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Items';
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
            <div class="panel-heading"><?= $panel_heading; ?></div>
            <div class="panel-body">
                <form action="<?= base_url('items/create'); ?>" method="post" id="create-item-form">
                    <div class="form-group">
                        <label for="item-name">Item Name</label>
                        <input type="text" name="item_name" id="item-name" class="form-control"
                            <?= isset($item) ? " value='" . ucwords($item['name']) . "'" : '' ?> required>
                        <span class="help-block">Enter singular name for item</span>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>" <?= (isset($item) && ($item['category_id'] == $category['id'])) ? ' selected' : '';?>>
                                    <?= ucwords($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php if (isset($item)): ?>
                        <input type="hidden" name="item_id" value="<?= $item['id']; ?>">
                    <?php endif; ?>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>