<?php $this->layout('admin/layout') ?>
        <div class="h-100 min-we p-0 d-flex flex-column">
          <main class="flex-grow-1 flex-shrink-0 bg-gr">
            <!-- Content -->
            <div class="content m-3 w-90 bg-white pos-rel pb-2">
              <div class="p-3">
                <div>
                  <h4>Добавить изображение</h4>
                </div>
                <div>
                <?= flash(); ?>
                  <form action="/admin/photos/store" method="POST" enctype="multipart/form-data" class="w-25 ml-4 mt-4 mb-4">
                    <div class="form-group">
                      <label for="exampleInputName" class="font-weight-bold">Название</label>
                      <input name="title" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1" class="font-weight-bold">Краткое описание</label>
                      <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="selectCreateAdmin" class="font-weight-bold">Категория</label>
                      <select name="category_id" class="form-control" id="selectCreateAdmin">
                      <? foreach($categories as $category): ?>
                        <option value="<?=$category['id']?>"><?=$category['title']?></option>
                      <? endforeach; ?> 
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlFile1" class="font-weight-bold">Изображение</label>
                      <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" class="btn btn-success mt-1 mb-3">Добавить</button>
                  </form>
                </div>
                <div class="box-footer">
                  <p class="fs-14">По вопросам к главному администратору</p>
                </div>
              </div>
            </div>
          </main>
