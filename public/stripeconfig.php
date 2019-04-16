<?php
require_once('../vendor/autoload.php');

$stripe = [
  "secret_key"      => "",
  "publishable_key" => "pk_test_u4Ddl7OZT1GmxbPn6ulACC0z00yZ0KVkuh",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
