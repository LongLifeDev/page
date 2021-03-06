<?php
  require_once('./stripeconfig.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => 500000,
      'currency' => 'usd',
  ]);

  echo '<h1>Successfully charged</h1>';
?>