<?php $this->layout('admin/layout') ?>
<div class="h-100 min-we p-0 d-flex flex-column">
  <main class="flex-grow-1 flex-shrink-0 bg-gr">
    <!-- Content -->
    <div class="content m-3 bg-white pos-rel pb-2">
      <div class="p-3">
        <div>
          <h4>Все категории</h4>
        </div>
        <div>
          <a href="/admin/categories/create" class="btn btn-success mt-3 mb-3">Добавить</a>
        </div>
        <div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Название</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody>
            <? foreach($categories as $category): ?>
              <tr>
                <th scope="row"><?=$category['id']?></th>
                <td><?=$category['title']?></td>
                <td>          
                  <a href="/admin/categories/<?=$category['id']?>/edit" class="btn btn-warning"><img class="icon-show" src="/images/edit_icon.png" alt="edit_icon"></a>
                  <a href="/admin/categories/<?=$category['id']?>/delete" onclick="return confirm('Вы уверены?');" class="btn btn-danger"><img class="icon-show" src="/images/delete_icon.png" alt="delete_icon"></a>
                </td>
              </tr>
              <? endforeach; ?> 
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <p class="fs-14">По вопросам к главному администратору</p>
        </div>
      </div>
    </div>
  </main>