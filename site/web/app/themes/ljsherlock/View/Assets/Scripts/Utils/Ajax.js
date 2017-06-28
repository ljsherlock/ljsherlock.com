define(['Util'], function( Util )
{

    return {
        put: function( json, success, fail )
        {
            var xhr = new XMLHttpRequest();
            xhr.open('PUT', json.url + '?action=' + json.action );
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
                    success(xhr.responseText);
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
