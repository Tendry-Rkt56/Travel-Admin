<?php

namespace App\Trait;

trait SendMail 
{

     public function mailer (
          string $destinataire, 
          string $expediteur = "tendry@gmail.com",
          ?string $subject = null,
          string $message
          )
     {
          $headers  = "MIME-Version: 1.0\r\n";
          $headers .= "Content-type: text/html; charset=UTF-8\r\n";
          $headers .= "From: $expediteur\r\n";
          $headers .= "Reply-To: $expediteur\r\n";

          return mail($destinataire, $subject, $message, $headers);
     }

}