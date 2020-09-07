<?php $this->layout('layout') ?>
<main class="my-mt flex-grow-1 flex-shrink-0">
    <div class="image-header сontainer-fluid">
        <div class="jumbotron jumbotron-fluid bg-image-header-reset-pass">
            <div class="container">
                <h1 class="display-4 text-white">Восстановление пароля.</h1>
                <p class="lead text-white">Введите новый пароль.</p>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="mt-4 w-25">
            <form action="/password-recovery/change" method="POST">
                                  
                    <input name="selector" type="hidden" value="<?=$_GET['selector']?>">
                    <input name="token" type="hidden" value="<?=$_GET['token']?>">
                
                <div class="form-group">
                    <label class="font-weight-bold" for="newPass">Новый пароль</label>
                    <input name="newPassword" type="password" class="form-control" id="newPass">
                </div>


                <button type="submit" class="btn btn-primary">Отправить</button>

            </form>
        </div>

    </div>

</main>