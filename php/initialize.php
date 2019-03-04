<?php
if(isset($_POST['payment']) && !empty($_POST['payment']))
$curl = curl_init();
  session_start();
  
$email = $_SESSION['email'];
$amount = $_POST['payment'] * 100;  //the amount in kobo. This value is actually NGN 300

// url to go to after payment
$callback_url = 'http://localhost/donation/php/callback.php';  
//SETTING UP THE PARAMETERS FOR THE REQUEST
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'email'=>$email,
    'callback_url' => $callback_url
  ]),
  CURLOPT_HTTPHEADER => [
  "authorization:sk_test_25465e645ceaa4b30e9b3d4619b66ff63935f105", //replace this with your own test key
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));
//EXECUTE THE COMMAND
$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if(!$tranx->status){
  // there was an error from the API
  print_r('API returned error: ' . $tranx['message']);
}

// comment out this line if you want to redirect the user to the payment page
print_r($tranx);
// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $tranx['data']['authorization_url']);
?>