<?php
namespace App\Controllers;
use League\Plates\Engine;
use App\Services\Database;

class HomeController extends Controller {
    public function index() {
        $photos = $this->database->allImagesHome('images', 12);
        echo $this->view->render('home', ["photos" => $photos]);
    }

    public function category($id) {
        $count = $this->database->getCount('images', 'category_id', $id);

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 12;
        $categoryImages = $this->database->getImagesUser('images', 'category_id', $id, $page, $perPage);
        $url = "/category/$id?page=(:num)";
        $paginator = paginate($count, $page, $perPage, $url);
        $category = $this->database->find('categories', $id);
        echo $this->view->render('/category', ['images' => $categoryImages, 'paginator' => $paginator, 'count' => $count, 'category' => $category, 'perPage' => $perPage]);
    }

    public function user($id) {   
        $count = $this->database->getCount('images', 'user_id', $id);
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 12;
        $userImages = $this->database->getImagesUser('images', 'user_id', $id, $page, $perPage);
        $url = "/user/$id?page=(:num)";
        $paginator = paginate($count, $page, $perPage, $url);
        $user = $this->database->find('users', $id);
        echo $this->view->render('/user', ['images' => $userImages, 'paginator' => $paginator, 'count' => $count, 'user' => $user, 'perPage' => $perPage]);
    }
}