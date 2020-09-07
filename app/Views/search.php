<?php $this->layout('layout') ?>

            <main class="my-mt flex-grow-1 flex-shrink-0">
                <div class="image-header сontainer-fluid">
                    <div class="jumbotron jumbotron-fluid bg-image-header-index">                 
  
                        <div class="container">
                            <h1 class="display-4 text-white">Поиск по запросу "<span><?= strlen($searchValue) > 15 ? strTrimLength($searchValue, 15).'...' : $searchValue?></span>"</h1>
                            <p class="lead text-white">Результатов поиска: <?= $count; ?></p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row row-cols-1">
                    <? if($count != 0): ?>
                    <? foreach ($images as $image): ?>
                        <div class="card mb-3 text-center">                            
                            <div class="card-header">
                            <h5 class="card-title m-0"><?=$image['title'] ?></h5>
                            </div>               
                            <a class="card-a" href="/photos/<?=$image['id'];?>">             
                            <div class="card-body d-flex hover-card">
                                <div>
                                    
                                    <img width="500" src="<?= getImg($image['image']) ?>" alt="image">
                                    
                                </div>
                                <div class="ml-5 text-left d-flex flex-column align-content-between w-100 flex-wrap">   
                                    <div class="pt-2 pb-2 border-bottom w-100">                                                              
                                        <span class="fs-20">Описание:</span>
                                        <p class="card-text"><?                                                                          
                                        $a = mb_stripos($image['description'], $_GET['q']);
                                        $b = mb_strlen(trim($_GET['q']));
                                        $c = mb_substr($image['description'], $a, $b);
                                        echo str_ireplace($c, "<strong>{$c}</strong>", $image['description']);                                         
                                        ?></p>
                                    </div>   
                                    <div class="pt-2 pb-2 w-100">
                                    <p class="card-text border-bottom pb-2">Категория:&nbsp<span><a href="/category/<?=$image['category_id']?>"><?=getCategoryId($image['category_id'])['title']?></a></span></p>
                                        <p class="card-text mb-0">Добавлено:&nbsp<span><?=uploadDate($image['date'])?></span></p>
                                        <? if(isset($image['date_edit'])): ?>
                                        <p class="card-text mb-0">Изменено:&nbsp<span><?=uploadDate($image['date_edit'])?></span></p>
                                        <? endif; ?>
                                        <p class="card-text">Размер:&nbsp<span><?=$image['dimensions']?></span></p>
                                    </div>
                                </div>
                            </div>
                            </a>
                           
                        </div>
                        <? endforeach; ?> 
                    <? else: ?> 
                    <h5 class="d-flex justify-content-center mt-5">По вашему запросу ничего не найдено. Попробуйте еще раз.</h5> 
                    <? endif; ?>                   
                    </div>
                </div>
                <? if($count > $perPage): ?>
                <?php echo paginator($paginator); ?>  
                <? endif; ?>     
            </main>

            