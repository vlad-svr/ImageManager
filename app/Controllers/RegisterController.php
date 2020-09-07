<?php
namespace App\Controllers;
use App\Services\Registration;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class RegisterController extends Controller {
    protected $registration;
    function __construct(Registration $registration) {
        parent::__construct();
        $this->registration = $registration;
    }
    function register() {
        // echo 'ok';
        $this->validate();
        try {
            $this->registration->make(           
                $_POST['email'],
                $_POST['password'],
                $_POST['username']
            );
            echo 'OK';
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
           echo flash()->error(['Неправильный email']);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
           echo flash()->error(['Неправильный пароль']);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
           echo flash()->error(['Пользователь уже существует']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
           echo flash()->error(['Слишком много раз пытаетесь зарегаться']);
        }
    }

    private function validate() {
        $validator = v::key('username', v::stringType()->notEmpty())
        ->key('email', v::email())
        ->key('password', v::stringType()->notEmpty())        
        ->key('terms', v::trueVal())
        ->key('password_confirmation',  v::equals($_POST['password']));

        try {
            $validator->assert($_POST);
        } catch(ValidationException $exception) {
            $exception->findMessages($this->getMessages());
            echo flash()->error($exception->getMessages());
            exit;
        }
    }

    private function getMessages() {
        return [
            'terms'   =>  'Вы должны согласится с правилами.',
            'username' => 'Введите имя',
            'email' => 'Неверный формат e-mail',
            'password'  =>  'Введите пароль',
            'password_confirmation' =>  'Пароли не совпадают'
        ];
    }

}