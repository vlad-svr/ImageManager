<?php
namespace App\Controllers;
use App\Services\Notifications;

class ResetPasswordController extends Controller {
    private $notifications;

    public function __construct(Notifications $notifications) {
        parent::__construct();
        $this->notifications = $notifications;      
    }

    public function showForm() {
        echo $this->view->render('/auth/password-recovery');
    }

    function recovery() {
        try {
            $this->auth->forgotPassword($_POST['email'], function ($selector, $token) {
                $this->notifications->passwordReset($_POST['email'], $selector, $token);
                flash()->success(['Код сброса пароля был отправлен вам на почту.']);
            });            
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error(['Неправильный email']);
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            flash()->error(['Почта не подтверждена']);
        }
        catch (\Delight\Auth\ResetDisabledException $e) {
            die('Сброс пароля недоступен');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Слишком много запросов']);
        }
        back('login');
    }

    function showSetForm() {
        if ($this->auth->canResetPassword($_GET['selector'], $_GET['token'])) {
            echo $this->view->render('/auth/password-set', ['data' => $_GET]);
        }
    }

    function changePassword() {
        try {
            $this->auth->resetPassword($_POST['selector'], $_POST['token'], $_POST['newPassword']);
            flash()->success(['Пароль успешно изменен.']);
            return back('login');
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            flash()->error(['Неверный токен']);
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            flash()->error(['Токен просрочен']);
        }
        catch (\Delight\Auth\ResetDisabledException $e) {
            flash()->error(['Изменение пароля отключено']);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error(['Введите пароль']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Слишком много запросов']);
        }
        back('login');
    }

}