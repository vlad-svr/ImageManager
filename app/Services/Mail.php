<?php
namespace App\Services;
use Swift_Mailer;
use Swift_Message;

class Mail {
    protected $mailer;
    function __construct(Swift_Mailer $mailer) {
        $this->mailer = $mailer;
    }
    public function send($email, $body) {
        $message = (new Swift_Message('Моя галерея'))
        ->setFrom([config('mail', 'email') => 'ImageManager'])
        ->setTo($email)
        ->setBody($body);

       return $this->mailer->send($message);
    }
}