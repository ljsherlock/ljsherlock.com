define(['Util'], function( Util )
{

    function sendPost(post, responseLocation)
    {
        require(['Utils/Ajax'], function(Ajax)
        {
            Ajax.put( {
                url: ajax_url,
                action: 'archivesFilterSearch',
                ajax: true,
                post: post
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
                Util.addEventHandler(el, 'change', function()
                {
                    var post = [],
                    tags = document.querySelectorAll( "input[name='post_tag[]']:checked" ),
                    categories = document.querySelectorAll( "input[name='category[]']:checked" ),
                    years = document.querySelectorAll( "input[name='year[]']:checked" );
                    post['keyword'] = document.querySelector(".blog-archive__keyword").value;

                    [tags, categories, years].forEach( function(item)
                    {
                        item.forEach( function(check, index)
                        {
                            if(index == 0)
                                post[check.name] = [];

                            post[check.name].push( check.value );
                        });
                    });

                    sendPost(post, responseLocation);

                });
            });
        }
    }
});
