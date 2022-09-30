<?php

namespace App\congig\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


class Mail
{

  function __construct()
  {
    $this->mail = new PHPMailer(true);
  }

  public function  sendMail(string $recipient, string $subject, $body, string $from = SECURE_EMAIL)
  {
    try {
      //Server settings
      $this->mail->SMTPDebug = 0;                                       //Enable verbose debug output
      $this->mail->isSMTP();                                            //Send using SMTP
      $this->mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
      $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $this->mail->Username   = SECURE_EMAIL;                           //SMTP username
      $this->mail->Password   = SECURE_PWD_EMAIL;                       //SMTP password
      $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set 
      $this->mail->CharSet = 'UTF-8';
      //Recipients
      $this->mail->setFrom($from, 'stayInShape');                       // le nom au-dessus du mail 
      $this->mail->addAddress($recipient);

      //Content
      $this->mail->isHTML(true);                                        //Set email format to HTML
      $this->mail->Subject = $subject;
      $this->mail->Body    = $body;


      if ($this->mail->send()) {
        return "un e-mail de confirmation vient d'être envoyé";
      }
    } catch (Exception $e) {
      return  false;
    }
  }
}
