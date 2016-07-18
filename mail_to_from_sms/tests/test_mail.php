<?php

require(dirname(__FILE__) . "/../Mail.php");

class mail_utils extends PHPUnit_Framework_TestCase {

  public function test_extract_sender()
  {
    $mail = new Mail(file_get_contents(dirname(__FILE__) . '/mail1.txt'));
    $this->assertEquals("m.hariri@gmail.com", $mail->extract_sender());

  }

  public function test_extract_destination_with_to()
  {
    $mail = new Mail(file_get_contents(dirname(__FILE__) . '/mail1.txt'));
    $this->assertEquals("46725857312", $mail->extract_destination());
  }

  public function test_extract_destination_with_deliver_to()
  {
    $mail = new Mail(file_get_contents(dirname(__FILE__) . '/mail2.txt'));
    $this->assertEquals("+46731835553", $mail->extract_destination());
  }


  public function test_extract_contents()
  {
    $mail = new Mail(file_get_contents(dirname(__FILE__) . '/mail1.txt'));
    $this->assertEquals("bang", $mail->extract_contents());

    $mail = new Mail(file_get_contents(dirname(__FILE__) . '/mail2.txt'));
    $this->assertEquals("Testing", $mail->extract_contents());

    $mail = new Mail(file_get_contents(dirname(__FILE__) . '/mail3.txt'));
    $this->assertEquals("really?", $mail->extract_contents());

  }


}
