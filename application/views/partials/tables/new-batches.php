<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- New Batches -->
<table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
    <!-- Fix width of the columns -->
    <colgroup>
        <col style="width: 7.1833%">
        <col style="width: 10.2673%">
        <col style="width: 35.516%">
        <col style="width: 17.1883%">
        <col style="width: 18.4045%">
        <col>
    </colgroup>

    <thead>
        <tr>
            <th>No</th>
            <th>Batch</th>
            <th>Items</th>
            <th>Date Brought</th>
            <th>Date Recorded</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($transactions as $batch):
        ?>
            <tr>
                <td><?= ++$i; ?></td>
                <td><?= $batch['id']; ?></td>
                <td>
                    <?php
					$num_items = count($batch['items']);

					// Only show the first four items
                    for ($j = 0; $j < $num_items; ++$j) {
						if ($j == 4) { break; }

                        echo '- ' . ucwords($batch['items'][$j]['name']) . "<br>";
					}

					if ($num_items > 4) {
						echo '<span style="color: green;">+ Plus ' . ($num_items - 4) . ' more</span>';
					}
                    ?>
                </td>
                <td><?= (new DateTime($batch['date_brought']))->format('F jS, Y'); ?></td>
                <td><?= (new DateTime($batch['date_entered']))->format('F jS, Y'); ?></td>
                <td><a href="<?= site_url("transactions/view/new-batch/{$batch['id']}"); ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- /.table-responsive -->
