<?php $this->layout('admin/layout') ?>
<div class="h-100 min-we p-0 d-flex flex-column">
  <main class="flex-grow-1 flex-shrink-0 bg-gr">
    <!-- Content -->
    <div class="content m-3 bg-white pos-rel pb-2">
      <div class="p-3">
        <div>
          <h4>Добавить нового пользователя</h4>
        </div>
        <div>
        <?= flash(); ?>
          <form action="/admin/users/store" method="POST" enctype="multipart/form-data" class="w-25 ml-4 mt-4 mb-4">
            <div class="form-group">
              <label for="regName" class="font-weight-bold">Имя</label>
              <input name="username" type="text" class="form-control" id="regName" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="regEmail" class="font-weight-bold">Email</label>
              <input name="email" type="email" class="form-control" id="regEmail" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="regPass" class="font-weight-bold">Пароль</label>
              <input name="password" type="password" class="form-control" id="regPass">
            </div>
            <div class="form-group">
              <label for="regRole" class="font-weight-bold">Роль</label>
              <select name="roles_mask" class="form-control" id="userSelect">
                <? foreach($roles as $role): ?>
                <option value="<?=$role['id']?>"><?=$role['title']?></option>                        
                <? endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="regAvat" class="font-weight-bold">Аватар</label>
              <input name="image" type="file" class="form-control-file" id="regAvat">
            </div>
            <div class="form-group form-check">
              <input name="status" type="checkbox" class="form-check-input" id="regBanned">
              <label class="form-check-label" for="regBanned">Бан</label>
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