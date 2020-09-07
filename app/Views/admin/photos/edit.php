<?php $this->layout('admin/layout') ?>
<div class="h-100 min-we p-0 d-flex flex-column">
  <main class="flex-grow-1 flex-shrink-0 bg-gr">
    <!-- Content -->
    <div class="content m-3 w-90 bg-white pos-rel pb-2">
      <div class="p-3">
        <div>
          <h4>Изменить изображение. ID: <?=$image['id']; ?></h4>
        </div>

        <div>
        <?= flash(); ?>
          <form action="/admin/photos/<?=$image['id']?>/update" method="POST" enctype="multipart/form-data" class="w-25 ml-4 mt-4 mb-4">
            <div class="form-group">
              <label for="exampleInputName" class="font-weight-bold">Название</label>
              <input value="<?=$image['title']; ?>" name="title" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1" class="font-weight-bold">Краткое описание</label>
              <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?=$image['description']?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1" class="font-weight-bold">Категория</label>
              <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                <? foreach($categories as $category): ?>
                <option  <?if($category['id'] == $image['category_id']):?>selected<?endif;?> value="<?=$category['id']?>"><?=$category['title']?></option>
                <? endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1" class="font-weight-bold">Изображение</label>
              <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
              <img src="<?=getImg($image['image'])?>" class="mt-3" alt="" width="400">
            </div>
            <div class="form-group mt-1 pb-3">
            <button type="submit" class="btn btn-warning mr-5">Изменить</button>
            <a href="/admin/photos/<?=$image['id']?>" class="btn btn-info"><img class="icon-show" src="/images/show_icon.png" alt="show_icon"></a>
            <a href="/admin/photos/<?=$image['id']?>/delete" onclick="return confirm('Вы уверены?');" class="btn btn-danger"><img class="icon-show" src="/images/delete_icon.png" alt="delete_icon"></a>                                    
            </div>
          </form>
        </div>
        <div class="box-footer">
          <p class="fs-14">По вопросам к главному администратору</p>
        </div>
      </div>
    </div>
  </main>