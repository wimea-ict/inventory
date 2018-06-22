<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$page_heading = 'Items Returned';
require_once(__DIR__ . '/../partials/page-header.php');
?>

<div class="row">
    <div class="col-lg-12">
        <!-- Items Given Out -->
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
            <!-- Fix the width of the columns. -->
            <colgroup>
                <col style="width: 7.1833%">
                <col style="width: 17.1257%">
                <col style="width: 13.9024%">
                <col style="width: 11.9512%">
                <col style="width: 22.2188%">
                <col style="width: 17.2764%">
                <col>
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Items</th>
                    <th>Name</th>
                    <th>Contacts</th>
                    <th>Comments</th>
                    <th>Date Returned</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($transactions as $transaction):
                ?>
                    <tr>
                        <td><?= ++$i; ?></td>
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