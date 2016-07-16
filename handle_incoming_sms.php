<?php

if($_SERVER["CONTENT_TYPE"] != "application/json") {
  header("HTTP/1.1 415 Only application/json content type is accepted");
  return;
}

$data = json_decode(file_get_contents('php://input'), true);

if(isset($data["from"]) && isset($data["timestamp"]) && isset($data["body"])) {

}else {
  header("HTTP/1.1 400 Request is missing required paramters");
}
