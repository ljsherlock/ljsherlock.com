<?php

// Query database for client specific order numbers
	$sql = "SELECT * FROM orders WHERE client_ID = $client_ID ORDER BY order_number_ID ASC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) :
		$data = array();
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
?>

		<div class="breadcrumbs row">

			<div class="col s12">

				<a href="#!" class="breadcrumb"><h4>Coop</h4></a>

				<a href="#!" class="breadcrumb breadcrumb--icon"><h4>Add App</h4></a>

			</div>

		</div>

		<div class="main__content">
			<div class="box">
				<table id="tableSelect">
					<thead>
						<tr>
							<th></th>
							<th>Order Number</th>
							<th># of Palettes</th>
							<th>Contact</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $key => $row) :
							$order_number_ID = $row['order_number_ID'];

							// Only Show Orders that have not yet been assigned an App
							if ($row['app_created'] == False) :
						?>

							<tr>
								<td>
									<input type="radio" name="order_number" id="order<?= $key ?>" value="<?php echo $order_number_ID; ?>">
									<label for="order<?= $key ?>" value="<?php echo $order_number_ID; ?>"><span></span></label>

								</td>
								<td class="order_number_item"><?php echo $order_number_ID; ?></td>
								<td class="total_palettes_item"><?php echo $row['total_palettes']; ?></td>
								<td class="contact_item"><?php echo $row['contact']; ?></td>
							</td>
						<?php endif; ?>
						<?php endforeach; ?>
					</tbody>
				</table>

				<a href="#order_selection" class="modal-trigger btn btn--io btn--round" type="submit" id="list-order-button" value="Confirm Order">Confirm Order</a>

			</div>
			<?php endif; ?>


			<!-- Share Modal -->
			<div id="order_selection" class="card modal">

					<div id="app_confirmation">

						<div class=" modal__header">

							<h3 class="card-title">Confirm App Details and Generate Palette IDs?</h3>

						</div>

						<div class="card-action modal__content typography typography--center">

							<div class="form">

								<div class="row">
									<h5 class="col s3"><strong>Order Number:</strong></h5>
									<div class="col s3">
										<input id="order_number_input" type="text" value=""/>
									</div>
									<span class="col s3">&nbsp;</span>
								</div>
								<div class="row">
									<h5 class="col s3">#<strong> of Palettes:</strong></h5>
									<div class="col s3">
										<input id="total_palettes_input" type="text" value=""/>
									</div>
									<span class="col s3" id="total_palettes_input_span"></span>
								</div>
								<div class="row">
									<h5 class="col s3"><strong>Contact:</strong></h5>
									<div class="col s3">
										<input id="contact_input" type="text" value=""/>
									</div>
									<span class="col s3">&nbsp;</span>
								</div>

							</div>

						</div>

						<div class="card-action modal__footer">

							<div class="row">

								<a id="cancel" href="#cancel" class="col s6 modal-action modal-close ">Cancel</a>

								<a id="submit-button" class="col s6 confirm" href="#order-confirmed">OK</a>

							</div>

						</div>

					</div>

					<div id="app_confirmation_success">

						<div class="card-action modal__content typography typography--center">

							<img class="responsive-img col s4 offset-s4" src="assets/tick.png" />
							<p class="col s12">Palette IDs created</p>

						</div>

					</div>

			</div>

		</div>
