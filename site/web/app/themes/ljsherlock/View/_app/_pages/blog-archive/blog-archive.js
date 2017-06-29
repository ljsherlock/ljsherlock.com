define(['Util'], function( Util )
{
    function get_posts(component, responseLocation)
    {
        component.classList.remove('blog-archive__results--loaded');
        component.classList.add('blog-archive__results--loading');
        component.classList.add('blog-archive__results--matches');

        setTimeout(function()
        {
            var post = processTheForm();

            // Get posts filtered by the checked inputs and
            // return the compiled templates.
            require(['Utils/Ajax'], function(Ajax)
            {
                return Ajax.put(ajax_url, {
                    action: 'archivesFilterSearch',
                    post: post,
                    ajax: true
                }, function(response)
                {
                    var data = JSON.parse(response);

                    // add the response first because the HTML is hidden.
                    responseLocation.innerHTML = data.template;
                    // add num of posts to the element
                    document.querySelector('.blog-archive__num-posts').innerHTML = data.num_of_posts;

                    // fade in the results.
                    setTimeout(function()
                    {
                        component.classList.remove('blog-archive__results--loading');
                        component.classList.add('blog-archive__results--loaded');
                    }, 750);
                });
            });


        }, 750);
    }

    function processTheForm()
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
        return post;
    }

    return {
        form: function( els, component, responseLocation )
        {
            // loop through all of the checkboxes to attached the event to each one.
            [].forEach.call(els, function(el)
            {
                // on Change event handler
                Util.addEventHandler(el, 'change', function()
                {
                    get_posts(component, responseLocation);
                });
            });

            require(['Utils/Events'], function(events)
            {
                typingTimer = events.actionAfterTyping(document.querySelector('.blog-archive__keyword'), function() {
                    get_posts(component, responseLocation)
                });

                // inside here so that it can accss and clear "typingTimer"
                Util.addEventHandler(document.querySelector('.blog-archive__keyword'), 'keypress', function(e)
                {
                    if ( e.which == 13 ) // Enter key = keycode 13
                    {
                        e.preventDefault();
                        clearTimeout(typingTimer);
                        get_posts(component, responseLocation);
                    }
                });
            });
        }
    }

});
