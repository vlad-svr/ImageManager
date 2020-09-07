
<aside class="w-65 bg-dark h-100">
    <div class="ml-3 mt-2 border-icon-admin d-flex">
        <div>
            <img src="<?= getImg(getAvatarUser(auth()->getUserId())['avatar']) ?>" class="border-icon-admin" width="45px" height="45px" alt="">
        </div>
        <div class="ml-3 mr-2 d-flex flex-column">
            <span class="text-white fs-14">Alexander Pierche</span>
            <span class="text-white fs-14">Online</span>
        </div>
    </div>
    <div class="">
        <hr class="p-0 m-2">
            <span class="pl-3 text-success">Навигация</span>
        <hr class="p-0 m-2">
    </div>
    <div class="btn-group-vertical w-100 d-flex flex-column justify-content-start">
        <a href="/admin" class="btn btn-dark text-left pl-3">Главная</a>
        <a href="/admin/photos" class="btn btn-dark text-left pl-3">Все картинки</a>
        <a href="/admin/categories" class="btn btn-dark text-left pl-3">Категории</a>
        <a href="/admin/users" class="btn btn-dark text-left pl-3">Пользователи</a>
        <a href="/" class="btn btn-dark text-left pl-3 mt-2">Сайт</a>
    </div>
</aside>