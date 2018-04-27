
<div class="loading-screen loading-screen--b2c">

  <img src="assets/images/question.png" alt="">

  <h1>Seeing if<br> you've won</h1>

</div>

<div class="winner">

  <div class="winner__hero">

    <img src="assets/images/bordeaux.jpg" alt="" class="responsive-img">

  </div>

  <div class="winner__content typography typography--center typography--b2c">

    <div class="container">

      <h1>You've Won!</h1>

      <p>You're going to Bordeaux! We'll send you an email with details on how to reclaim your prize.</p>

    </div>

  </div>

  <div class="winner__action typography typography--center">

    <a href="#share" id="share-button" class="modal-trigger">

      <img src="assets/images/share.png" alt="Share" class="icon icon--sm">

    </a>

  </div>

</div>

<div class="card darken-1">


</div>

<!-- Share Modal -->
<div id="share" class="card modal modal--b2c">

  <div class=" modal__header">
    <h3 class="card-title">Share Your Win</h3>
  </div>

  <div id="socialChoice">

    <div class="card-action modal__content">
      <div class="nav nav--share row">
        <div class="col s3">
          <a href="#" id="facebookShare">
            <img src="assets/images/s_fb.png" alt="" class="responsive-img">
            <span>Facebook</span>
          </a>
        </div>
        <div class="col s3">
          <a href="#">
            <img src="assets/images/s_tw.png" alt="" class="responsive-img">
            <span>Twitter</span>
          </a>
        </div>
        <div class="col s3">
          <a href="#">
            <img src="assets/images/s_wa.png" alt="" class="responsive-img">
            <span>WhatsApp</span>
          </a>
        </div>
        <div class="col s3">
          <a href="#">
            <img src="assets/images/s_pi.png" alt="" class="responsive-img">
            <span>Pinterest</span>
          </a>
        </div>
      </div>
    </div>
    <div class="card-action modal__footer">
      <a id="cancel" class="col s4 modal-action modal-close">Cancel</a>
    </div>
  </div>

  <div id="socialChosen">

    <div class="card-action modal__content">

        <div class="row">

            <div class="col s5">

              <img src="assets/images/bordeaux-share.png" class="responsive-img" alt="">

            </div>

            <div class="preview-article col s7">

              <p><strong>James Won</strong></p>

              <p>James is off to Bordeaux to see how Valais is made</p>

            </div>
        </div>

    </div>

    <div class="modal__footer card-action">

      <div class="row">

        <div class="col s4">
            <a id="cancel" class="modal-action modal-close ">Cancel</a>
        </div>

        <div class="col s8">
          <a id="socialConfirmTrigger" href="#shareConfirm" class="">Share to Facebook</a>
        </div>

      </div>

    </div>

  </div>

  <div id="socialConfirm">

    <div class="modal__content card-action typography typography--center">

      <img src="assets/images/tick_orange.png" alt="">

      <p>Post Shared to Facebook</p>

    </div>

  </div>

</div>
