<?php
namespace App\Controllers;
use App\Services\ImageManager;
use App\Services\Profile;

class ProfileController extends Controller {
    private $imageManager;
    private $profile;
    function __construct(ImageManager $imageManager, Profile $profile) {
        parent::__construct();
        $this->imageManager = $imageManager;
        $this->profile = $profile;
    }

    public function showProfile() {
        $this->isLoggedIn();
        $user = $this->database->find('users', $this->auth->getUserId());
        echo $this->view->render('profile/profile', ["user" => $user]);
    }

    public function uploadsProfile() {
        $this->isLoggedIn();
        try {            
                $this->profile->changeInformation($_POST['username'], $_POST['email'], $_FILES['image']);    
                flash()->success(['Профиль обновлен']);
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error(['Неверный формат Email']);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error(['Email уже существует']);
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            flash()->error(['Почта не подтверждена']);
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            flash()->error(['Вы не залогинены']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Слишком много запросов']);
        }        
        return back('profile');
    }

    public function uploadsPassword() {
        try {
            $this->auth->changePassword($_POST['oldPassword'], $_POST['newPassword']);
        
            echo flash()->success(['Пароль успешно изменен!']);
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            echo flash()->error(['Вы не залогинены']);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            echo flash()->error(['Неправильный пароль!']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            echo flash()->error(['Куда ломишься!']);
        }
    }

    public function deleteAvatar() {
            $this->isLoggedIn();            
                $user = $this->database->find('users', $this->auth->getUserId());

            if($this->imageManager->checkImage($user['avatar'])) {
                $this->imageManager->deleteImage($user['avatar']);
                $this->database->update('users', $this->auth->getUserId(), [
                    'avatar' => null
                ]);
                flash()->success(['Изображение удалено']);  
            } else {
                flash()->error(['Изображение отсутствует']);
            }      
            return back('profile');
    }

}