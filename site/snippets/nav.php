<?php

// main menu items
$items = $pages->listed();
?>
<div class="navigation__container">
  <nav>
    <ul class="navigation">
      <li class="navigation__item highlight"><a href="<?= $site->url() ?>"><?= $site->title(); ?></a></li>
      <?php foreach($items as $item): ?>
      <li class="navigation__item"><a<?php e($item->isOpen(), ' class="active"') ?> href="<?= $item->url() ?>"><?= $item->title()->html() ?></a></li>
      <?php endforeach ?>
    </ul>
  </nav>
</div>
