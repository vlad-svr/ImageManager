<?php $this->layout('admin/layout') ?>
        <div class="h-100 min-we p-0 d-flex flex-column">
          <main class="flex-grow-1 flex-shrink-0 bg-gr">
            <!-- Content -->
            <div class="content m-3 w-90 bg-white pos-rel pb-2">
              <div class="p-3">
                <div>
                  <h4>Все изображения</h4>
                </div>
                <div>
                  <a href="/admin/photos/create" class="btn btn-success mt-3 mb-3">Добавить</a>
                </div>
                <div>
                  <table class="table table-striped">
                    <thead>
                      
                        <th scope="col">#ID</th>
                        <th scope="col">Название</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Изображение</th>    
                        <th scope="col">Автор</th>                   
                        <th scope="col">Действия</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? foreach($images as $image): ?>
                      <tr>
                        <th scope="row"><?=$image['id']?></th>
                        <td><?=$image['title']?></td>
                        <td><?=getCategoryId($image['category_id'])['title']?></td>
                        <td><img src="<?=getImg($image['image'])?>" width="300" alt="<?=$image['image']?>"></td>
                        <td><a href="/admin/users/<?=$image['user_id']?>"><?= isset(getUser($image['user_id'])['username']) ? getUser($image['user_id'])['username'] : 'ID: '.$image['user_id']; ?></a></td>
                        <td>
                        <a href="/admin/photos/<?=$image['id']?>" class="btn btn-info"><img class="icon-show" src="/images/show_icon.png" alt="show_icon"></a>
                        <a href="/admin/photos/<?=$image['id']?>/edit" class="btn btn-warning"><img class="icon-show" src="/images/edit_icon.png" alt="edit_icon"></a>
                        <a href="/admin/photos/<?=$image['id']?>/delete" onclick="return confirm('Вы уверены?');" class="btn btn-danger"><img class="icon-show" src="/images/delete_icon.png" alt="delete_icon"></a>                        
                        </td>
                      </tr>
                <? endforeach; ?>
                    </tbody>
                  </table>
                </div>                
                <div class="box-footer">
                  <p class="fs-14">По вопросам к главному администратору</p>
                </div>
                <div>
                <? if($count > $perPage): ?>
                <?php echo paginator($paginator); ?>  
                <? endif; ?> 
                </div>
              </div>
            </div>
          </main>
 