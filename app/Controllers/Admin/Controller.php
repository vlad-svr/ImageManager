<?php
namespace App\Controllers\Admin;
use App\Controllers\Controller as AdminController;
use App\Services\Roles;

class Controller extends AdminController {
    function __construct() {
        parent::__construct();
        if(!$this->auth->hasRole(Roles::ADMIN)) { return back(); }
    }
}