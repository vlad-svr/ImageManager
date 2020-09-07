<?php
namespace App\Controllers\Admin;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class CategoriesController extends Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
        $categories = $this->database->all('categories');
        echo $this->view->render('/admin/categories/index', ['categories' => $categories]);
    }

    function create() {
        echo $this->view->render('/admin/categories/create');
    }

    function store() {
        $validator = v::key('title', v::stringType()->notEmpty());

        $this->validate("admin/categories/create", $validator, $_POST, [
            'title'   =>  'Заполните поле: Название',
        ]);

        $data = [
            "title" =>  $_POST['title'],         
        ];

        $lastId = $this->database->create('categories', $data);
        flash()->success(['Категория создана']);
        back('admin/categories/create');
    }

    function edit($id) {
        $category = $this->database->find('categories', $id);
        echo $this->view->render('/admin/categories/edit', ['category' => $category]);
    }

    function update($id) {
        $validator = v::key('title', v::stringType()->notEmpty());

        $this->validate("admin/categories/$id/edit", $validator, $_POST, [
            'title'   =>  'Заполните поле: Название',
        ]);

        $data = [
            "title" =>  $_POST['title'],         
        ];

        $lastId = $this->database->update('categories', $id, $data);
        flash()->success(['Категория изменена']);
        back("admin/categories/$id/edit");
    }

    function delete($id) {
        $this->database->delete('categories', $id);
        back('admin/categories');
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