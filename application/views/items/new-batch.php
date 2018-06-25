<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (is_ajax_request() == false) {
    $page = 'new-batch';
    require_once(__DIR__ . '/tabbed-nav.php');
}
?>

<div class="row">
    <div class="col-lg-8">
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
            <div class="panel-heading">Add New Batch</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="" method="post" id="new-batch-form">
                    <fieldset>
                        <legend class="text-success">Items <a href="#" class="pull-right" id="more-items"><i class="fa fa-plus-circle"></i></a></legend>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group" id="items">
                                    <label for="item">Item</label>
                                    <select name="items[]" id="item" class="form-control" required>
                                        <?php foreach ($items as $item): ?>
                                            <option value="<?= $item['id']; ?>"><?= ucwords($item['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4" id="quantities">
                                <label for="quantity">Quantity</label>
                                <input type="number" min="0" name="quantities[]" id="quantity" class="form-control" required>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="date-brought">Date brought</label>
                        <input type="text" name="date_brought" id="date-brought" class="form-control date-picker"
                                <?= isset($date_brought) ? " value='{$date_brought}'": ''; ?> required>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->