<?php $this->layout('layout') ?>

<main class="my-mt flex-grow-1 flex-shrink-0">
                <div class="image-header сontainer-fluid">
                    <div class="jumbotron jumbotron-fluid bg-image-header-reset-pass">
                        <div class="container">
                            <h1 class="display-4 text-white">Войдите в систему.</h1>
                            <p class="lead text-white">Нет доступа.</p>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center">
                    <div class="mt-3">                    
                        <form id="formSignInFull" action="/login" method="POST">
                        <?= flash(); ?>
                        <div id="outAlertFull"></div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="EmailSignIn">Email</label>
                                    <input required name="email" type="email" class="form-control"
                                        id="EmailSignIn" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="PasswordSignIn">Пароль</label>
                                    <input required name="password" type="password" class="form-control"
                                        id="PasswordSignIn">
                                </div>
                                <div class="form-group form-check">
                                    <input name="remember" type="checkbox" class="form-check-input"
                                        id="CheckSignIn">
                                    <label class="form-check-label" for="CheckSignIn">Запомнить меня</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Войти</button>
                                <div class="mt-3 mb-4">
                                    <p class="m-0">Забыли пароль?&nbsp<a class="font-weight-bold"
                                            href="/password-recovery">Восстановление пароля</a>
                                    </p>

                                    <p class="m-0">Не пришло письмо подтверждения?&nbsp<a class="font-weight-bold"
                                            href="/email-verification">Переотправить</a>
                                    </p>
                                    <p class="m-0">Нет аккаунта?&nbsp<a href="" class="font-weight-bold"
                                            data-dismiss="modal" data-toggle="modal"
                                            data-target="#exampleModalRegister">Регистрация</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </main>
