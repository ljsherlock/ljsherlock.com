<?php
	// Intercepts url if file has not been found
	if (isset($_GET['campaign_ID'])) :
		$campaign_ID = $_GET['campaign_ID'];
		include_once 'templates/database.php';

		// Query database for brand ID
		$sql = "SELECT campaign_ID FROM campaigns WHERE campaign_ID = '$campaign_ID'";
		$result = $conn->query($sql);
		if($result->num_rows != 0) :

?>

			<h2>Download Campaign URLs</h2>

			<form method="POST" action="drivers/download_csv.php">
				<input style="display:none;" name="campaign_ID" type="number" value="<?php echo $campaign_ID; ?>" />
				<div id="buttons">
					<button class="submit-button" type="submit" name="button_value" value="URL">URL</button>
					<button class="submit-button" type="submit" name="button_value" value="NFC">NFC</button>
					<button class="submit-button" type="submit" name="button_value" value="QR">QR</button>
				</div>

			</form>

		<?php
			else:
		?>
				<h1>No Campaign Found</h1>
		<?php
			endif;
		?>
<?php
	else:
?>
		<h1>No Campaign Found</h1>
<?php
	endif;
?>