<?php
	include_once '../templates/database.php';
	$button_value  = $_POST["button_value"];

	if($button_value == 'order'){
		if(!empty($_POST["order_number_ID"])){

		$order_number_ID = $_POST["order_number_ID"];
		// output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Univerre_IDs.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, array('Palette Number', 'URL ID'));

		// fetch the data - needs to be passed from the calling request (ajax)
		// require('database.php');
		// $sql = "SELECT number_of_items FROM items WHERE order_number_ID = '".$order_number_ID."'";
		// $query = mysqli_fetch_assoc($conn->query($sql));

		if ($stmt = $conn->prepare("SELECT total_palettes FROM orders WHERE order_number_ID = ?")) {
			/* bind parameters for markers */
		    $stmt->bind_param("i", $order_number_ID);

		    /* execute query */
		    $stmt->execute();

		    /* bind result variables */
		    $stmt->bind_result($total_palettes);

		    /* fetch value */
		    $stmt->fetch();

		    /* close statement */
		    $stmt->close();

		    // Signifiers must be a char value greater than f because we're using Hex encoding
			$url = "http://coop.io.tt/p"; // p signifies Palette order
			$order_number_ID = dechex($order_number_ID); // To be defined by mysql

			$url = $url . $order_number_ID . "s"; 

			for($i = 1; $i < ($total_palettes + 1); $i++){
				$shortURL = $url . dechex($i);
				$row = array($i, $shortURL);
				fputcsv($output, $row);
			}
		}
		$conn->close();
		}
	}

	if($button_value == 'campaign'){
		if(!empty($_POST["campaign_ID"])){

		$campaign_ID = $_POST["campaign_ID"];
		// output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, array('Bottle Number', 'URL ID'));

		if ($stmt = $conn->prepare("SELECT number_of_bottles FROM campaigns WHERE campaign_ID = ?")) {
			/* bind parameters for markers */
		    $stmt->bind_param("i", $campaign_ID);

		    /* execute query */
		    $stmt->execute();

		    /* bind result variables */
		    $stmt->bind_result($number_of_bottles);

		    /* fetch value */
		    $stmt->fetch();

		    /* close statement */
		    $stmt->close();

		    // Signifiers must be a char value greater than f because we're using Hex encoding
			$url = "http://coop.io.tt/g"; // g signifies Campaign url
			$campaign_ID = dechex($campaign_ID); // To be defined by mysql

			$url = $url . $campaign_ID . "s"; 

			for($i = 1; $i < ($number_of_bottles + 1); $i++){
				$shortURL = $url . dechex($i);
				$row = array($i, $shortURL);
				fputcsv($output, $row);
			}
		}
		$conn->close();
		}
	}
?>