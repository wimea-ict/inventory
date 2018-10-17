<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        $page_heading = 'Stations';
        require_once(__DIR__ . '/../partials/page-header.php');
        ?>

        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-dismissable alert-<?= $_SESSION['message_class']; ?>">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <?= $_SESSION['message']; ?>
            </div>
        <?php
            unset($_SESSION['message']);
            endif;
        ?>

        <!-- Form -->
        <div class="panel panel-default">
            <div class="panel-heading">Give Out Station</div>
            <div class="panel-body">
                <form action="<?= site_url('stations/give-out'); ?>" method="post" id="give-out-station-form">
                    <div class="row" style="margin-bottom: 1em;">
						<p style="margin-left: 1em; font-weight: bold;" class="text-success">Select Nodes</p>
						<?php
							$num_nodes = count($nodes);
							$num_cols = 2;
							$nodes_per_col = ceil($num_nodes / $num_cols);
						?>
                        <div class="col-lg-6">
							<?php for ($i = 0; $i < $nodes_per_col; ++$i): ?>
								<div class="form-check">
									<input type="checkbox" name="nodes[]" value="<?= $nodes[$i]['id']; ?>" id="defaultCheck1" class="form-check-input" >
									<label class="form-check-label" for="defaultCheck1">
										<?= ucwords($nodes[$i]['name']); ?>
									</label>
								</div>
							<?php endfor; ?>
                        </div>
                        <div class="col-lg-6">
							<?php for ($i = $nodes_per_col; $i < $num_nodes; ++$i): ?>
								<div class="form-check">
								<input type="checkbox" name="nodes[]" value="<?= $nodes[$i]['id']; ?>" id="defaultCheck1" class="form-check-input" >
									<label class="form-check-label" for="defaultCheck1">
										<?= ucwords($nodes[$i]['name']); ?>
									</label>
								</div>
							<?php endfor; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver-name" class="text-success">Receiver Name</label>
                        <input type="text" name="receiver_name" id="receiver-name" class="form-control"
                                <?= isset($receiver) ? " value='{$receiver['name']}'" : '' ?> required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-success">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                                <?= isset($receiver) ? " value='{$receiver['email']}'" : '' ?> required>
                    </div>
                    <div class="form-group">
                        <label for="contacts" class="text-success">Phone Numbers</label>
                        <input type="text" name="contacts" id="contacts" class="form-control" minlength="10"
                                <?= isset($receiver) ? " value='{$receiver['contacts']}'" : '' ?> required>
                        <span class="help-block">Separate multiple contacts with the slash(/) character.</span>
                    </div>
                    <div class="form-group">
                        <label for="num-stations" class="text-success">Number of Stations</label>
                        <input type="number" name="num_stations" id="num-stations" class="form-control"
                            value="<?= isset($num_stations) ? $num_stations : ''; ?>" min="1" required>
                    </div>
					<div class="form-group" id="country">
						<label for="country" class="text-success">Country</label>
						<select name="country" id="country" class="form-control" required>
							<?php foreach ($countries as $country): ?>
								<option value="<?= $country['id']; ?>"
									<?= (isset($country_id) && $country_id == $country['id']) ? ' selected': ''; ?>>
									<?= ucwords($country['name']); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
                    <div class="form-group">
                        <label for="date-out" class="text-success">Date Out</label>
                        <input type="text" name="date_out" id="date-out" class="form-control date-picker"
                                value="<?= isset($date_out) ? $date_out : '' ?>" required>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
