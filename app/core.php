<?php
use Delight\Auth\Auth;
use JasonGrimes\Paginator;
use App\Services\Database;
use DI\ContainerBuilder;
use App\Services\Roles;

function components($name) {
    global $container;
    return $container->get($name);
}

function auth() {
    global $container;
    return $container->get(Auth::class);
}

function config($key, $data = null) {
    require ('../app/config.php');
    if($data == null) { return $config[$key]; } 
        return $config[$key][$data];    
}

function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function back($url = '')
{
    header("Location: /" . $url);
    exit;
}

function checkSignIn()
{
    header("Location: /login");
    exit;
}

function uploadDate($timestamp)
{
    return date('d.m.Y', $timestamp);
}

function getImg($img) {
    return (new App\Services\ImageManager())->getImage($img);
}

function getAllCategories()
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    return $database->all('categories');
}

function getAvatarUser($id) {
    global $container;
    $database = $container->get('App\Services\Database');
    return $database->find('users', $id);
}

function paginate($count, $page, $perPage, $url)
{
    $totalItems = $count;
    $itemsPerPage = $perPage;
    $currentPage = $page;
    $urlPattern = $url;

    $paginator =  new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    return $paginator;
}

function paginator($paginator) {
    include '../app/Views/template/pagination.php';
}

function getCategoryId($id) {
    global $container;
    $database = $container->get('App\Services\Database');
    return $database->find('categories', $id);
}

function getUser($idUser) {
    global $container;
    $database = $container->get('App\Services\Database');
    return $database->find('users', $idUser);
}

function getRole($role) {
    return Roles::getRole($role);
}

function getAllRole() {
    return Roles::getAllRole();
}

function getRoleIdUser($idUser) {
    $user = getUser($idUser);
    return Roles::getRole($user['roles_mask']);
}

function getStatus($status) {
    return Roles::getStatus($status);
}

function getVerifyEmail($key) {
    if($key == 1) {
        return 'Подтверждён';
    } else {
        return 'Не подтверждён';
    }
}

function strTrimLength($str, $length) {
    return mb_strimwidth($str, 0, $length);
}