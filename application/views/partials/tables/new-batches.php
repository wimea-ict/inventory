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
                    for ($j = 0; $j < count($batch['items']); ++$j) {
                        echo '- ' . ucwords($batch['items'][$j]['name']) . "<br>";
                    }
                    ?>
                </td>
                <td><?= (new DateTime($batch['date_brought']))->format('F jS, Y'); ?></td>
                <td><?= (new DateTime($batch['date_entered']))->format('F jS, Y'); ?></td>
                <td><a href="<?= base_url("transactions/view/new-batch/{$batch['id']}"); ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- /.table-responsive -->