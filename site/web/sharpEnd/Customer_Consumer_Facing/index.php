<?php

	// Intercepts url if file has not been found

	$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	// coops.io.tt/g1se
	$url_decider = substr($url, 1);
	die(var_dump($url));
	if ($url_decider == 'g'){
		// Direct user to campaign / Consumer front end site
	} else if ($url_decider == 'p'){
		// Direct user to palette / customer front end site
	}

?>
