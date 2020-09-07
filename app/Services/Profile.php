<?php
namespace App\Services;
use Delight\Auth\Auth;
use App\Services\ImageManager;

class Profile {
    private $auth;
    private $notifications;
    private $database;
    private $imageManager;

    function __construct(Auth $auth, Notifications $notifications, Database $database, ImageManager $imageManager) {
        $this->auth = $auth;
        $this->notifications = $notifications;
        $this->database = $database;
        $this->imageManager = $imageManager;
    }

    function changeInformation($userName = null, $email, $file) {
        if($this->auth->getEmail() != $email) {         
                $this->auth->changeEmail($email, function ($selector, $token) use ($email) {
                   $this->notifications->emailSend($email, $selector, $token);
                   flash()->success(['На вашу почту ' . $email . ' был отправлен код с подтверждением.']);
                });       
        }       
        $user = $this->database->find('users', $this->auth->getUserId());
        if (isset($_FILES['image'])) {
            $filename = $this->imageManager->uploadImage($_FILES['image'], $user['avatar']);
        }
        $this->database->update('users', $this->auth->getUserId(), [
            'username' => isset($userName) ? $userName : $this->auth->getUsername(),
            'avatar' => isset($filename) ? $filename : $user['avatar']
        ]);
    }
}