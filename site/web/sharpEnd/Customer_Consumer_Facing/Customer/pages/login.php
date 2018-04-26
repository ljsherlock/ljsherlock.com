<div class="container">

	<div class="typography typography--b2c">

		<h1>Welcome</h1>

		<p>Log in with your Facebook or email to be in with the chance of winning the trip to Bordeaux to see our wine being made.</p>

	</div>

</div>

<div id="login" class="login">

	<h2>To begin game</h2>

	<form action="#">

		<p>

    	<input type="checkbox" id="terms" class="filled-in" checked="checked" />

			<label for='terms'><span>I agree to the Terms and Conditions</span></label>

	    </p>

	</form>

	<div class="login__btns">

		<a href="#facebook" class="btn btn--facebook btn--round" id="facebookLoginTrigger">Login with Facebook</a>

		<a href="#" class="btn btn--cancel btn--round">Login with Email</a>

	</div>

	<div class="facebook" style="display: none;" id="facebookLogin">

		<?php include 'pages/facebook.php'; ?>

	</div>

</div>
