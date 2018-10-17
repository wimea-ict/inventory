<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
                <td><?= $transaction['comments']; ?></td>
                <td><?= (new DateTime($transaction['date_returned']))->format('F jS, Y'); ?></td>
                <td><a href="<?= site_url("transactions/view/items-returned/{$transaction['id']}"); ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- /.table-responsive -->
