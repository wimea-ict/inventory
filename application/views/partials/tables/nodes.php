<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
  
<!-- Items -->
<table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
    <!-- Fix width of the columns -->
    <colgroup>
        <col style="width: 7.1833%">
        <col style="width: 19.1989%">
        <col style="width: 14.1786%">
        <col style="width: 15.6555%">
        <col>
    </colgroup>

    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Number of Items</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
		<?php
		$i = 0;
		foreach ($nodes as $node): ?>
			<tr>
				<td><?= ++$i; ?></td>
				<td><?= $node['name']; ?></td>
				<td><?= count($node['items']); ?></td>
				<td><a href="<?= site_url("station-nodes/node/{$node['id']}"); ?>">Configure</a></td>
			</tr>
		<?php endforeach; ?>
    </tbody>
</table>
<!-- /.table-responsive -->
