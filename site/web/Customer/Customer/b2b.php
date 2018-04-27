<?php

/**
* @page B2B
* @description B2B page after NFC Scan
* @author ljsherlock
*/

include('templates/header-io.php');

?>

<div class="loading-screen loading-screen--b2b">

  <img src="assets/images/iott.png" alt="">

  <div class="loading-screen__loader"></div>

</div>

  <?php include('pages/b2b.php'); ?>


<?php
	include('templates/footer.php');
?>
