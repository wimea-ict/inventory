<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Stations Given Out -->
<table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
    <!-- Fix the width of the columns. -->
    <colgroup>
        <col style="width: 6.1833%">
        <col style="width: 19.1257%">
        <col style="width: 13.9024%">
		<col style="width: 20%">
        <col style="width: 11.9512%">
		<col style="width: 12%">
        <col>
    </colgroup>
    <thead>
        <tr>
            <th>No</th>
            <th>Nodes</th>
            <th>Incharge</th>
			<th>Email</th>
            <th>Contacts</th>
			<th>Number of Stations</th>
            <th>Date Out</th>
        </tr>
    </thead>
    <tbody>
		<?php
		$i = 0;
		foreach ($stations_given_out as $transaction): ?>
		<tr>
			<td><?= ++$i; ?></td>
			<td>
				<?php
				$num_nodes = count($transaction['nodes']);

				// Only show the first four items.
				for ($j = 0; $j < $num_nodes; ++$j) {
					if ($j == 4) { break; }

					echo "- " . ucwords($transaction['nodes'][$j]['name']) . "<br>";
				}

				if ($num_nodes > 4) {
					echo '<span style="color: green;">+ Plus ' . ($num_nodes - 4) . ' more</span>';
				}
				?>
			</td>
			<td><?= ucwords($transaction['name']); ?></td>
			<td><?= $transaction['email']; ?></td>
			<td>
				<?php
				$contacts = explode('/', $transaction['contacts']);
				foreach ($contacts as $contact) {
					echo "{$contact}<br>";
				}
				?>
			</td>
			<td><?= $transaction['number_out']; ?></td>
			<td><?= (new DateTime($transaction['date_out']))->format('F jS, Y'); ?></td>
		</tr>
		<?php endforeach; ?>
    </tbody>
</table>
<!-- /.table-responsive -->
