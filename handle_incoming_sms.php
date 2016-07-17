<?php

if($_SERVER["CONTENT_TYPE"] != "application/json") {
  header("HTTP/1.1 415 Only application/json content type is accepted");
  return;
}

$data = json_decode(file_get_contents('php://input'), true);

if($data["device"] == "mohsen") {
  $to = "m.hariri@gmail.com";
}else{
  $to = "feraswilson2010@gmail.com";
}

if(isset($data["from"]) && isset($data["timestamp"]) && isset($data["body"])) {
  mail($to , "sms" , $data["body"],
        "From: " . $data["from"] . "@vphone-1339.appspotmail.com");
}else {
  header("HTTP/1.1 400 Request is missing required paramters");
}
