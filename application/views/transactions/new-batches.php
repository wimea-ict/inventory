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
                    <th>Items [Quantity]</th>
                    <th>Date Brought</th>
                    <th>Date Recorded</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($batches as $batch):
                ?>
                    <tr>
                        <td><?= $batch['id']; ?></td>
                        <td>
                            <?php
                            for ($j = 0; $j < (count($batch['items']) - 1); ++$j) {
                                echo ucwords($batch['items'][$j]['name']) . " [{$batch['items'][$j]['quantity']}], ";
                            }
                            echo ucwords($batch['items'][$j]['name']) . " [{$batch['items'][$j]['quantity']}]";
                            ?>
                        </td>
                        <td><?= (new DateTime($batch['date_brought']))->format('F jS, Y'); ?></td>
                        <td><?= (new DateTime($batch['date_entered']))->format('F jS, Y'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->                
</div>