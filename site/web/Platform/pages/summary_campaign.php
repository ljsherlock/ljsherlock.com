<?php

	// Query database for client specific order numbers
	$sql = "SELECT * FROM campaigns WHERE campaign_ID = '$campaign_ID'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) :
		$data = array();
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}

	foreach ($data as $row) :

?>

<div class="breadcrumbs row">

  <div class="col s12">

    <a href="#!" class="breadcrumb"><h4>Coop</h4></a>

    <a href="#!" class="breadcrumb breadcrumb--icon"><h4>Valais 2018</h4></a>

  </div>

</div>

<div class="main__content">

	<div class="overview">

		<div class="row">

			<div class="col s6">

				<div class="row">

					<div class="col s1">
						<img src="assets/bottle.png" class="responsive-img" />
					</div>

					<div class="col">
						<div class="quantity">
							<h4 class="display-1"><?php echo $row['number_of_bottles']; ?></h4>
							<h5>Bottles</h5>
						</div>
					</div>

				</div>

			</div>

			<div class="col offset-s2 col s4">
				<ul>
					<li><h5><strong>Type: </strong><?php echo $row['number_of_bottles']; ?></h5></li>
					<li><h5><strong>URL: </strong>coop.io.tt/<?php echo $row['campaign_URL']; ?></h5></li>
					<li><h5><strong>Product: </strong><?php echo $row['product']; ?></h5></li>
				</ul>
			</div>

			<div class="col s12">

				<p><?php echo $row['campaign_description']; ?></p>

			</div>

		</div>

	</div>

	<div class="summary-options row">

		<div class="col s3 offset-s2">

			<div class="tile tile--sm">
				<div class="tile__content">

				<form method="POST" action="drivers/download_csv.php">
						<input style="display:none;" name="campaign_ID" type="text" value="<?php echo $campaign_ID; ?>" />
						<!-- <div id="buttons"> -->
							<button class="submit-button" type="submit" name="button_value" value="campaign">
								<img src="assets/ids.png" />
								<p>Download Campaign IDs</p>
							</button>
						<!-- </div> -->
					</form>

				</div>
			</div>

		</div>


		<div class="col s3 offset-s1 ">

			<a class="tile tile--sm" href="analytics.php?type=campaign&campaign_ID=<?= $campaign_ID; ?>">
				<div class="tile__content">
					<img src="assets/analytics.png" />
					<p>Campaign Analytics</p>
				</div>
			</a>

		</div>

	</div>

</div>

<?php
	endforeach;
endif; ?>
