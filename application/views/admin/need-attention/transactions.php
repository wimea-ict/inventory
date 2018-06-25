<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (is_ajax_request() == false) {
    $page = 'transactions';
    require_once(__DIR__ . '/tabbed-nav.php');
}
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
                    <th>Reason</th>
                    <th>Date Out</th>
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
                        <td><?= $transaction['reason']; ?></td>
                        <td><?= (new DateTime($transaction['date_out']))->format('F jS, Y'); ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?= base_url("transactions/view/items-out/{$transaction['id']}"); ?>">View</a></li>
                                    <li><a href="<?= base_url("items/return-items/{$transaction['id']}"); ?>">Return Items</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
</div>