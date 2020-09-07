<?= $this->layout('layout'); ?>
<main class="my-mt flex-grow-1 flex-shrink-0">
    <div class="image-header сontainer-fluid">
        <div class="jumbotron jumbotron-fluid bg-image-header-photo">
            <div class="container">
                <h1 class="display-4 text-white"><?= strlen($image['title']) > 25 ? strTrimLength($image['title'], 25).'...' : $image['title'].'.'?>
                </h1>
                <p class="lead text-white"><?= strlen($image['description']) > 100 ? strTrimLength($image['description'], 100).'...' : $image['description']?></p>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="photo-full mb-5 mt-3">
            <div class="card" style="width: 45rem;">
                <img src="<?=getImg($image['image'])?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="add-profile">
                        <h5 class="card-title"><a href="/user/<?=$user['id']?>"><img src="<?=getImg($user['avatar'])?>" alt="" width="48" height="48" class="mr-3"></a>
                            Добавил:&nbsp<a href="/user/<?=$user['id']?>"><?= isset($user['username']) ? $user['username'] : 'ID: '.$user['id']; ?></a></h5>
                    </div>
                    <div class="description-full-photo">                       
                        <p class="card-text mb-4"><?=$image['description']?></p>
                        <p class="card-text font-weight-light">Категория:&nbsp<span class="font-weight-normal"><a href="/category/<?=$image['category_id']?>"><?=getCategoryId($image['category_id'])['title']?></a></span></p>
                        <p class="card-text font-weight-light mb-0">Добавлено:&nbsp<span><?=uploadDate($image['date'])?></span></p>
                        <? if(isset($image['date_edit'])): ?>
                        <p class="card-text font-weight-light">Изменено:&nbsp<span><?=uploadDate($image['date_edit'])?></span></p>
                        <? endif; ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="card-text font-weight-light">Размер:&nbsp<span><?=$image['dimensions']?></span></p>                        
                        <div class="justify-content-end">
                        <? if($checkImageUser): ?>                       
                        <a href="/photos/<?=$image['id']?>/edit" class="btn btn-warning"><img class="icon-show" src="/images/edit_icon.png" alt="edit_icon"></a>
                        <? endif; ?>                        
                        <a href="/photos/<?=$image['id']?>/download" class="btn btn-primary">Скачать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="other-photo-user container mt-4">
        <hr class="">
        <div class="">
            <h3>Другие фотографии от&nbsp<span><a href="/user/<?=$user['id']?>"><?= isset($user['username']) ? $user['username'] : 'ID: '.$user['id']; ?></a></span></h3>
        </div>
        <div class="mt-5">
            <div class="row row-cols-1 row-cols-md-4">
                <? foreach($userImages as $img): ?>
                <div class="col mb-4">
                    <div class="card">
                        <a href="/photos/<?= $img['id']; ?>">
                            <img src="<?=getImg($img['image'])?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body d-flex p-3 flex-wrap justify-content-between">
                            <div class="d-flex mr-2">
                                <a href="/category/<?=$img['category_id']?>">
                                    <span class="h5"><?=getCategoryId($img['category_id'])['title']?></span>
                                </a>
                            </div>
                            <div class="">
                                <span class="fs">Размер:&nbsp<span><?=$img['dimensions']?></span></span>
                                <span class="fs">Добавлено:&nbsp<span><?=uploadDate($img['date'])?></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <? endforeach; ?>
                

            </div>
        </div>
</main>