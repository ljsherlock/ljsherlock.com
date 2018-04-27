<?php
	// $user = "sharpend_univerre_platform";
	$user = "sharpend_univerr";
	$pswd = "S_^7gNMA+JhAw.w";
	// $db = "sharpend_univerre_platform-db";
	$db = "sharpend_univerr";
	// mysqli_report(MYSQLI_REPORT_ALL);
	$conn = new mysqli("localhost", $user, $pswd, $db);
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
