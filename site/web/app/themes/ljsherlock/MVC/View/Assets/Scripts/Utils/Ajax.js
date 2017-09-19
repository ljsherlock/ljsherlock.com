define(['Util'], function( Util )
{

    return {
        put: function( url, json, success, fail )
        {
            var xhr = new XMLHttpRequest(),
            str = Object.keys(json).map(function(key)
            {
                return encodeURIComponent(key) + '=' + encodeURIComponent(json[key]);
            }).join('&');

            xhr.open('PUT', url + '?' + str );
            xhr.setRequestHeader("Content-Type", "application/json");

            if( json != '' )
            {
                var json_string = JSON.stringify( json );
                xhr.send(json_string);
            }

            xhr.onload = function()
            {
                if (xhr.status === 200)
                {
                    if( typeof success === 'function' ) {
                        success(xhr.responseText);
                    } else {
                        return xhr.responseText;
                    }
                }
                else if (xhr.status !== 200)
                {
                    if( typeof fail === 'function' )
                    {
                        fail();
                    } else {
                        alert('Request failed.  Returned status of ' + xhr.status);
                    }
                }
            }

            return xhr;
        },

        internalLinks : function()
        {
            var main = document.querySelector('main'),
            site_url = 'http://' + top.location.host.toString();
            var internal_links = document.querySelectorAll("a[href^='" + site_url +"']");

            // internal_links.classList.add('internal_links');

            [].forEach.call(internal_links, function(el)
            {
                el.classList.add('internal_link');

                el.addEventListener('click', function(event)
                {
                    event.preventDefault();

                    document.querySelector('html').style.overflow = 'auto';

                    document.querySelector('html').classList.remove('page--loaded-signal');
                    document.querySelector('html').classList.remove('page--loading-close');
                    // window.onload = function()
                    // {
                        // document.querySelector('html').classList.remove('page--loaded-signal').remove('page--loading-close');
                        // setTimeout(function() {
                        //     document.querySelector('html').classList.add('overlay--loading-close');
                        // }, 750);page--loading-close
                    // };

                    var url = el.getAttribute('href');

                    // remove .main content
                    // show Animations
                    // insert ajax content in .main

                    // AJAX
                    var json_string = JSON.stringify({
                        ajax: true
                    });

                    var xhr = new XMLHttpRequest();
                    xhr.open('PUT', url );
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.send(json_string);
                    xhr.onload = function()
                    {
                        if (xhr.status === 200)
                        {
                            var content = document.querySelector('main');
                            var response = xhr.responseText;

                            content.innerHTML = response;

                            document.querySelector('html').classList.add('page--loaded-signal');
                            document.querySelector('html').classList.add('page--loading-close');

                            // App.page_setup();
                            // Run page init.
                        }
                        else if (xhr.status !== 200)
                        {
                            alert('Request failed.  Returned status of ' + xhr.status);
                        }
                    };

                });
            });
        }
    }

});
