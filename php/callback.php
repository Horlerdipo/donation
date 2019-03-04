<?php
//INITIALIZE THE CURL FUNCTION
$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
}
//DEFINING THE PARAMETERS 
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization:sk_test_25465e645ceaa4b30e9b3d4619b66ff63935f105",
    "cache-control: no-cache"
  ],
));
//EXECUTES THE CURL FUNCTION AND CHECK FOR ERROR
$response = curl_exec($curl);
$err = curl_error($curl);
if($err){
    // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}
//DECODE THE RESPONSE FROM JSON TO ARRAY
$tranx = json_decode($response);
//CHECK IF THE STATUS IS SUCCESS 
if(!$tranx->status){
  // there was an error from the API
  die('API returned error: ' . $tranx->message);
}

if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value
  //PUT THE TRANSACTION REFRENCE INTO THE DATABASE
  $query="INSERT INTO payment (email,payment_ref) VALUES ('$email','$reference')";
  $new=$database->querydb($query);
  echo "<h2>Thank you for making a purchase. Your file has bee sent your email.</h2>";
}
?>