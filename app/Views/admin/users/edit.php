<?php $this->layout('admin/layout') ?>
        <div class="h-100 min-we p-0 d-flex flex-column">
          <main class="flex-grow-1 flex-shrink-0 bg-gr">
            <!-- Content -->
            <div class="content m-3 bg-white pos-rel pb-2">
              <div class="p-3">
                <div>
                  <h4>Изменить пользователя</h4>
                </div>
                <div>
                <?= flash(); ?>
                  <form action="/admin/users/<?=$user['id']?>/update" method="POST" enctype="multipart/form-data" class="w-25 ml-4 mt-4 mb-4">
                    <div class="form-group">
                      <label for="userName" class="font-weight-bold">Имя</label>
                      <input name="username" value="<?=$user['username']?>" type="text" class="form-control" id="userName" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="userEmail" class="font-weight-bold">Email</label>
                      <input name="email" value="<?=$user['email']?>" type="email" class="form-control" id="userEmail" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="passInp" class="font-weight-bold">Пароль</label>
                      <input type="password" name="password" class="form-control" id="passInp" >
                    </div>
                    <div class="form-group">
                      <label for="userSelect" class="font-weight-bold">Роль</label>
                      <select name="roles_mask" class="form-control" id="userSelect">
                      <? foreach($roles as $role): ?>
                      <option <?if($role['id'] == $user['roles_mask']):?>selected<?endif;?> value="<?=$role['id']?>"><?=$role['title']?></option>                        
                      <? endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="userFile" class="font-weight-bold">Аватар</label>
                      <input name="image" type="file" class="form-control-file" id="userFile">
                      <img src="<?=getImg($user['avatar'])?>" class="mt-3" alt="avatar" width="300">
                    </div>

                    <div class="form-group form-check">
                      <input name="status" <?if($bannedStatus == $user['status']):?>checked<?endif;?> type="checkbox" class="form-check-input" id="userCheck">
                      <label class="form-check-label" for="userCheck">Бан</label>
                    </div>
                    <div class="form-group form-check">
                      <input name="verified" <?if($user['verified']):?>checked<?endif;?> type="checkbox" class="form-check-input" id="userCheckMail">
                      <label class="form-check-label" for="userCheckMail">Подтверждение почты</label>
                    </div>
                    <button type="submit" class="btn btn-warning mt-1 mb-3 mr-5">Изменить</button>
                    <a href="/admin/users/<?=$user['id']?>" class="btn btn-info mt-1 mb-3"><img class="icon-show" src="/images/show_icon.png" alt="show_icon"></a>
                    <a href="/admin/users/<?=$user['id']?>/delete" onclick="return confirm('Вы уверены?');" class="btn btn-danger mt-1 mb-3"><img class="icon-show" src="/images/delete_icon.png" alt="delete_icon"></a> 
                  </form>
                </div>
                <div class="box-footer">
                  <p class="fs-14">По вопросам к главному администратору</p>
                </div>
              </div>
            </div>
          </main>