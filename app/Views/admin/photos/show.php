<?php $this->layout('admin/layout') ?>
<div class="h-100 min-we p-0 d-flex flex-column">
  <main class="flex-grow-1 flex-shrink-0 bg-gr">
    <!-- Content -->
    <div class="content m-3 w-90 bg-white pos-rel pb-2">
      <div class="p-3">
        <div>
          <h4>Сведение о изображении ID: <?=$image['id']; ?></h4>
        </div>
        <hr>
        <div>
        <div class="photo-full d-flex justify-content-center mb-5 mt-3">
            <div class="card" style="width: 45rem;">
                <img src="<?=getImg($image['image'])?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="add-profile">
                        <h5 class="card-title"><a href="/admin/users/<?=$image['user_id']?>"><img src="<?=getImg(getUser($image['user_id'])['avatar'])?>" alt="avatar" width="48" height="48" class="mr-3"></a>
                            Автор:&nbsp<a href="/admin/users/<?=$image['user_id']?>"><?= isset(getUser($image['user_id'])['username']) ? getUser($image['user_id'])['username'] : 'ID: '.$image['user_id']; ?></a></h5>
                    </div>
                    <div class="description-full-photo">                       
                        <p class="card-text mb-4"><?=$image['description']?></p>
                        <p class="card-text font-weight-light">Категория:&nbsp<span class="font-weight-normal"><a href="/admin/category/<?=$image['category_id']?>"><?=getCategoryId($image['category_id'])['title']?></a></span></p>
                        <p class="card-text font-weight-light mb-0">Добавлено:&nbsp<span><?=uploadDate($image['date'])?></span></p>
                        <? if(isset($image['date_edit'])): ?>
                        <p class="card-text font-weight-light">Изменено:&nbsp<span><?=uploadDate($image['date_edit'])?></span></p>
                        <? endif; ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="card-text font-weight-light">Размер:&nbsp<span><?=$image['dimensions']?></span></p>                                                
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <a href="/admin/photos/<?=$image['id']?>/edit" class="btn btn-warning mr-1"><img class="icon-show" src="/images/edit_icon.png" alt="edit_icon"></a>
                        <a href="/admin/photos/<?=$image['id']?>/delete" onclick="return confirm('Вы уверены?');" class="btn btn-danger"><img class="icon-show" src="/images/delete_icon.png" alt="delete_icon"></a>                                                 
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="box-footer">
          <p class="fs-14">По вопросам к главному администратору</p>
        </div>
      </div>
    </div>
  </main>