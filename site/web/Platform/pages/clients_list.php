<div id="overview">

<?php include_once('templates/database.php'); ?>

<?php

	// Query database
	$sql = "SELECT * FROM clients ORDER BY business_name ASC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) :
		// Assign rows to an array to easily call it later
		$data = array();
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
 ?>

	<div class="page-header">

			<div class="breadcrumbs row">
				<div class="col s12">
					<a href="#!" class="breadcrumb"><h4>Customers</h4></a>
				</div>
			</div>

	</div>

	<div class="tile-wrapper">
		<div class="row">
			<div class=" col s4">

				<a href="addnewclient.php" class="tile tile--lg">

					<div class="tile__content">

						<img src="assets/plus.png" />

						<p>Add Client</p>

					</div>

				</a>

			</div>
			<?php
				// Access all campaigns with current date
				foreach ($data as $row) {
					echo '<div class="col s4">';
					echo '<a class="tile tile--lg" href="client.php?client_ID=' . $row['client_ID'] . '">';
						echo '<div class="tile__content">';
							echo '<img src="assets/logo-coop.svg" />';
							echo '<p>' . $row['business_name'] . '</p>';
						echo '</div>';
					echo '</a></li>';
				}
			?>
		</div>
	</div>

<?php
	else:
?>
	<h1>No Clients Available</h1>
<?php
	endif;
?>
