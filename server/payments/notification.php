<?php

  include_once("../conexao.php");

  $collection_id = $_REQUEST['collection_id'];
  $collection_status = $_REQUEST['collection_status'];
  $payment_id = $_REQUEST['payment_id'];
  $status = $_REQUEST['status'];
  $external_reference = $_REQUEST['external_reference'];
  $payment_type = $_REQUEST['payment_type'];
  $merchant_order_id = $_REQUEST['merchant_order_id'];
  $preference_i = $_REQUEST['preference_i'];
  $site_id = $_REQUEST['site_id'];
  $processing_mode = $_REQUEST['processing_mode'];
  $merchant_account_id = $_REQUEST['merchant_account_id'];

  $access_token = 'SEU ACCESS TOKEN';

  $curl = curl_init();

  curl_setopt_array(
    $curl, 
    array(
      CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/'.$collection_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$access_token
      ),
    )
  );

  $payment_info = json_decode(curl_exec($curl), true);
  curl_close($curl);

  $email = $payment_info["payer"]["email"];
  $status = $payment_info["status"];
  $valor = $payment_info["additional_info"]["items"][0]["unit_price"];

  $res = $pdo->prepare(
      "INSERT into pay (email, status, valor) values (:email, :status, :valor)"    
  );

  $res->bindValue(":email", $email);
  $res->bindValue(":status", $status);
  $res->bindValue(":valor", $valor);

  $res->execute();

  header("Location: https://seusite.com/");

  die();

?>
