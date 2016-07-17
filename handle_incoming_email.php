<?php
// Get the contents of the mail here.
$mail_data = file_get_contents('php://input');

echo syslog(LOG_INFO, $mail_data);

function get(&$var, $default=null) {
    return isset($var) ? $var : $default;
}

function extract_destination($mail, $header_struct) {
  $header_part = mailparse_msg_get_part($mail, $header_struct);
  $headers = mailparse_msg_get_part_data($header_part);
  $to_email = get($headers["headers"]["delivered-to"],
                $headers["headers"]["to"]);
  $to = explode("@", $to_email)[0];
  return $to;
}

function extract_contents($mail, $contents_struct, $mail_data) {
  $contents_part = mailparse_msg_get_part($mail, $contents_struct);
  ob_start();
  mailparse_msg_extract_part($contents_part, $mail_data);
  $contents = ob_get_clean();
  return trim($contents);
}

$mail = mailparse_msg_create();
mailparse_msg_parse($mail, $mail_data);
$struct = mailparse_msg_get_structure($mail);

$to = extract_destination($mail, $struct[0]);
if(isset($struct[1]))
  $contents = extract_contents($mail, $struct[1], $mail_data);
if(empty($contents))
  $contents = extract_contents($mail, $struct[0], $mail_data);

echo syslog(LOG_INFO, sprintf("sending sms to '%s', contents: '%s'",
                          $to, $contents));


$from = "46738966872";

require_once('esendex-php-sdk/src/autoload.php');
require('secrets.inc.php');

$message = new \Esendex\Model\DispatchMessage(
    $from,
    $to,
    $contents,
    \Esendex\Model\Message::SmsType
);
$authentication = new \Esendex\Authentication\LoginAuthentication(
    $account_ref, // Your Esendex Account Reference
    $email, // Your login email address
    $password // Your password
);
$service = new \Esendex\DispatchService($authentication);
$result = $service->send($message);
?>
