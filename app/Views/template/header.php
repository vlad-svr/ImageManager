
        <!-- Modal Sign In-->
        <div class="modal fade" id="exampleModalSignIn" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Вход в систему</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="outAlertSignIn">
                                       
                    </div>
                    <form id="formSignIn" action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmailSignIn">Email</label>
                                <input required name="email" type="email" class="form-control" id="exampleInputEmailSignIn"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPasswordSignIn">Пароль</label>
                                <input required name="password" type="password" class="form-control" id="exampleInputPasswordSignIn">
                            </div>
                            <div class="form-group form-check">
                                <input name="remember" type="checkbox" class="form-check-input" id="exampleCheckSignIn">
                                <label class="form-check-label" for="exampleCheckSignIn">Запомнить меня</label>
                            </div>
                            <div>
                                <p class="m-0 fs14">Забыли пароль?&nbsp<a class="font-weight-bold"
                                       href="/password-recovery">Восстановление пароля</a>
                                </p>                                

                                <p class="m-0 fs14">Не пришло письмо подтверждения?&nbsp<a class="font-weight-bold"
                                        href="/email-verification">Переотправить</a>
                                </p>                               
                                <p class="m-0 fs14">Нет аккаунта?&nbsp<a href="" class="font-weight-bold"
                                        data-dismiss="modal" data-toggle="modal"
                                        data-target="#exampleModalRegister">Регистрация</a>
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button type="submit" id="btnSignIn" class="btn btn-primary">Войти</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>


        <!-- Modal Register-->
        <div class="modal fade" id="exampleModalRegister" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Регистрация нового
                            пользователя</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="outAlert">
                                       
                    </div>
                    <form action="/register" method="POST" id="formElem">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputName">Имя</label>
                                <input required type="text" class="form-control reset" id="exampleInputName" name="username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmailRegister">Email</label>
                                <input required type="email" class="form-control reset" id="exampleInputEmailRegister"
                                    aria-describedby="emailHelp" name="email">
                                <small id="emailHelp" class="form-text text-muted">Мы никогда не передадим вашу
                                    электронную почту кому-либо.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword">Пароль</label>
                                <input required type="password" class="form-control reset" id="exampleInputPassword" name="password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPasswordReplay">Подтвердите пароль</label>
                                <input required type="password" class="form-control reset" id="exampleInputPasswordReplay" name="password_confirmation">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheckRegister" name="terms">
                                <label class="form-check-label" for="exampleCheckRegister">Я согласен с&nbsp<a href="#"
                                        class="font-weight-bold" data-toggle="modal"
                                        data-target="#exampleModalScrollable">правилами
                                        сайта</a></label>
                            </div>
                            <div>
                                <p class="fs14">Уже зарегистрированы?&nbsp<a href="" class="font-weight-bold"
                                        data-dismiss="modal" data-toggle="modal"
                                        data-target="#exampleModalSignIn">Войти</a></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button type="submit" id="btn-server-async" class="btn btn-primary">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal RegulationsSite-->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Правила сайта</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam corrupti adipisci iure neque
                        vitae. Temporibus rem dolor placeat necessitatibus tempora culpa, porro laboriosam autem at
                        expedita enim reprehenderit quia veniam.Totam corrupti adipisci iure neque vitae. Temporibus rem
                        dolor placeat necessitatibus tempora culpa, porro laboriosam autem at expedita enim
                        reprehenderit quia veniam. Totam corrupti adipisci iure neque vitae. Temporibus rem dolor
                        placeat necessitatibus tempora culpa, porro laboriosam autem at expedita enim reprehenderit quia
                        veniam. Totam corrupti adipisci iure neque vitae. Temporibus rem dolor placeat necessitatibus
                        tempora culpa, porro laboriosam autem at expedita enim reprehenderit quia veniam. Totam corrupti
                        adipisci iure neque vitae. Temporibus rem dolor placeat necessitatibus tempora culpa, porro
                        laboriosam autem at expedita enim reprehenderit quia veniam. Totam corrupti adipisci iure neque
                        vitae. Temporibus rem dolor placeat necessitatibus tempora culpa, porro laboriosam autem at
                        expedita enim reprehenderit quia veniam. Totam corrupti adipisci iure neque vitae. Temporibus
                        rem dolor placeat necessitatibus tempora culpa, porro laboriosam autem at expedita enim
                        reprehenderit quia veniam. Totam corrupti adipisci iure neque vitae. Temporibus rem dolor
                        placeat necessitatibus tempora culpa, porro laboriosam autem at expedita enim reprehenderit quia
                        veniam. Totam corrupti adipisci iure neque vitae. Temporibus rem dolor placeat necessitatibus
                        tempora culpa, porro laboriosam autem at expedita enim reprehenderit quia veniam.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ознакомлен</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid h-100 p-0 d-flex flex-column">
            <header class="fixed-top">

                <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark pr-5 pl-5 ">
                    <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="ic" width="30"
                            height="30" class="d-inline-block align-top">
                        ImageResource
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Главная<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Категории
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <? foreach(getAllCategories() as $category): ?>                                  
                                    <a class="dropdown-item" href="/category/<?=$category['id']?>"><?=$category['title']?></a>                                 
                                    <? endforeach; ?>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0 mr-5" action="/search" method="get">
                            <input class="form-control mr-sm-2" type="search" name="q" placeholder="Поиск" aria-label="Search">
                            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Найти</button>
                        </form>
                        <? if (auth()->isLoggedIn()): ?>  
                            <div class="auth-button ml-5 d-flex">
                            <div class="btn-group mr-4">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Управление
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/photos/create">Загрузить картинку</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/photos">Моя галерея</a>
                                    <? if(getUser(auth()->getUserId())['roles_mask'] == 1): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/admin">Админ-панель</a>
                                    <? endif; ?>
                                </div>
                            </div>
                            <div class="mr-3">
                                <a href="/profile">
                                <img src="<?=getImg(getAvatarUser(auth()->getUserId())['avatar'])?>" width="39" height="39" alt="">
                                </a>
                            </div>
                            <div class="text-white mr-4 d-flex align-items-center">
                                <p class="mb-0">Здравствуйте,&nbsp<span class="font-weight-bold"><?=auth()->getUsername()?></span>
                                </p>
                            </div>
                            <div>
                                <a href="/profile" class="btn btn-primary">Профиль</a>                              
                                <a href="/logout" class="btn btn-secondary ml-2">Выйти</a>
                            </div>
                        </div>                        
                        <? else: ?>                         
                            <div class="auth-button ml-5">
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                data-target="#exampleModalSignIn">
                                Войти</button>
                            <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                                data-target="#exampleModalRegister">Зарегистрироваться</button>
                        </div>
                        <? endif; ?>                        
                    </div>

                </nav>

            </header>
