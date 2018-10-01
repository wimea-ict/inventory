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
                <form action="<?= site_url('stations/give-out'); ?>" method="post" id="deploy-station-form">
                    <div class="row">
						<p style="margin-left: 1em;" class="text-success">Select Nodes</p>
                        <div class="col-lg-6">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
								<label class="form-check-label" for="defaultCheck1">
									Sink Node + Gateway
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
								<label class="form-check-label" for="defaultCheck2">
									Ground Node
								</label>
							</div>
                        </div>
                        <div class="col-lg-6">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								<label class="form-check-label" for="defaultCheck1">
									10m Node
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
								<label class="form-check-label" for="defaultCheck2">
									2m Node
								</label>
							</div>
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
                            <?= isset($user) ? " value='1" : ''; ?> min="1" required>
                    </div>
					<div class="form-group" id="country">
						<label for="country" class="text-success">Country</label>
						<select name="country" id="country" class="form-control" required>
							<option value="">Uganda</option>
							<option value="">Tanzania</option>
							<option value="">South Sudan</option>
						</select>
					</div>
                    <div class="form-group">
                        <label for="date-deploy" class="text-success">Date of Deployment</label>
                        <input type="text" name="date_deploy" id="date-deploy" class="form-control date-picker"
                                <?= isset($date_deploy) ? " value='{$date_deploy}'" : '' ?> required>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
