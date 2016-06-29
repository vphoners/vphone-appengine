<?php
// Get the contents of the mail here.
$mail_data = file_get_contents('php://input');
// Do something with those contents
echo syslog(LOG_INFO, $mail_data);

?>
