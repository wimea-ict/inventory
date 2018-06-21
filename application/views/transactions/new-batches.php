<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$page_heading = 'New Batches';
require_once(__DIR__ . '/../partials/page-header.php');
?>

<div class="row">
    <div class="col-lg-12">
        <!-- New Batches -->
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Items</th>
                    <th>Date Brought</th>
                    <th>Date Recorded</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($batches as $batch): ?>
                    <tr>
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
    </div>
    <!-- /.col-lg-12 -->                
</div>