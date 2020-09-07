<?php $this->layout('layout') ?>

            <main class="my-mt flex-grow-1 flex-shrink-0">
                <div class="image-header сontainer-fluid">
                    <div class="jumbotron jumbotron-fluid bg-image-header-profile">
                        <div class="container">
                            <h1 class="display-4 text-white">Профиль</h1>
                            <p class="lead text-white">Основная информация</p>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center">
                
                    <div class="mt-4">                    
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Основная информация</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Безопасность</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">                      
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <?= flash(); ?>
                                <form action="/profile-uploads" enctype="multipart/form-data" method="POST" class="mt-4">
                                    <div class="form-group">
                                        <label for="newUsername">Ваше имя</label>
                                        <input name="username" value="<?=$user['username'];?>" type="text" class="form-control" id="newUsername">
                                    </div>
                                    <div class="form-group">
                                        <label for="newEmail">Email</label>
                                        <input name="email" value="<?=$user['email'];?>" type="email" class="form-control" id="newEmail"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">
                                        <label class="custom-file-label" for="customFile">Аватар</label>                                                                                
                                    </div>
                                    <div class="form-group">
                                        <img src="<?=getImg($user['avatar']);?>" width="100%" alt="">
                                        
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Обновить</button>    
                                        <a href="/delete-avatar" class="btn btn-light">Удалить изображение</a>   
                                                                        
                                    </div>

                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">                                
                                <div id="outAlertUpdatePassword"></div>
                                <form id="formUpdatePass" method="POST" class="mt-4">
                                    <div class="form-group">
                                        <label for="oldPassword">Текущий пароль</label>
                                        <input name="oldPassword" type="password" class="form-control reset" id="oldPassword">
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">Новый пароль</label>
                                        <input name="newPassword" type="password" class="form-control reset" id="newPassword">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Обновить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </main>