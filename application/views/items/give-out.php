<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (is_ajax_request() == false) {
    $page = 'give-out-items';
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
            <div class="panel-heading">Give Items Out</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="" method="post" id="give-items-out-form">
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
                                <input type="number" name="quantities[]" min="0" id="quantity" class="form-control" required>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="receiver-name">Receiver Name</label>
                        <input type="text" name="receiver_name" id="receiver-name" class="form-control"
                                <?= isset($receiver) ? " value='{$receiver['name']}'" : '' ?> required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                                <?= isset($receiver) ? " value='{$receiver['email']}'" : '' ?> required>
                    </div>
                    <div class="form-group">
                        <label for="contacts">Phone Numbers</label>
                        <input type="text" name="contacts" id="contacts" class="form-control" minlength="10"
                                <?= isset($receiver) ? " value='{$receiver['contacts']}'" : '' ?> required>
                        <span class="help-block">Separate multiple contacts with the slash(/) character.</span>
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea name="reason" id="reason" class="form-control" minlength="5" required><?= isset($reason) ? "{$reason}" : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date-out">Date out</label>
                        <input type="text" name="date_out" id="date-out" class="form-control date-picker"
                                <?= isset($date_out) ? " value='{$date_out}'" : '' ?> required>
                    </div>
                    <div class="form-group">
                        <label for="duration-out">Duration Out</label>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="number" min="1" name="duration" id="duration-out" class="form-control" required>
                            </div>
                            <div class="col-lg-8">
                                <label for="duration-unit" class="sr-only">Duration Unit</label>
                                <select name="duration_unit" id="duration-unit" class="form-control" required>
                                    <option value="day">Day</option>
                                    <option value="week">Week</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->