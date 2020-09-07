<?php
namespace App\Controllers;
use League\Plates\Engine;
use App\Services\Database;
use PDO;
use Tamtamchik\SimpleFlash\Flash;
use Delight\Auth\Auth;
use App\Services\Roles;


class Controller {
    protected $database;
    protected $view;
    protected $auth;
    public function __construct() {
        $this->view = components(Engine::class);
        $this->database = components(Database::class);
        $this->auth = components(Auth::class);
    }

    protected function checkForAccess() {
        if($this->auth->hasRole(Roles::USER)) { return back(); }
    }

    protected function isLoggedIn() {
        if (!$this->auth->isLoggedIn()) {return checkSignIn();}
    }
}