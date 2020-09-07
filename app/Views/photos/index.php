<?php $this->layout('layout') ?>
            <main class="my-mt flex-grow-1 flex-shrink-0">
                <div class="image-header сontainer-fluid">
                    <div class="jumbotron jumbotron-fluid bg-image-header-photos">
                        <div class="container">
                            <h1 class="display-4 text-white">Моя галерея</h1>
                            <p class="lead text-white">Загруженные вами картинки</p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-4">
                        <? foreach($photos as $photo): ?>
                        <div class="col mb-4">
                            <div class="card">
                                <a href="photos/<?= $photo['id']; ?>">
                                <img src="<?= getImg($photo['image']); ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body d-flex p-3 flex-column">
                                    <a href="/photos/<?= $photo['id']; ?>/edit" class="btn btn-warning mb-3">Редактировать</a>
                                    <button data-btn="delete" data-href="/photos/<?= $photo['id']; ?>/delete" class="btn btn-danger">Удалить</button>
                                    <!-- <button class="btn btn-danger" data-delete="photos//delete">Удалить</button> -->
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
            