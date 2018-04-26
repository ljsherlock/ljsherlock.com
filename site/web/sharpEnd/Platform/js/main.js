(function ($) {

    //initialize all modals
    $('.modal').modal();

    var order_number; // Making it accessible
    $('#tableSelect tr').click(function() {
        $(this).find('th input[type=radio]').prop('checked', true);

        order_number = $(this).find('td.order_number_item').html();
        $('#order_number_input').val(order_number);

        var total_palettes = $(this).find('td.total_palettes_item').html();
        $('#total_palettes_input').val(total_palettes);
        $('#total_palettes_input_span').text('(' + total_palettes*15000 + ' bottles)');

        var contact = $(this).find('td.contact_item').html();
        $('#contact_input').val(contact);

        // console.log(order_number);
    })


    // Modal for App Confirmation
    $('#app_confirmation_success').hide();
    $("#app_confirmation a.confirm").on("click", function() {
        $("#app_confirmation").hide();
        $("#app_confirmation_success").show();
        // Redirect to Analytics page
        setTimeout(function(){ window.location = 'summary.php?type=order&order_number_ID=' + order_number; }, 1000);
    });

    // Modal for Campaign Confirmation
    $('#campaign_confirmation_success').hide();
    $("#campaign_confirmation a.confirm").on("click", function() {
        $("#campaign_confirmation").hide();
        $("#campaign_confirmation_success").show();
        // Redirect to Analytics page
        // Return campaign ID from form submit
        // setTimeout(function(){ window.location = 'summary.php?type=campaign&campaign_ID=' + order_number; }, 1000);
    });

})(jQuery); // end of jQuery name space
