<?= $this->layout('layout'); ?>
<main class="my-mt flex-grow-1 flex-shrink-0">
    <div class="image-header сontainer-fluid">
        <div class="jumbotron jumbotron-fluid bg-image-header-user">
            <div class="container d-flex justify-content-center">                
                <div class="mr-5">
                    <img src="<?= getImg($user['avatar']); ?>" class="card-img-top avatar-jumbotron" alt="...">
                </div>
                <div>
                    <h1 class="display-4 text-white"><?= isset($user['username']) ? $user['username'] : 'ID: '.$user['id']; ?></h1>
                    <p class="lead text-white">Картинки пользователя</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            <? foreach($images as $image): ?>
                <div class="col mb-4">
                            <div class="card">
                            <a href="/photos/<?= $image['id']; ?>">
                                <img src="<?= getImg($image['image']); ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body d-flex p-3 flex-wrap justify-content-between">
                                    <div class="d-flex mr-2">
                                        <a href="/category/<?= $image['category_id']; ?>">
                                            <span class="h5"><?= getCategoryId($image['category_id'])['title']; ?></span>
                                        </a>
                                    </div>
                                    <div class="">
                                        <span class="fs">Размер: <?= $image['dimensions']; ?></span>
                                        <span class="fs">Добавлено: <?= uploadDate($image['date']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
            <? endforeach; ?>
        </div>
    </div>
    <? if($count > $perPage): ?>
    <?php echo paginator($paginator); ?>  
    <? endif; ?>   
</main>
