<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Items Returned';
        require_once(__DIR__ . '/../../partials/page-header.php');
        ?>

        <!-- Items Given Out -->
        <table width="100%" class="table table-striped table-bordered table-hover">
            <thead>
                <col style="width: 30%">
                <col style="width: 70%">
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Receiver Name</th>
                    <td><?= $transaction['name']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Contacts</th>
                    <td>
                        <?php
                        $contacts = explode('/', $transaction['contacts']);
                        foreach ($contacts as $contact) {
                            echo "{$contact}<br>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?= $transaction['email']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Comments</th>
                    <td><?= $transaction['comments']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Date Returned</th>
                    <td><?= (new DateTime($transaction['date_returned']))->format('F jS, Y'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Returned Items</th>
                    <td style="padding: 0">
                        <table width="100%" class="table table-striped table-bordered table-hover" style="margin-bottom: 0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaction['items'] as $item): ?>
                                    <tr>
                                        <td><?= $item['name']; ?></td>
                                        <td><?= $item['quantity']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-8 -->
</div>