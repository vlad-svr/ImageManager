<?php
namespace App\Controllers\Admin;
use App\Services\Roles;
use App\Services\ImageManager;

class UsersController extends Controller {
    private $roles;
    private $imageManager;

    function __construct(Roles $roles, ImageManager $imageManager) {
        parent::__construct();
        $this->roles = $roles;
        $this->imageManager = $imageManager;
    }

    function index() {
        $count = count($this->database->all('users'));
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 15;
        $url = '/admin/users?page=(:num)';
        $users = $this->database->getAllImagesPage('users', $page, $perPage);
        $paginator = paginate($count, $page, $perPage, $url);
        echo $this->view->render('admin/users/index', ['count' => $count, 'paginator' => $paginator, 'users' => $users, 'perPage' => $perPage]);
    }

    function show($id) {
        $user = $this->database->find('users', $id);
        echo $this->view->render('admin/users/show', ['user' => $user]);
    }

    function create() {
        $rolesUsers = Roles::getRoles();
        $this->auth->hasRole(1); 
        echo $this->view->render('admin/users/create', ['roles' => $rolesUsers, 'bannedStatus' => $bannedStatus]);
    }

    function store() {
        try {
            $id = $this->auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);
            $user = $this->database->find('users',$id);
            $data = [
                'status'    =>  isset($_POST['status']) ? Roles::BANNED : Roles::NORMAL,
                'roles_mask'    =>  $_POST['roles_mask']
            ];

            $data['avatar'] = $this->imageManager->uploadImage($_FILES['image'], $user['avatar']);

            $this->database->update('users', $id, $data);
            flash()->success(['Пользователь успешно создан']);
            return back('admin/users/create');
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            // invalid email address
            flash()->error(['Неправильный формат email']);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            // invalid password
            flash()->error(['Неправильный пароль']);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            // user already exists
            flash()->error(['Пользователь уже существует']);
        }

        return back('admin/users/create');
    }

    function edit($id) {
        $rolesUsers = Roles::getRoles();
        $bannedStatus = Roles::BANNED;
        $user = $this->database->find('users', $id);
        $this->auth->hasRole(1); 
        echo $this->view->render('admin/users/edit', ['user' => $user, 'roles' => $rolesUsers, 'bannedStatus' => $bannedStatus]);
    }

    function update($id) {
        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'roles_mask' => $_POST['roles_mask'],            
            'status' => isset($_POST['status']) ? Roles::BANNED : Roles::NORMAL,
            'verified' => isset($_POST['verified']) ? 1 : 0,
        ];
        
        if(!empty($_POST['password'])) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        };
        $user = $this->database->find('users', $id);
        if(isset($_FILES)!=0) {
            $newImg = $this->imageManager->uploadImage($_FILES['image'], $user['avatar']); 
            if(isset($newImg)) $data['avatar'] = $newImg;
        };
        $this->database->update('users', $id, $data);
        flash()->success(['Пользователь успешно отредактирован']);
        back("admin/users/$id/edit");      
    }

    function delete($id) {
        try {
            $user = $this->database->find('users', $id);        
            $this->imageManager->deleteImage($user['avatar']);
            $this->auth->admin()->deleteUserById($id);
            flash()->success(['Пользователь успешно удален']);
            back('admin/users');
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            flash()->error(['Пользователь не найден']);
        }

        return back('admin/users');
    }
}