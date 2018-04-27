<div>

<?php

	// Query database
	$sql = "SELECT * FROM campaigns ORDER BY campaign_ID ASC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$data = array();
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	}
?>

	<div class="breadcrumbs row">

		<div class="col s12">

			<a href="#!" class="breadcrumb"><h4>Coop</h4></a>

			<a href="#!" class="breadcrumb breadcrumb--icon"><h4>Customers Overview</h4></a>

		</div>

	</div>

	<div class="tile-wrapper tile-wrapper--campaign">

		<div class="tile-wrapper__header">
			
			<h5>Current Customer Campaigns</h5>

		</div>

		<div class="row">

			<div class="col">

				<a class="tile tile--sm" href="setup.php?type=campaign&client_ID=<?php echo $client_ID; ?>">

					<div class="tile__content">

						<img src="assets/plus.png" />

						<p>Add Campaign</p>

					</div>

				</a>

			</div>


		<?php
			foreach ($data as $row) {
				echo '<div class="col">';
				echo '<a class="tile tile--sm" href="summary.php?type=campaign&client_ID=' . $client_ID . '&campaign_ID=' . $row['campaign_ID'] . '">';
					echo '<div class="tile__content">';
						echo '<img src="assets/logo-coop.svg" class="responsive-img" />';
						echo '<p>' . $row['campaign_name'] . '</p>';
					echo '</div>';
				echo '</a></li>';
				echo '</div>';
			}
		?>

	</div>

</div>
