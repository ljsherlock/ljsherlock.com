define(function () {

    /**
    * @name buttonClick
    * @function Default action for buttons: Add classes for button status
    */

    return {
      buttonClick: function (button, overlay)
      {
          [].forEach.call(document.querySelectorAll(button), function(el) {
              el.addEventListener('click', function(event) {
                  event.preventDefault();

                  var selected = document.querySelectorAll('.btn--active');
                  var event_overlay = this.parentNode.parentNode.querySelector(overlay);

                  // Status: Inactive
                  if(this.classList.contains('btn--active')) {
                      this.classList.remove('btn--active');
                      this.classList.add('btn--inactive');
                      if(event_overlay !== null) {
                          event_overlay.classList.remove('events-overlay--visible');
                      }

                  // Status: Active
                  } else {
                      this.classList.remove('btn--inactive');
                      this.classList.add('btn--active');
                      if(event_overlay !== null) {
                          event_overlay.classList.add('events-overlay--visible');
                      }
                  }

                  //
                  if(selected !== null && selected.length > 0) {
                      [].forEach.call(selected, function(el) {
                          el.classList.remove('btn--active');
                          el.classList.add('btn--inactive');
                      });
                  }
              });
          });
      },
    }
});
