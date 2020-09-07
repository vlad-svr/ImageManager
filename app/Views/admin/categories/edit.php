<?php $this->layout('admin/layout') ?>
<div class="h-100 min-we p-0 d-flex flex-column">
  <main class="flex-grow-1 flex-shrink-0 bg-gr">
    <!-- Content -->
    <div class="content m-3 bg-white pos-rel pb-2">
      <div class="p-3">
        <div>
          <h4>Изменить категорию. ID: <?=$category['id']?></h4>
        </div>
        <div>
          <?= flash(); ?>
          <form action="/admin/categories/<?=$category['id']?>/update" method="POST" class="w-25 ml-4 mt-4 mb-4">
            <div class="form-group">
              <label for="categoriesTitle" class="font-weight-bold">Название</label>
              <input name="title" value="<?=$category['title']?>" type="text" class="form-control" id="categoriesTitle" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-warning mt-1 mb-3">Изменить</button>
            <a href="/admin/categories/<?=$category['id']?>/delete" onclick="return confirm('Вы уверены?');" class="btn btn-danger mb-3 mt-1"><img class="icon-show" src="/images/delete_icon.png" alt="delete_icon"></a>
          </form>
        </div>
        <div class="box-footer">
          <p class="fs-14">По вопросам к главному администратору</p>
        </div>
      </div>
    </div>
  </main>
  