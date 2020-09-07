<?php $this->layout('admin/layout') ?>
    <div class="h-100 min-we p-0 d-flex flex-column">
      <main class="flex-grow-1 flex-shrink-0 bg-gr">
        <!-- Content -->
        <div class="content m-3 bg-white pos-rel pb-2">
          <div class="p-3">
            <div>
              <h4>Все пользователи</h4>
            </div>
            <div>
              <a href="/admin/users/create" class="btn btn-success mt-3 mb-3">Добавить</a>
            </div>
            <div>
            <?= flash(); ?>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Email</th>
                    <th scope="col">Роль</th>
                    <th scope="col">Аватар</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Действия</th>
                  </tr>
                </thead>
                <tbody>
                  <? foreach($users as $user): ?>
                  <tr>
                    <th scope="row"><?=$user['id']?></th>
                    <td><?=$user['username']?></td>
                    <td><?=$user['email']?></td>
                    <td><?=getRole($user['roles_mask'])?></td>
                    <td><img src="<?=getImg($user['avatar'])?>" width="100" alt="avatar"></td>
                    <td><?=getStatus($user['status'])?></td>
                    <td>
                        <a href="/admin/users/<?=$user['id']?>" class="btn btn-info"><img class="icon-show" src="/images/show_icon.png" alt="show_icon"></a>
                        <a href="/admin/users/<?=$user['id']?>/edit" class="btn btn-warning"><img class="icon-show" src="/images/edit_icon.png" alt="edit_icon"></a>
                        <a href="/admin/users/<?=$user['id']?>/delete" onclick="return confirm('Вы уверены?');" class="btn btn-danger"><img class="icon-show" src="/images/delete_icon.png" alt="delete_icon"></a> 
                    </td>
                  </tr>
                 <? endforeach ?>
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
