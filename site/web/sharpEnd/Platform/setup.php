<?php require('templates/header.php'); ?>


<?php
	if (isset($_GET['type'])) {
		$setup_type = $_GET['type'];

		include_once('templates/database.php');

		// If setting up a New Campaign
		if ($setup_type == 'campaign') {

			$client_ID = $_GET['client_ID'];
			include('pages/setup_campaign.php');


		// Else if setting up a new App
		} else if ($setup_type == 'order') {

			$client_ID = $_GET['client_ID'];
			include('pages/setup_order.php');
		}
	}
?>

<?php require('templates/footer.php'); ?>
