<?php
namespace App\Controllers;
use App\Services\Notifications;

class VerificationController extends Controller {
    private $notifications;
    function __construct(Notifications $notifications) {
        parent::__construct();
        $this->notifications = $notifications;
    }

    function showForm() {
        echo $this->view->render('/auth/email-verification');
    }

    function verify() {
        try {
            $this->auth->confirmEmail($_GET['selector'], $_GET['token']);
        
            flash()->success(['Ваш email подтвержден!']);
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            flash()->error(['Неверный токен']);
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            flash()->error(['Токен испортился']);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error(['Email уже существует']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Куда ломишься!??!']);
        }

        ($this->auth->isLoggedIn()) ? back('profile') : back('login');        
    }

    function verifyResend() {
        try {
            $this->auth->resendConfirmationForEmail($_POST['email'], function ($selector, $token) {
                $this->notifications->emailSend($_POST['email'], $selector, $token);
                flash()->success(['На вашу почту ' . $_POST['email'] . ' был отправлен код с подтверждением.']);
            });
        }
        catch (\Delight\Auth\ConfirmationRequestNotFound $e) {
            flash()->error(['Не найдено более раннего запроса, который можно отправить повторно']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Слишком много запросов - попробуйте позже']);
        }
        back('login');
    }
    
}