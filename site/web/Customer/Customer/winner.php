<?php

	include('templates/header.php'); ?>

<?php include('pages/winner.php'); ?>

<?php
	include('templates/footer.php');
?>

<script type="text/javascript">

	clearTimeout(windowLoaded);

	windowLoaded = setTimeout(function(){
			$('body').addClass('loaded');
	}, 2000);

</script>
