<nav aria-label="..." class="d-flex justify-content-center mt-5">
  <ul class="pagination">

    <li class="page-item <?php if(!$paginator->getPrevUrl()):?> disabled <?php endif;?>">
      <a class="page-link" href="<?=$paginator->getPrevUrl()?>" tabindex="-1" aria-disabled="true">Предыдущая</a>
    </li>


    <?php foreach ($paginator->getPages() as $page): ?>
        <?php if ($page['url']): ?>
            <li class="page-item <?php echo $page['isCurrent'] ? 'active' : ''; ?>" aria-current="page">
            <a class="page-link" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?><span class="sr-only">(current)</span></a>
            </li>
            <?php endif; ?>
    <?php endforeach; ?>


    <li class="page-item <?php if(!$paginator->getNextUrl()):?> disabled <?php endif;?>">
      <a class="page-link" href="<?=$paginator->getNextUrl()?>">Следующая</a>
    </li>
  </ul>
</nav>