<?php

require_once('esendex-php-sdk/src/autoload.php');
require_once('../secrets.inc.php');
require_once('Mail.php');
require_once('users.php');


// Get the contents of the mail here.
$mail_data = file_get_contents('php://input');

syslog(LOG_INFO, $mail_data);

$mail = new Mail($mail_data);

$to = $mail->extract_destination();
$sender = $mail->extract_sender();

$contents = $mail->extract_contents();

syslog(LOG_INFO, sprintf("sending sms to '%s', contents: '%s'",
                          $to, $contents));

if(isset($USERS[$sender])) {
  $from = $USERS[$sender];
} else {
  syslog(LOG_INFO, "invalid sender: " . $sender);
  exit();
}


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
