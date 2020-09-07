<?php
namespace App\Services;
use Delight\Auth\Auth;


class Registration {
    protected $auth;
    protected $notifications;
    protected $database;
    function __construct(Auth $auth, Database $database, Notifications $notifications) {
        $this->auth = $auth;
        $this->database = $database;
        $this->notifications = $notifications;
    }

    function make($email, $password, $username) {
        $userId = $this->auth->register($email, $password, $username, function ($selector, $token) use($email) {
            // send `$selector` and `$token` to the user (e.g. via email)
            $this->notifications->emailSend($email, $selector, $token);
        });
        $this->database->update('users', $userId, ["roles_mask" => Roles::USER]);
        return $userId;
    }
}