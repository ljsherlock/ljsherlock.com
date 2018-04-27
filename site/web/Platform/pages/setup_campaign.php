<div class="breadcrumbs row">

	<div class="col s12">

		<a href="#!" class="breadcrumb"><h4>Coop</h4></a>

		<a href="#!" class="breadcrumb breadcrumb--icon"><h4>Add Campaign</h4></a>

	</div>

</div>

<div class="newcampaign">

<div class="row">

	<div class="col s4">

		<div class="form typography row" id="form">
			<div class="col s12">
				<h5>Campaign Name</h5>
				<input name="campaign_name" type="text" value="" class="input">
			</div>

			<div class="col s12"div>
				<h5>Product</h5>
				<input name="product" type="text" value="" class="input"/>
			</div>

			<div class="col s12">
				<h5>No. of Items for Campaign</h5>
				<input name="number_of_items" type="number" value="" class="input"/>
			</div>

			<div class="col s12">
				<h5>Campaign Type</h5>
					<select name="campaign_type" class="browser-default input">
						<option value="" disabled selected>Choose Campaign Type</option>
						<option value="repurchase">repurchase</option>
						<option value="provenance">provenance</option>
						<option value="recipes">recipes</option>
						<option value="instant_win">instant win</option>
						<option value="expiry">expiry</option>
						<option value="survey">survey</option>
					</select>
			</div>

			<div class="col s12">
				<h5>Campaign Destination URL</h5>
				<label>coop.io.tt/</label>
				<input name="campaign_url" type="url" value="" class="input"/>
			</div>

			<div class="col s12">
				<h5>Campaign Description (optional)</h5>
				<textarea name="description" rows="8" cols="80"></textarea>
			</div>

			<div class="col s12">
				<a href="#campaign_create" class="modal-trigger btn btn--io btn--round" type="submit" id="create_campaign-button" value="Confirm Order">Create Campaign</a>
			</div>

			<!-- <input style="display:none;" name="client_ID" type="number" value="<?php echo $client_ID; ?>" /> -->
			<!-- <input type="submit" id="submit-button" value="Create Campaign"/> -->
		</div>

	</div>

</div>


<!-- <div id="campaign_create" class="modal">
		<div id="campaign_confirmation">
			<div class="modal-content row">
					<img class="responsive-img col s4 offset-s4" src="assets/bottle.png" />
	      	<h4>Valais 2018</h4>
	      	<p>Create Campaign and Generate Bottle IDs?</p>
	    </div>
			<div class="modal-footer">
				<a class="col s4 modal-action modal-close btn-flat">Cancel</a>
				<a id="submit-button" class="confirm col s6 push-s2 btn-flat">OK</a>
			</div>
		</div>
		<div id="campaign_confirmation_success">
			<div class="modal-content row">
					<img class="responsive-img col s4 offset-s4" src="assets/tick.png" />
	      	<h4>Valais 2018</h4>
	      	<p>Bottle IDs created</p>
		    </div>
	    </div>
	</div>
</div> -->

<!-- Share Modal -->
<div id="campaign_create" class="card modal">

		<div id="campaign_confirmation">

			<div class="card-action modal__content typography typography--center">

				<img class="responsive-img col s4 offset-s4" src="assets/bottle.png" />
				<h4><strong>Valais 2018</strong></h4>
				<p>Create Campaign and Generate Bottle IDs?</p>

			</div>

			<div class="card-action modal__footer">

				<div class="row">

					<a id="cancel" href="#cancel" class="col s6 modal-close ">Cancel</a>

					<a id="submit-button" class="col s6 confirm" href="#order-confirmed">OK</a>

				</div>

			</div>

		</div>

		<div id="campaign_confirmation_success">

			<div class="card-action modal__content typography typography--center">

				<img class="responsive-img col s4 offset-s4" src="assets/tick.png" />
				<h4>Valais 2018</h4>
				<p>Bottle IDs created</p>

			</div>

		</div>

</div>



<script type="text/javascript">
	var submitButton = $("#submit-button");

	submitButton.on("click", function(){
		$.ajax({
			type : "POST",
			url : "ajaxHandler.php",
			data : {
				form: 'add_campaign', // Determines how ajaxData handles request
				campaign_name : $(".input")[0].value,
				product : $(".input")[1].value,
				number_of_items : $(".input")[2].value,
				campaign_type : $(".input")[3].value,
				campaign_url : $(".input")[4].value,
				description : $("textarea").val(),
				client_ID : <?php echo $client_ID; ?>,
			},
			success: function(data){
				console.log(data);
				var objJSON = JSON.parse(data);
				console.log(objJSON[0]);
				console.log(objJSON[1]);
				// if(objJSON[0] && objJSON[1]){
				// 	// alert('success');
				// // 	// $("#form").hide();
				// // 	// $(".add_campaign").attr("href", "campaign.php?campaign_ID=" + objJSON[2])
				// // 	// $('#form_submit').show();
				// } else {
				// // 	// alert(objJSON);
				// 	alert('Error: The form could not be submitted');
				// }

				// Redirect page with obtained campaign_ID
				setTimeout(function(){ window.location = 'summary.php?type=campaign&campaign_ID=' + objJSON[1]; }, 1000);
			}
		});
	});
</script>
