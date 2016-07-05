<?php
// Get the contents of the mail here.
$mail_data = file_get_contents('php://input');
// Do something with those contents
echo syslog(LOG_INFO, $mail_data);

// this line loads the library
require('twilio-lib/Services/Twilio.php');
$account_sid = 'ACaa1ab21d52bfe7db483476cb73e542ee';
$auth_token = '136744467d43ef890d7e77d092366d0e';
$client = new Services_Twilio($account_sid, $auth_token);
$client->account->messages->create(array(
  'To' => "+16518675309",
  'From' => "+14158141829",
  'Body' => "Tomorrow's forecast in Financial District, San Francisco is Clear.",
  'MediaUrl' => "https://climacons.herokuapp.com/clear.png",
));

?>
