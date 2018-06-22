<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$page_heading = 'Return Items';
require_once(__DIR__ . '/../partials/page-header.php');
?>

<div class="row">
    <div class="col-lg-12">
        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-dismissable alert-<?= $_SESSION['message_class']; ?>">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <?= $_SESSION['message']; ?>
            </div>
        <?php
            unset($_SESSION['message']);
            endif;
        ?>

        <!-- Items Given Out -->
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
            <thead>
                <tr>
                    <th>Items [Quantity]</th>
                    <th>Name</th>
                    <th>Contacts</th>
                    <th>Reason</th>
                    <th>Date Out</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td>
                            <?php
                            for ($j = 0; $j < count($transaction['items']); ++$j) {
                                echo "- " . ucwords($transaction['items'][$j]['name']) . "<br>";
                            }
                            ?>
                        </td>
                        <td><?= $transaction['name']; ?></td>
                        <td>
                            <?php
                            $contacts = explode('/', $transaction['contacts']);
                            foreach ($contacts as $contact) {
                                echo "{$contact}<br>";
                            }
                            ?>
                        </td>
                        <td><?= $transaction['reason']; ?></td>
                        <td><?= (new DateTime($transaction['date_out']))->format('F jS, Y'); ?></td>
                        <td><a href="<?= base_url("items/return-items/{$transaction['id']}"); ?>">Return Items</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
</div>