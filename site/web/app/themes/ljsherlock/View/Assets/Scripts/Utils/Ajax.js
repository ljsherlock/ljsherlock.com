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
    }

});
