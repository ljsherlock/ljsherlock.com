<?php require('templates/header.php'); ?>


<?php
	if (isset($_GET['type'])) {
		$type = $_GET['type'];

		include_once('templates/database.php');

		// If setting up a New Campaign
		if ($type == 'campaign') {
			$campaign_ID = $_GET['campaign_ID'];
			include('pages/analytics_campaign.php');

		// Else if setting up a new App
		} else if ($type == 'order') {
			$order_number_ID = $_GET['order_number_ID'];
			include('pages/analytics_order.php');
		}
	}
?>

<?php require('templates/footer.php'); ?>
