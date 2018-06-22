<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$page_heading = 'New Transaction';
require_once(__DIR__ . '/../partials/page-header.php');
?>

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">Give Items Out</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="" method="post">
                    <fieldset>
                        <legend class="text-success">
                            Items
                            <a href="#" class="pull-right" id="more-items"><i class="fa fa-plus-circle"></i></a></legend>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group" id="items">
                                    <label for="item">Item</label>
                                    <select name="items[]" id="item" class="form-control">
                                        <?php foreach ($items as $item): ?>
                                            <?php if ($item['number_in'] > 0): ?>
                                                <option value="<?= $item['id']; ?>"><?= ucwords($item['name']); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4" id="quantities">
                                <label for="quantity">Quantity</label>
                                <input type="text" name="quantities[]" id="quantity" class="form-control">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="receiver-name">Receiver Name</label>
                        <input type="text" name="receiver_name" id="receiver-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contacts">Phone Numbers</label>
                        <input type="text" name="contacts" id="contacts" class="form-control">
                        <span class="help-block">Separate multiple contacts with the slash(/) character.</span>
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea name="reason" id="reason" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date-out">Date out</label>
                        <input type="text" name="date_out" id="date-out" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="duration-out">Duration Out</label>
                        <input type="text" name="duration_out" id="duration-out" class="form-control">
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->