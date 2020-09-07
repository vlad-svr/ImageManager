<?php $this->layout('layout') ?>
<main class="my-mt flex-grow-1 flex-shrink-0">
    <div class="image-header сontainer-fluid">
        <div class="jumbotron jumbotron-fluid bg-image-header-upload text-color">
            <div class="container">
                <h1 class="display-4 text-body">Редактирование</h1>
                <p class="lead text-body">Заполните форму и пополните вашу галерею.</p>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center">

        <form class="w-50 mb-5 mt-2" action="/photos/<?=$image['id']?>/update" method="POST" enctype="multipart/form-data">
            <?= flash(); ?>
            <div class="form-group">
                <label for="title" class="font-weight-bold">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="<?=$image['title']?>">
            </div>
            <div class="form-group">
                <label for="description" class="font-weight-bold">Краткое описание</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?=$image['description']?></textarea>
            </div>
            <div class="form-group">
                <label for="category_id" class="font-weight-bold">Выберите категорию</label>
                <select class="form-control" id="category_id" name="category_id">
                    <? foreach ($categories as $category): ?>
                       
                    <option  <?if($category['id'] == $image['category_id']):?>selected<?endif;?> value="<?=$category['id']?>"><?=$category['title']?></option>
                        
                    <? endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="files" class="font-weight-bold">Выберите картинку</label>
                <input type="file" class="form-control-file" id="files" name="image">
            </div>
            <div class="form-group">
                <img src="<?=getImg($image['image']);?>" style="width: 100%" alt="">
            </div>
            <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Обновить</button>
            <a href="/photos/<?= $image['id']; ?>" class="btn btn-secondary">Отменить</a>
            <button data-btn="delete" data-href="/photos/<?= $image['id']; ?>/delete" class="btn btn-danger">Удалить</button>
            </div>
        </form>

    </div>

</main>