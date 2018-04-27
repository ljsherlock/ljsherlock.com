
<div>

<?php

	// Query database and list out all orders
	$sql = "SELECT * FROM orders ORDER BY order_number_ID ASC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$data = array();
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	}
?>


	<div class="tile-wrapper tile-wrapper--campaign">

		<div class="tile-wrapper__header">

			<h5>Current Customer Apps</h5>

		</div>

		<div class="row">

			<div class="col">

				<a class="tile tile--sm" href="setup.php?type=order&client_ID=<?php echo $client_ID; ?>">

					<div class="tile__content">

						<img src="assets/plus.png" />

						<p>Add App</p>

					</div>

				</a>

			</div>


		<?php
			foreach ($data as $row) {
				echo '<div class="col">';
				echo '<a class="tile tile--sm" href="summary.php?type=order&client_ID='. $client_ID .'&order_number_ID=' . $row['order_number_ID'] . '">';
					echo '<div class="tile__content">';
						// echo '<img src="assets/logo-coop.svg" class="responsive-img" />';
						echo '<p>' . $row['order_number_ID'] . '</p>';
					echo '</div>';
				echo '</a></li>';
				echo '</div>';
			}
		?>

	</div>

</div>
