<?php
use Aura\SqlQuery\QueryFactory;
use DI\ContainerBuilder;
use League\Plates\Engine;
use Delight\Auth\Auth;
use FastRoute\RouteCollector;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Engine::class    =>  function() {
        return new Engine('../app/Views');
    },

    Swift_Mailer::class => function() {
        $transport = (new Swift_SmtpTransport(
            config('mail', 'smtp'),
            config('mail', 'port'),
            config('mail', 'encryption')
        ))
        ->setUsername(config('mail', 'email'))
        ->setPassword(config('mail', 'password'));
        return new Swift_Mailer($transport);
    },

    PDO::class    =>  function() {
        $driver = config('database', 'driver');
        $host = config('database', 'host');
        $dbname = config('database', 'dbname');
        $user = config('database', 'username');
        $pass = config('database', 'password');
        return new PDO("$driver:host=$host;dbname=$dbname", $user, $pass);
    },
    QueryFactory::class    =>  function() {        
        return new QueryFactory("mysql");
    },
    Auth::class    =>  function($container) {        
        return new Auth($container->get('PDO'));
    },
]);

$container = $containerBuilder->build();



$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->get('/', ["App\Controllers\HomeController", "index"]);
    $r->get('/category/{id:\d+}', ["App\Controllers\HomeController", "category"]);
    $r->get('/user/{id:\d+}', ['App\Controllers\HomeController', 'user']);

    $r->get('/search', ["App\Controllers\PhotosController", "search"]);    
    $r->get('/photos', ["App\Controllers\PhotosController", "index"]);
    $r->get('/photos/{id:\d+}', ["App\Controllers\PhotosController", "showImage"]);
    $r->get('/photos/create', ["App\Controllers\PhotosController", "create"]);
    $r->post('/photos/store', ["App\Controllers\PhotosController", "store"]);
    $r->get('/photos/{id:\d+}/edit', ["App\Controllers\PhotosController", "edit"]); 
    $r->post('/photos/{id:\d+}/update', ["App\Controllers\PhotosController", "update"]); 
    $r->get('/photos/{id:\d+}/delete', ["App\Controllers\PhotosController", "delete"]);   
    $r->get('/photos/{id:\d+}/download', ["App\Controllers\PhotosController", "download"]);

    $r->post('/register', ["App\Controllers\RegisterController", "register"]);    
    $r->get('/login', ["App\Controllers\LoginController", "showLogin"]);
    $r->post('/login', ["App\Controllers\LoginController", "login"]);
    $r->get('/logout', ["App\Controllers\LoginController", "logout"]);
    $r->get('/profile', ["App\Controllers\ProfileController", "showProfile"]);
    $r->post('/profile-uploads', ["App\Controllers\ProfileController", "uploadsProfile"]);
    $r->post('/password-uploads', ["App\Controllers\ProfileController", "uploadsPassword"]);
    $r->get('/password-recovery', ["App\Controllers\ResetPasswordController", "showForm"]);
    $r->post('/password-recovery', ["App\Controllers\ResetPasswordController", "recovery"]);
    $r->get('/password-recovery/form', ["App\Controllers\ResetPasswordController", "showSetForm"]);
    $r->post('/password-recovery/change', ["App\Controllers\ResetPasswordController", "changePassword"]);
    $r->get('/verify_email', ['App\Controllers\VerificationController', 'verify']);
    $r->get('/email-verification', ['App\Controllers\VerificationController', 'showForm']);
    $r->post('/verify-resend', ['App\Controllers\VerificationController', 'verifyResend']);
    $r->get('/delete-avatar', ['App\Controllers\ProfileController', 'deleteAvatar']);

    $r->addGroup('/admin', function (RouteCollector $r) {
        $r->get('', ['App\Controllers\Admin\HomeController', 'index']);
        $r->get('/photos', ['App\Controllers\Admin\PhotosController', 'index']);
        $r->get('/photos/create', ['App\Controllers\Admin\PhotosController', 'create']);
        $r->post('/photos/store', ['App\Controllers\Admin\PhotosController', 'store']);
        $r->get('/photos/{id:\d+}', ['App\Controllers\Admin\PhotosController', 'show']);
        $r->get('/photos/{id:\d+}/edit', ['App\Controllers\Admin\PhotosController', 'edit']);
        $r->post('/photos/{id:\d+}/update', ['App\Controllers\Admin\PhotosController', 'update']);
        $r->get('/photos/{id:\d+}/delete', ['App\Controllers\Admin\PhotosController', 'delete']);

        $r->get('/categories', ['App\Controllers\Admin\CategoriesController', 'index']);
        $r->get('/categories/create', ['App\Controllers\Admin\CategoriesController', 'create']);
        $r->post('/categories/store', ['App\Controllers\Admin\CategoriesController', 'store']);
        $r->get('/categories/{id:\d+}/edit', ['App\Controllers\Admin\CategoriesController', 'edit']);
        $r->post('/categories/{id:\d+}/update', ['App\Controllers\Admin\CategoriesController', 'update']);
        $r->get('/categories/{id:\d+}/delete', ['App\Controllers\Admin\CategoriesController', 'delete']);

        $r->get('/users', ['App\Controllers\Admin\UsersController', 'index']);
        $r->get('/users/create', ['App\Controllers\Admin\UsersController', 'create']);
        $r->post('/users/store', ['App\Controllers\Admin\UsersController', 'store']);
        $r->get('/users/{id:\d+}', ['App\Controllers\Admin\UsersController', 'show']);
        $r->get('/users/{id:\d+}/edit', ['App\Controllers\Admin\UsersController', 'edit']);
        $r->post('/users/{id:\d+}/update', ['App\Controllers\Admin\UsersController', 'update']);
        $r->get('/users/{id:\d+}/delete', ['App\Controllers\Admin\UsersController', 'delete']);


    });
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        var_dump('404 Not Found');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        var_dump('405 Method Not Allowed');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
     
        $container->call($handler, $vars);
        break;
}