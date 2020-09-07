<?php
namespace App\Controllers\Admin;


class HomeController extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        echo $this->view->render('admin/index');
    }
   
}