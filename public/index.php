<?php
if( !session_id() ) @session_start();

require_once '../vendor/autoload.php';
require_once '../app/core.php';
require_once '../app/routes.php';

// $templates = new League\Plates\Engine('../app/Views');

// echo $templates->render('home');
