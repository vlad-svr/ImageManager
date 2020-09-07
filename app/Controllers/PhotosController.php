<?php
namespace App\Controllers;
use App\Services\ImageManager;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;



class PhotosController extends Controller {
    protected $imageManager;

   public function __construct(ImageManager $imageManager) {
        parent::__construct();
        $this->imageManager = $imageManager;
    }

    function index() {
        $this->isLoggedIn();
        $count = $this->database->getCount('images', 'user_id', $this->auth->getUserId());
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 12;
        $url = '/photos?page=(:num)';
        $photos = $this->database->getImagesUser('images', 'user_id', $this->auth->getUserId(), $page, $perPage);
        $paginator = paginate($count, $page, $perPage, $url);
        echo $this->view->render('photos/index', ['photos' => $photos, 'paginator' => $paginator, 'count' => $count, 'perPage' => $perPage]);
    }

    function showImage($id) {
        $image = $this->database->find('images', $id);
        $user = $this->database->find('users', $image['user_id']);
        $userImages = $this->database->whereAll('images', 'user_id', $user['id'], 4);
        $checkImageForUser = false;
        if($image['user_id'] == $this->auth->getUserId()) {
            $checkImageForUser = true;
        }
        echo $this->view->render('/photos/show', ['image' => $image, 'user' => $user, 'userImages' => $userImages, 'avatar' => $userImages, 'checkImageUser' => $checkImageForUser]);
    }

    function download($id) {
        $image = $this->database->find('images', $id);
        echo $this->view->render('/photos/download', ['image' => $image]);
    }

    public function create() {
        $this->isLoggedIn();
        $categ = $this->database->all('categories');       
       
        echo $this->view->render('/photos/create', ['categories' => $categ]);
    }

    function edit($id) {
        $this->isLoggedIn();        
        $image = $this->database->find('images', $id);
        if($image['user_id'] != $this->auth->getUserId()) {
            return back();
        }
        $categories = $this->database->all('categories');
        echo $this->view->render('/photos/edit', ['image' => $image,'categories' => $categories]);
    }

    function update($id) {
        $imageOld = $this->database->find('images', $id);

        $validator = v::key('title', v::stringType()->notEmpty())
        ->key('description', v::stringType()->notEmpty())
        ->key('category_id', v::intVal());
        
        $this->validate($validator, "photos/$id/edit");

        if(isset($_FILES['image'])) {
            $imageUpd = $this->imageManager->uploadImage($_FILES['image'], $imageOld['image']);
            if(isset($imageUpd)) $dimensions = $this->imageManager->getDimension($imageUpd);
        };
        $data = [
            "title" =>  $_POST['title'] ,
            "description" =>  $_POST['description'],  
            "image" => (isset($imageUpd)) ? $imageUpd : $imageOld['image'],    
            "category_id" =>  $_POST['category_id'],
            "user_id"   =>  $this->auth->getUserId(),
            "date_edit"  =>  time(),      
            "dimensions" => (isset($imageUpd)) ? $dimensions : $imageOld['dimensions'],
        ];       
        $this->database->update('images', $id, $data);
        flash()->success(['Картинка обновлена']);
        back("photos/{$id}/edit");
    }

    function delete($id) {
        $this->isLoggedIn();
        $image = $this->database->find('images', $id);
        if($image['user_id'] != $this->auth->getUserId()) {
            return back();
        }
        
        $this->imageManager->deleteImage($image['image']);
        $this->database->delete('images', $image['id']);
        back('photos');
    }

    function search() {   
        $count = count($this->database->search('images', $_GET['q'], $page, $perPage));    
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 12;
        $imagesFind = $this->database->search('images', $_GET['q'], $page, $perPage);
        $url = "/search?q={$_GET['q']}&page=(:num)";
        $paginator = paginate($count, $page, $perPage, $url);
        echo $this->view->render('/search', ['images' => $imagesFind, 'paginator'    =>  $paginator, 'count' => $count, 'searchValue' => $_GET['q'], 'perPage' => $perPage]);
    }

    public function store() {
        $validator = v::key('title', v::stringType()->notEmpty())
        ->key('description', v::stringType()->notEmpty())
        ->key('category_id', v::intVal())
        ->keyNested('image.tmp_name', v::image());
        
        $this->validate($validator, 'photos/creat');
        // var_dump($_FILES);
        $image = $this->imageManager->uploadImage($_FILES['image']);
        
        $dimensions = $this->imageManager->getDimension($image);
        $data = [
            "title" =>  $_POST['title'],
            "description" =>  $_POST['description'],
            "image" =>  $image,            
            "category_id" =>  $_POST['category_id'],
            "user_id"   =>  $this->auth->getUserId(),
            "date"  =>  time(),
            "dimensions" =>  $dimensions,            
        ];
        $lastId = $this->database->create('images', $data);
        flash()->success(['Спасибо! Картинка загружена']);
        back('photos/create');
    }


    private function validate($validator, $url)
    {
       
        try {
            $validator->assert(array_merge($_POST, $_FILES));

        } catch (ValidationException $exception) {
            $exception->findMessages($this->getMessages());
            flash()->error($exception->getMessages());

            // return back($url);
        }
    }

    private function getMessages()
    {
        return [
            'title' => 'Введите название',
            'description'   =>  'Введите описание',
            'category_id'   =>  'Выберите категорию',
            'image' =>  'Неверный формат картинки'
        ];
    }

}
