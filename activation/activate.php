<?php

include("creds.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if($_SERVER["CONTENT_TYPE"] != "application/json") {
    header("HTTP/1.1 415 Only application/json content type is accepted");
    return;
  }

  $data = json_decode(file_get_contents('php://input'), true);

  if(isset($data["phone_number"]) && isset($data["email"])) {
    $ch = curl_init("https://api.twilio.com/2010-04-01/Accounts/ACaa1ab21d52bfe7db483476c/OutgoingCallerIds.json");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
      "FriendlyName" => $data["email"] . ":" . genrand(),
      "PhoneNumber" => $data["phone_number"])));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization : Basic ".base64_encode($CREDS)));
    $result = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $res = json_decode($result, true);
    syslog(LOG_INFO, $status_code . " - " . $result);
    if($status_code != 200) {
      if($res["code"] == 21450) {
        header("HTTP/1.1 409 phone number already active");
        return;
      }
      if($res["code"] == 13223) {
        header("HTTP/1.1 400 invalid phone number");
        return;
      }
      header("HTTP/1.1 500 error");
      header('Content-Type: application/json');
      echo $result;
      return;
    }
    curl_close ($ch);
    header('Content-Type: application/json');
    echo json_encode(array("device" => $res["friendly_name"], "validation_code" => $res["validation_code"]));

  }else {
    header("HTTP/1.1 400 Request is missing required paramters");
  }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $ch = curl_init("https://api.twilio.com/2010-04-01/Accounts/ACaa1ab21d52bfe7db48347/OutgoingCallerIds.json?FriendlyName=" . urlencode($_GET["device"]));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization : Basic ".base64_encode($CREDS)));
  $result = curl_exec($ch);
  curl_close ($ch);
  syslog(LOG_INFO, $result);
  $res = json_decode($result, true);
  if(!$res["outgoing_caller_ids"]) {
    header("HTTP/1.1 404 device not found");
    return;
  }
} else {
  header("HTTP/1.1 405 method not supported");
}



function genrand($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
