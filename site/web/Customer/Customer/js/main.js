(function ($) {

    windowLoaded = setTimeout(function(){
        $('body').addClass('loaded');
    }, 750);

    //initialize all modals
    $('.modal').modal();

    $('.modal-trigger').on('click', function(){
    	var name = (this.id);
    	var name_formatted = name.replace(/-/g, " ");
    	console.log(name_formatted);
    	$('#product_name').html(name_formatted);
    });

    $('.product-archive a.modal-trigger').on('click', function(){
        var categoryid_name = $(this).find('#categoryid_span').text();

        var category_name = $(this).find('#category_span').text();
        $('.category_name').html(category_name);
        var product_name = $(this).find('#product_span').text();
        $('.selectable_product_name').html(product_name);
        var productid_name = $(this).find('#productid_span').text();

        var share_button_anchor = $("a#share_button").attr('href');
        var new_href = share_button_anchor.split("style")[0];
        new_href += 'style=' + categoryid_name + '&product=' + productid_name;

        console.log(productid_name);

        $('#share_button').attr('href', new_href);

    });

    // B2C
    $('#socialChosen').hide();
    $('#socialConfirm').hide();

    $('#facebookShare').on('click', function () {
      $('#socialChoice').hide();
      $('#socialChosen').show();
    });

    $('#facebookLoginTrigger').on('click', function () {
      $('#facebookLogin').show();
    });

    $('#facebookLoginCancel').on('click', function () {
      $('#facebookLogin').hide();
    });

    $('#socialConfirmTrigger').on('click', function () {
      $('#socialChosen').hide();
      $('#socialConfirm').show();
    });


    // B2B
    $('#orderConfirm, #orderMore, #orderConfirmedTick').hide();

    $('#orderMoreTrigger').on('click', function () {
      $('#orderReorder').hide();
      $('#orderMore').show();
    });

    $('#orderConfirmTrigger').on('click', function () {
      $('#orderConfirm').modal('open');
    });

    $('#orderConfirmedTickTrigger').on('click', function () {
      $('#orderConfirmed').hide();
      $('#orderConfirmedTick').show();
    });



})(jQuery); // end of jQuery name space
