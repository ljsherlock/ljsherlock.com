<?php
	// $user = "sharpend_univerre_platform";
	$user = "lewisjsh";
	$pswd = "Enterthematrix0921";
	// $db = "sharpend_univerre_platform-db";
	$db = "lewisjsh_sharpend";
	// mysqli_report(MYSQLI_REPORT_ALL);
	$conn = new mysqli("46.29.93.70", $user, $pswd, $db, 3306);
	if ($conn->connect_error) {
    	end_output(1, "DBCONERR");
	}

	function end_output($response, $message) {
		$output = array();
		$output["response"] = $response;
		$output["message"] = $message;
		// echo json_encode($output);
		die();
	}
?>
