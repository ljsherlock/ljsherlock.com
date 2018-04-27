<!DOCTYPE html>

<html>

	<head>

		<title></title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<link type="text/css" rel="stylesheet" href="css/theme.min.css" >

	</head>

	<body>

		<header class="header header--io row valign-wrapper">

			<div class="row navigation">

				<div class="col">

					<?php $filename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>

						<?php if ($filename !== 'Platform') { ?>

							<a href="#" onclick="window.history.back()">
								<img src="assets/back.png" alt="" class="icon icon--xs">
							</a>

						<?php } ?>

				</div>

				<div class="col">

					<?php if ($filename !== 'client.php' && $filename !== 'Platform') { ?>

						<a href="/Platform">
							<img src="assets/home.png" alt="" class="icon icon--xs">
						</a>

					<?php } ?>

				</div>

			</div>

			<img src="assets/iott.png" alt="Logo">

		</header>

		<main>
