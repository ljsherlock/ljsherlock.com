define(['Util'], function( Util )
{

    function action(responseLocation)
    {
        var post = {},
        tags = document.querySelectorAll( "input[name='post_tag[]']:checked" ),
        categories = document.querySelectorAll( "input[name='category[]']:checked" ),
        years = document.querySelectorAll( "input[name='years[]']:checked" );
        post.keyword = document.querySelector(".blog-archive__keyword").value;

        // Loop through our checkboxes and push into seperate arrays defined
        // by the input name IE 'name[]'
        [tags, categories, years].forEach( function(item)
        {
            item.forEach( function(check, index)
            {
                if(index == 0)
                    post[check.name] = {};

                post[check.name][index] = check.value;
            });
        });

        // Get posts filtered by the checked inputs and
        // return the compiled templates.
        require(['Utils/Ajax'], function(Ajax)
        {
            Ajax.put(ajax_url, {
                action: 'archivesFilterSearch',
                post: post,
                ajax: true
            }, function(responseText)
            {
                // search results
                // append to page
                responseLocation.innerHTML = responseText;
            });
        });
    }

    return {
        form: function( els, responseLocation )
        {
            // loop through all of the checkboxes to attached the event to each one.
            [].forEach.call(els, function(el)
            {
                // on Change event handler
                Util.addEventHandler(el, 'change', function()
                {
                    action(responseLocation);
                });
            });

            require(['Utils/afterType'], function(type)
            {
                type.addEvent(document.querySelector('.blog-archive__keyword'), function() {
                    action(responseLocation)
                });
            });

        }
    }
});
