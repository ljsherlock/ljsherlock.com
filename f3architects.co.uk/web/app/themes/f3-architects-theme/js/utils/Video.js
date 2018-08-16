define( function () {
  return {
    playPauseVideo: function (videoBlock) {
      if ( videoBlock) {
          var videoElement = videoBlock.querySelector("video"),
          videoButton = videoBlock.querySelector(".video__playpause");

          videoElement && videoButton && (videoElement.removeAttribute("controls"), videoButton.addEventListener("click", function() {
              videoElement.paused ? (videoElement.play(),
              videoButton.classList.add("video__playpause--playing")) : (videoElement.pause(),
              videoButton.classList.remove("video__playpause--playing"))
          }, !1))
      }
    }
  }
});
