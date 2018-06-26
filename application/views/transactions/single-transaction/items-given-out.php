<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Items Given Out';
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
                    <th scope="row">Reason</th>
                    <td><?= $transaction['reason']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Date Out</th>
                    <td><?= (new DateTime($transaction['date_out']))->format('F jS, Y'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Date Recorded</th>
                    <td><?= (new DateTime($transaction['date_entered']))->format('F jS, Y'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Expected Return Date</th>

                    <?php
                    $duration_out = strtolower($transaction['duration_out']);
                    $expected_return_date = new DateTime(date('Y-m-d', strtotime("{$transaction['date_out']} +{$duration_out}")));
                    ?>

                    <td <?= (new DateTime() > $expected_return_date->add(new DateInterval('P1D'))) ? ' class="bg-red"' : ''; ?>>
                        <?= $expected_return_date->sub(new DateInterval('P1D'))->format('F jS, Y'); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Items</th>
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

        <a href="<?= base_url("items/return-items/{$transaction['id']}"); ?>" class="btn btn-block btn-primary">Return Items</a>
    </div>
    <!-- /.col-lg-8 -->
</div>