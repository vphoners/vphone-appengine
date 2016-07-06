<?php
// Get the contents of the mail here.
$mail_data = file_get_contents("email");//'php://input');

echo syslog(LOG_INFO, $mail_data);

function extract_destination($mail, $header_struct) {
  $header_part = mailparse_msg_get_part($mail, $header_struct);
  $headers = mailparse_msg_get_part_data($header_part);
  $to_email = $headers["headers"]["delivered-to"];
  $to = imap_rfc822_parse_adrlist($to_email, "")[0]->mailbox;
  return $to;
}

function extract_contents($mail, $contents_struct, $mail_data) {
  $contents_part = mailparse_msg_get_part($mail, $contents_struct);
  ob_start();
  mailparse_msg_extract_part($contents_part, $mail_data);
  $contents = ob_get_clean();
  return $contents;
}

$mail = mailparse_msg_create();
mailparse_msg_parse($mail, $mail_data);
$struct = mailparse_msg_get_structure($mail);

$to = extract_destination($mail, $struct[0]);
$contents = extract_contents($mail, $struct[1], $mail_data);

echo syslog(LOG_INFO, sprintf("sending email to '%s', contents: '%s'", $to, $contents);


$from = "46738966872";

require_once('esendex-php-sdk/src/autoload.php');
require('secrets.inc.php');

$message = new \Esendex\Model\DispatchMessage(
    $from,
    $to,
    "My Web App is SMS enabled!",
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
