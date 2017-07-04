define(['Util'], function( Util )
{
    function get_posts(component, responseLocation)
    {
        component.classList.remove('blog-archive__results--loaded');
        component.classList.add('blog-archive__results--loading');
        component.classList.add('blog-archive__results--matches');

        document.querySelector('.paged').value = 0;

        setTimeout(function()
        {
            var post = processTheForm();

            // Get posts filtered by the checked inputs and
            // return the compiled templates.
            Ajax(component, responseLocation, post);

        }, 750);
    }

    function Ajax(component, responseLocation, post)
    {
        require(['Utils/Ajax'], function(Ajax)
        {
            return Ajax.put(ajax_url, {
                action: 'archivesFilterSearch',
                post: post,
                ajax: true,
            }, function(response)
            {
                var data = JSON.parse(response);

                // add the response first because the HTML is hidden.
                responseLocation.innerHTML = data.template;
                // add num of posts to the element
                document.querySelector('.blog-archive__num-posts').innerHTML = data.num_of_posts;

                pagedEl = document.querySelector('.paged');
                pagedEl.value = 2;

                // fade in the results.
                setTimeout(function()
                {
                    component.classList.remove('blog-archive__results--loading');
                    component.classList.add('blog-archive__results--loaded');
                }, 750);
            });
        });
    }

    function appendPosts(component, responseLocation)
    {
        var paged = 0;

        component.classList.add('blog-archive__results--matches');

        pagedEl = document.querySelector('.paged');
        if(pagedEl.value != '' || pagedEl.value != 0 )
        {
            paged = +pagedEl.value ++ ;
        } else {
            paged = 2;
        }

        pagedEl.value = paged;

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
                    ajax: true,
                    paged: paged
                }, function(response)
                {
                    var data = JSON.parse(response);

                    // add the response first because the HTML is hidden.
                    responseLocation.innerHTML += data.template;
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

        initialPosts: function(component, responseLocation)
        {
            var post = { 'years[]' : { 0 : 2017 } };

            Ajax(component, responseLocation, post);
        },

        getPosts : function(component, responseLocation)
        {
            get_posts(component, responseLocation);
        },

        appendPosts: function(component, responseLocation)
        {
             appendPosts(component, responseLocation)
        },

        setFormEvents: function( els, component, responseLocation )
        {
            // Attach click event to checkboxes
            [].forEach.call(els, function(el)
            {
                // on Change event handler
                Util.addEventHandler(el, 'change', function()
                {
                    get_posts(component, responseLocation);
                });
            });

            // Add events to the keyword field
            require(['Utils/Events'], function(events)
            {
                typingTimer = events.actionAfterTyping(document.querySelector('.blog-archive__keyword'), function()
                {
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
