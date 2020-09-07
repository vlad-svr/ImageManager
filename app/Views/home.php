<?php $this->layout('layout') ?>

            <main class="my-mt flex-grow-1 flex-shrink-0">
                <div class="image-header сontainer-fluid">
                    <div class="jumbotron jumbotron-fluid bg-image-header-index">                 
  
                        <div class="container">
                            <h1 class="display-4 text-white">Обои для вашего рабочего стола!</h1>
                            <p class="lead text-white">Настроение и вдохновение в одном кадре</p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-4">
                    <? foreach ($photos as $photo): ?>
                        <div class="col mb-4">
                            <div class="card">
                            <a href="/photos/<?= $photo['id']; ?>">
                                <img src="<?= getImg($photo['image']); ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body d-flex p-3 flex-wrap justify-content-between">
                                    <div class="d-flex mr-2">
                                        <a href="/category/<?= $photo['category_id']; ?>">
                                            <span class="h5"><?= getCategoryId($photo['category_id'])['title']; ?></span>
                                        </a>
                                    </div>
                                    <div class="">
                                        <span class="fs">Размер: <?= $photo['dimensions']; ?></span>
                                        <span class="fs">Добавлено: <?= uploadDate($photo['date']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? endforeach; ?>                      
                    </div>
                </div>

            </main>

            