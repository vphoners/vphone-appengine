<?php

class Mail {

  private $mail, $struct, $mail_data;

  public function __construct($mail_data) {
    $this->mail_data = $mail_data;
    $this->mail = mailparse_msg_create();
    mailparse_msg_parse($this->mail, $this->mail_data);
    $this->struct = mailparse_msg_get_structure($this->mail);
  }


  function get(&$var, $default=null) {
      return isset($var) ? $var : $default;
  }

  function extract_destination() {
    $header_part = mailparse_msg_get_part($this->mail, $this->struct[0]);
    $headers = mailparse_msg_get_part_data($header_part);
    $to_email = $this->get($headers["headers"]["delivered-to"],
                  $headers["headers"]["to"]);
    $to = explode("@", $to_email)[0];
    return $to;
  }

  function extract_contents_from_part($struct) {
    $contents_part = mailparse_msg_get_part($this->mail, $struct);
    ob_start();
    mailparse_msg_extract_part($contents_part, $this->mail_data);
    $contents = ob_get_clean();
    return $this->remove_reply_part($contents);
  }

  function remove_reply_part($contents) {
    $re =  "/^(.*)On[^\\,]+,[^\\,]+,[^\\,]+(,[^\\,]+)?wrote:/Ums";
    preg_match($re, $contents, $matches);
    if($matches) {
      $contents = $matches[1];
    }
    return trim($contents);
  }

  function extract_contents() {
    if(isset($this->struct[1])) {
      $contents = $this->extract_contents_from_part($this->struct[1]);
    }
    if(empty($contents)) {
      $contents = $this->extract_contents_from_part($this->struct[0]);
    }

    return $contents;
  }

  function extract_sender() {
    $header_part = mailparse_msg_get_part($this->mail, $this->struct[0]);
    $headers = mailparse_msg_get_part_data($header_part);
    $from = mailparse_rfc822_parse_addresses($headers["headers"]["from"]);
    return $from[0]["address"];
  }
}
