<?php
namespace App\Controllers\Admin;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use App\Services\ImageManager;

class PhotosController extends Controller {
    private $imageManager;
    function __construct(ImageManager $imageManager) {
        parent::__construct();  
        $this->imageManager = $imageManager;    
    }

    function index() {
        $count = count($this->database->all('images'));
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 15;
        $url = '/admin/photos?page=(:num)';
        $photos = $this->database->getAllImagesPage('images', $page, $perPage);
        $paginator = paginate($count, $page, $perPage, $url);
      
        echo $this->view->render('/admin/photos/index', ['count' => $count, 'paginator' => $paginator, 'images' => $photos, 'perPage' => $perPage]);
    }

    function show($id) {
        $image = $this->database->find('images', $id);
        echo $this->view->render('/admin/photos/show', ['image' => $image]);
    }

    function create() {
        $categories = $this->database->all('categories');
        echo $this->view->render('/admin/photos/create', ['categories' => $categories]);
    }

    function store() {
        $validator = v::key('title', v::stringType()->notEmpty())
        ->key('description', v::stringType()->notEmpty());

        $this->validate("admin/photos/create", $validator, $_POST, [
            'title'   =>  'Заполните поле: Название',
            'description' => 'Заполните поле: Краткое описание'
        ]);

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
        back('admin/photos/create');
    }

    function edit($id) {
        $image = $this->database->find('images', $id);
        $categories = $this->database->all('categories');
        echo $this->view->render('/admin/photos/edit', ['image' => $image, 'categories' => $categories]);
    }

    function update($id) {
        $imageOld = $this->database->find('images', $id);

        $validator = v::key('title', v::stringType()->notEmpty())
        ->key('description', v::stringType()->notEmpty());

        $this->validate("admin/photos/{$id}/edit", $validator, $_POST, [
            'title'   =>  'Заполните поле: Название',
            'description' => 'Заполните поле: Краткое описание'
        ]);

        if(isset($_FILES['image'])) {
            $imageUpd = $this->imageManager->uploadImage($_FILES['image'], $imageOld['image']);
            if(isset($imageUpd)) $dimensions = $this->imageManager->getDimension($imageUpd);
        };

        $data = [
            "title" =>  $_POST['title'] ,
            "description" =>  $_POST['description'],  
            "image" => (isset($imageUpd)) ? $imageUpd : $imageOld['image'],    
            "category_id" =>  $_POST['category_id'],
            "user_id"   =>  $imageOld['user_id'],
            "date_edit"  =>  time(),      
            "dimensions" => (isset($imageUpd)) ? $dimensions : $imageOld['dimensions'],
        ];       
        $this->database->update('images', $id, $data);
        flash()->success(['Картинка обновлена']);
        back("admin/photos/{$id}/edit");
    }

    function delete($id) {
        $image = $this->database->find('images', $id);        
        $this->imageManager->deleteImage($image['image']);
        $this->database->delete('images', $image['id']);
        back('admin/photos');
    }

    private function validate($url, $validator, $data, $message)
    {
        try {
            $validator->assert($data);

        } catch (ValidationException $exception) {
            $exception->findMessages($message);
            flash()->error($exception->getMessages());

            return back($url);
        }
    }
}