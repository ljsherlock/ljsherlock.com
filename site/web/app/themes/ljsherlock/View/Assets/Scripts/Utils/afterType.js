define(['Util'], function( Util )
{
    //user is "finished typing," do something
    function doneTyping (callback)
    {
      callback();
    }

    return {
        addEvent: function(el, callback)
        {
            //setup before functions
            var typingTimer;                //timer identifier
            var doneTypingInterval = 1500;  //time in ms, 5 second for example

            //on keyup, start the countdown
            Util.addEventHandler(el, 'keyup', function()
            {
                clearTimeout(typingTimer);

                typingTimer = setTimeout(function()
                {
                    doneTyping( function(){
                        callback();
                    });
                }, doneTypingInterval );
            });

            //on keydown, clear the countdown
            Util.addEventHandler(el, 'keydown', function() {
              clearTimeout(typingTimer);
            });
        }
    }
});
