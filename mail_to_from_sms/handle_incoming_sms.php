<?php

if($_SERVER["CONTENT_TYPE"] != "application/json") {
  header("HTTP/1.1 415 Only application/json content type is accepted");
  return;
}

require_once('users.php');

$data = json_decode(file_get_contents('php://input'), true);

if(isset($DEVICES[$data["device"]])) {
  $to = $DEVICES[$data["device"]];
}else{
  $to = "mohsen+dead+sms@vphone.io";
  syslog(LOG_INFO, $data["device"]);
  syslog(LOG_INFO, $data);
}

if(isset($data["from"]) && isset($data["timestamp"]) && isset($data["body"])) {
  mail($to , "RE: sms" , $data["body"],
        "From: " . $data["from"] . "@vphone-1339.appspotmail.com");
}else {
  header("HTTP/1.1 400 Request is missing required paramters");
}
