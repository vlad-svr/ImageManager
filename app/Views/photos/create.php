<?php $this->layout('layout') ?>
            <main class="my-mt flex-grow-1 flex-shrink-0">
                <div class="image-header сontainer-fluid">
                    <div class="jumbotron jumbotron-fluid bg-image-header-upload text-color">
                        <div class="container">
                            <h1 class="display-4 text-body">Новые события - новые фотографии!</h1>
                            <p class="lead text-body">Заполните форму и пополните вашу галерею.</p>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center">
               
                    <form class="w-50 mb-5 mt-2" action="/photos/store" method="POST"  enctype="multipart/form-data">
                    <?= flash(); ?>                 
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Название</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Краткое описание</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="font-weight-bold">Выберите категорию</label>
                            <select class="form-control" id="category_id" name="category_id">                            
                                <? foreach ($categories as $category): ?>
                                <option value="<?=$category['id']?>"><?=$category['title']?></option>                                
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="files" class="font-weight-bold">Выберите картинку</label>
                            <input type="file" class="form-control-file" id="files" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Загрузить</button>
                    </form>

                </div>

            </main>


