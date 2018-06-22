<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$page_heading = 'Items Returned';
require_once(__DIR__ . '/../partials/page-header.php');
?>

<div class="row">
    <div class="col-lg-12">
        <!-- Items Given Out -->
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
            <thead>
                <tr>
                    <th>Items [Quantity]</th>
                    <th>Name</th>
                    <th>Contacts</th>
                    <th>Comments</th>
                    <th>Date Returned</th>
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
                        <td><?= $transaction['comments']; ?></td>
                        <td><?= (new DateTime($transaction['date_returned']))->format('F jS, Y'); ?></td>
                        <td><a href="<?= base_url("transactions/view/items-returned/{$transaction['id']}"); ?>">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
</div>