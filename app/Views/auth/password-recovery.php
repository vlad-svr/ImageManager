<?php $this->layout('layout') ?>
<main class="my-mt flex-grow-1 flex-shrink-0">
    <div class="image-header сontainer-fluid">
        <div class="jumbotron jumbotron-fluid bg-image-header-reset-pass">
            <div class="container">
                <h1 class="display-4 text-white">Восстановление пароля.</h1>
                <p class="lead text-white">Письмо придет вам на почту.</p>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="mt-4">
            <form action="/password-recovery" method="POST">
            <?= flash(); ?>
                <div class="form-group">
                    <label for="resetPass">Email</label>
                    <input name="email" type="email" class="form-control" id="resetPass" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Мы никогда не передадим вашу
                        электронную почту кому-либо.</small>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
                <a href="/" class="btn btn-secondary">Отмена</a>
                <div class="form-group mt-3">
                    <p class="m-0">Нет аккаунта?&nbsp<a href="" class="font-weight-bold" data-dismiss="modal"
                            data-toggle="modal" data-target="#exampleModalRegister">Регистрация</a>
                    </p>
                    <p class="m-0">Не пришло письмо подтверждения?&nbsp<a class="font-weight-bold"
                            href="/email-verification">Переотправить</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</main>