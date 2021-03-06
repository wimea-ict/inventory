<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Items Given Out -->
<table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
    <!-- Fix the width of the columns. -->
    <colgroup>
        <col style="width: 7.1833%">
        <col style="width: 17.1257%">
        <col style="width: 13.9024%">
        <col style="width: 13.9512%">
        <col style="width: 21.2188%">
        <col style="width: 16.2764%">
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
					$num_items = count($transaction['items']);

					// Only show the first four items.
                    for ($j = 0; $j < $num_items; ++$j) {
						if ($j == 4) { break; }

                        echo "- " . ucwords($transaction['items'][$j]['name']) . "<br>";
                    }

					if ($num_items > 4) {
						echo '<span style="color: green;">+ Plus ' . ($num_items - 4) . ' more</span>';
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
                            <li><a href="<?= site_url("transactions/view/items-out/{$transaction['id']}"); ?>">View</a></li>
                            <li><a href="<?= site_url("items/return-items/{$transaction['id']}"); ?>">Return Items</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- /.table-responsive -->
