<?php
namespace App\Controllers;
use Delight\Auth\Auth;

class LoginController extends Controller {

    public function showLogin() {
       $this->checkForAccess();
        echo $this->view->render('auth/login');
    }

    public function login() {
        try {
            $rememberDuration = null;

            if (isset($_POST['remember'])) {
                // keep logged in for one year
                $rememberDuration = (int) (60 * 60 * 24 * 365.25);
            }
            
            
            $this->auth->login($_POST['email'], $_POST['password'], $rememberDuration);        
            $this->checkIsBanned();    
            echo 'OK';
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            echo flash()->error(['Email не верный']);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            echo flash()->error(['Неверный пароль']);
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            echo flash()->error(['Email не подтвержден']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            echo flash()->error(['Куда ломишься?!']);
        }
    }

    public function checkIsBanned() {
        if ($this->auth->isBanned()) {
            echo flash()->error(['Вы забанены']);
            $this->auth->logOut();
            exit;            
        }
    }

    public function logout() {
        $this->auth->logOut();
        back();
    }
}