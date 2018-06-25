<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Categories';
        require_once(__DIR__ . '/../partials/page-header.php');
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">Create New Category</div>
            <div class="panel-body">
                <form action="" method="post" id="create-category-form">
                    <div class="form-group">
                        <label for="category-name">Category Name</label>
                        <input type="text" name="category_name" id="category-name" class="form-control"
                            <?= isset($category) ? " value='{$category['name']}'" : '' ?> required>
                    </div>

                    <?php if (isset($category)): ?>
                        <input type="hidden" name="category_id" value="<?= $category['id']; ?>">
                    <?php endif; ?>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>