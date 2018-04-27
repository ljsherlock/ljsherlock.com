
<div class="order" id="orderReorder">

  <div class="order__header typography typography--center">

    <img src="assets/images/bottle.png" alt="bottle">

    <h1>Valais</h1>

  </div>

  <div class="order__body typography">

    <ul>
      <li>
        <strong>Order Number:</strong> C000000001
      </li>
      <li>
        <strong>Palette ID #:</strong> 001
      </li>
      <li>
        <strong># of Palettes:</strong> 100 <span class="text--small">(150,000 bottles)</span>
      </li>
      <li>
        <strong>Contact:</strong> c.yves@coop.ch
      </li>
    </ul>

  </div>

  <div class="order__footer">

    <a href="#reorder" id="orderMoreTrigger" class="btn btn--io btn--round">Reorder</a>

  </div>

</div>

<div class="order" id="orderMore">

  <div class="order__header typography typography--center">

    <img src="assets/images/bottle.png" alt="bottle">

    <h1>Valais</h1>

  </div>

  <div class="order__body typography typography--center">

    <p><strong>Order More Palettes?</strong></p>

    <form class="" action="index.html" method="post">

      <input type="text" name="number_of_items" class="input--large browser-default" value="100">

    </form>

  </div>

  <div class="order__footer">

    <a href="#reorder" id="orderConfirmTrigger" class="btn btn--io btn--round">Confirm</a>

  </div>

</div>

<!-- Share Modal -->
<div id="orderConfirm" class="card modal">

  <div id="orderConfirmed">

    <div class=" modal__header">

      <h3 class="card-title">Confirm Order?</h3>

    </div>

    <div class="card-action modal__content typography typography--center">

        <h3>100 Palettes</h3>

    </div>

    <div class="card-action modal__footer">

      <div class="row">

        <div class="col s6">
            <a id="cancel" href="#cancel" class=" modal-close ">Cancel</a>
        </div>

        <div class="col s6">
          <a id="orderConfirmedTickTrigger" class="" href="#order-confirmed">OK</a>
        </div>

      </div>

    </div>

  </div>

  <div id="orderConfirmedTick">

    <div class="card-action modal__content typography">

      <img src="assets/images/tick.png" alt="tcik">

      <div class="typography typography--center">

        <br>

        <h2>Order Confirmed</h2>

      </div>

      <div class="card-content row">

        <ul class="col s12 offset-m3 m6">
          <li>
            <strong>Order Number:</strong> C000000001
          </li>
          <li>
            <strong>Palette ID #:</strong> 001
          </li>
          <li>
            <strong># of Palettes:</strong> 100 <span class="text--small">(150,000 bottles)</span>
          </li>
        </ul>

      </div>

    </div>

  </div>

</div>
