<footer class="flex-grow-0 flex-shrink-0">

                <div class="container-fluid foot">
                    <div class="nav-footer mt-4 mb-4 pt-5">
                        <div class="container">
                            <ul class="nav justify-content-center ul-my">                                
                                <li class="nav-item">
                                    <a class="nav-link a-style" href="#">Главная</a>
                                </li>
                            
                                <? foreach(getAllCategories() as $category): ?>
                                <li class="nav-item">
                                    <a class="nav-link a-style" href="/category/<?=$category['id']?>"><?=$category['title']?></a>
                                </li>                           
                                <? endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="div-prod text-center">
                        <p>
                            <strong>ImageResource</strong> - место, где вы можете найти и скачать красивые обои на
                            рабочий стол, также вы можете загрузить чтобы поделиться ими со всеми.
                        </p>
                    </div>
                    <div class="footer-copyright text-center pt-2 pb-4">
                        <p class="fs">
                            All rights reserved. 2020
                        </p>
                    </div>
                </div>


            </footer>
        </div>