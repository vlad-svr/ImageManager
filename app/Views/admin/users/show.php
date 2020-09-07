<?php $this->layout('admin/layout') ?>
        <div class="h-100 min-we p-0 d-flex flex-column">
          <main class="flex-grow-1 flex-shrink-0 bg-gr">
            <!-- Content -->
            <div class="content m-3 bg-white pos-rel pb-4">
              <div class="p-3">
                <div>
                  <h4>Сведение о пользователе: <?= isset($user['username']) ? $user['username'] : 'ID: '.$user['id']; ?></h4>
                </div>
                <hr>
                <div class>
                  
                    <div class="form-group">
                     <p class="h6">Имя:</p>
                     <span><?= isset($user['username']) ? $user['username'] : 'ID: '.$user['id']; ?></span>
                    </div>
                    <div class="form-group">
                      <p class="h6">Email:</p>
                     <span><?=$user['email']?></span>
                    </div>
                    <div class="form-group">
                      <p class="h6">ID:</p>
                     <span><?=$user['id']?></span>
                    </div>
                    
                    
                   
                    <div class="form-group">
                      <p class="h6">Аватар:</p>               
                      <img src="<?=getImg($user['avatar'])?>" class="mt-3" alt="avatar" width="200">
                    </div>

                    <div class="form-group">
                      <span class="h6">Статус:</span>
                      <span><?=getStatus($user['status'])?></span>
                    </div>

                    <div class="form-group">
                      <span class="h6">Роль:</span>
                     <?=getRole($user['roles_mask'])?>
                    </div>
                    <div class="form-group">
                      <span class="h6">Статус email:</span>
                     <?=getVerifyEmail($user['verified'])?>
                    </div>
                    <div class="form-group">
                      <span class="h6">Зарегистрирован:</span>
                      <?=uploadDate($user['registered'])?>
                    </div>
                    <?if(isset($user['last_login'])):?>
                    <div class="form-group">
                      <span class="h6">Последний сеанс:</span>
                      <?=uploadDate($user['last_login'])?>
                    </div>
                    <? endif; ?>
                    <div class="form-group">
                        <a href="/admin/users/<?=$user['id']?>/edit" class="btn btn-warning"><img class="icon-show" src="/images/edit_icon.png" alt="edit_icon"></a>
                        <a href="/admin/users/<?=$user['id']?>/delete" onclick="return confirm('Вы уверены?');" class="btn btn-danger"><img class="icon-show" src="/images/delete_icon.png" alt="delete_icon"></a>     
                    </div>
                    <hr>
                   
                    
                
                </div>
                <div class="box-footer">
                  <p class="fs-14">По вопросам к главному администратору</p>
                </div>
              </div>
            </div>
          </main>
        