(function($) {

    $(document).ready(function() {

        var active = 'content-image--active';

        setInterval(function() {
            var content = $('.content-image');

            // if there are multiple components lopp through
            content.each(function() {
                var images = content.find('img');

                // if images exist in the component
                if(images.length > 0) {
                    // get the active img and make it inactive
                    var activeEl = $(this).find('img.'+active);
                    activeEl.removeClass(active);

                    // if there is a sibling to the active img make it active
                    // otherwise make the first child active
                    if( activeEl.next().length > 0 ) {
                        activeEl.next().addClass(active);
                    } else {
                        images.filter(':first-child').addClass(active);
                    }
                }
            })
        },3000);

    });

})( jQuery );
