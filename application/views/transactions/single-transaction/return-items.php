<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$page_heading = 'Return Items';
require_once(__DIR__ . '/../../partials/page-header.php');
?>

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">Return Items</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="" method="post">
                    <fieldset>
                        <legend class="text-success">Items</legend>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group" id="items">
                                    <label for="item">Item</label>
                                    <?php foreach ($transaction['items'] as $item): ?>
                                        <select name="items[]" id="item" class="form-control" style="margin-top: 5px">
                                            <option value="<?= $item['item_id']; ?>"><?= ucwords($item['name']); ?></option>
                                        </select>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-sm-4" id="quantities">
                                <label for="quantity">Quantity</label>
                                <?php foreach ($transaction['items'] as $item): ?>
                                    <input type="text" name="quantities[]" id="quantity" class="form-control" value="<?= $item['quantity']; ?>" style="margin-top: 5px">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="date-returned">Date returned</label>
                        <input type="text" name="date_returned" id="date-returned" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea name="comments" id="comments" class="form-control"></textarea>
                    </div>

                    <input type="hidden" name="items_out_id" value="<?= $transaction['id']; ?>">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->