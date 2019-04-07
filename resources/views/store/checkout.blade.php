<?php require_once('./stripeconfig.php'); ?>

<form action="/charge/{{$total}}" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-description="Access for a year"
          data-amount={{$total}};
          data-locale="auto"></script>
          {{csrf_field()}}
</form>

