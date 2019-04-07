<?php
require_once('../vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_test_an1A0SN2NEATGRVbOEMbxiUL008bSM0Wom",
  "publishable_key" => "pk_test_u4Ddl7OZT1GmxbPn6ulACC0z00yZ0KVkuh",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>