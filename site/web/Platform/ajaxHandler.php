<?php
	//Include the database configuration file
	include_once 'templates/database.php';

/*********
Add new campaign
**********/
	if(($_POST["form"]) == 'add_campaign'){

		$response_array = array();

		// Get POST variables
		$client_ID = mysqli_real_escape_string( $conn, $_POST["client_ID"] );
		$product  = mysqli_real_escape_string( $conn, $_POST["product"] );
		$campaign_name  = mysqli_real_escape_string( $conn, $_POST["campaign_name"] );
		$campaign_type  = mysqli_real_escape_string( $conn, $_POST["campaign_type"] );
		$campaign_url = mysqli_real_escape_string( $conn, $_POST["campaign_url"] );
		$campaign_description = mysqli_real_escape_string( $conn, $_POST["description"] );
		$number_of_items = mysqli_real_escape_string( $conn, $_POST["number_of_items"] );


		$stmt = $conn->prepare("INSERT INTO campaigns
			(client_ID, product, campaign_name, campaign_type, campaign_URL, campaign_description, number_of_bottles)
			VALUES (?, ?, ?, ?, ?, ?, ?)"
		);

		if($stmt == true) {

			$stmt->bind_param("issssss", $client_ID, $product, $campaign_name, $campaign_type, $campaign_url, $campaign_description, $number_of_items);
					// Check if campaign query was executed successfully
			if( $result = $stmt->execute() ) {
      	$response_array[] = true;
      	// If executed successfully return generated campaign_ID
      	$campaign_ID = $stmt->insert_id;
      	$response_array[] .= $campaign_ID;
      } else {
      	$response_array[] = false;
      	$campaign_ID = null;
      }

		$stmt->close();
		} else {
			echo 'error';
		}



		// // Make another query
		// if($response_array[0] === true){		// If campaign query was successful..
		// 	$stmt = $conn->prepare("INSERT INTO `items` (`campaign_ID`, `number_of_items`, `campaign_url`) VALUES (?, ?, ?)");

		// 	$stmt->bind_param("iis", $campaign_ID, $number_of_items, $campaign_url);

		// 	// Check if items query was executed successfully
		// 	if($stmt->execute()){
  //       		$response_array[] = true;
	 //        } else {
	 //        	$response_array[] = false;
	 //        }

		// 	$stmt->close();

		// 	$response_array[] = $campaign_ID;
		// }
		// Array content = ['campaigns_success', 'items_success']
		echo json_encode($response_array);
		$conn->close();
	}
?>
