<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
  
<!-- Single Node -->
<table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
    <!-- Fix width of the columns -->
    <colgroup>
        <col style="width: 80%">
        <col>
    </colgroup>

    <thead>
        <tr>
            <th>Items</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
		<?php foreach ($node['items'] as $item): ?>
			<tr>
				<td><?= ucwords($item['name']); ?></td>
				<td><a href="<?= site_url("station-node/remove-item/{$node['id']}/{$item['item_id']}"); ?>">Remove</a></td>
			</tr>
		<?php endforeach; ?>
    </tbody>
</table>
<!-- /.table-responsive -->
