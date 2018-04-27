<?php require('templates/header.php'); ?>


<?php
	if (isset($_GET['client_ID'])) {
		$client_ID = $_GET['client_ID'];
		
		include_once('templates/database.php');

		include ('pages/campaigns_list.php');

		include ('pages/orders_list.php');
	}
?>

<?php require('templates/footer.php'); ?>