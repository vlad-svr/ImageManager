<?php
namespace App\Services;

class Notifications {
    private $mailer;

    function __construct(Mail $mailer) {
        $this->mailer = $mailer;
    }

    public function emailSend($email, $selector, $token) {
        $message = "Здраствуйте!
        Для подтверждения вашей электронной почты - пройдите по ссылке в этом письме, если вы никак не связаны с данным сайтом-отправителем - проигнорируйте и удалите это письмо.
        http://imagemanager.com/verify_email?selector=" . \urlencode($selector) . "&token=" . \urlencode($token);
        $this->mailer->send($email, $message);
    }

    public function passwordReset($email, $selector, $token) {
        $message = "Здраствуйте!
        Для сброса вашего пароля - пройдите по ссылке в этом письме, если вы никак не связаны с данными действиями и сайтом-отправителем - проигнорируйте и удалите это письмо.
        http://imagemanager.com/password-recovery/form?selector=" . \urlencode($selector) . "&token=" . \urlencode($token);
        $this->mailer->send($email, $message);
    }
}