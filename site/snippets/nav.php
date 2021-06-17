<?php

// main menu items
$items = $pages->listed()->notTemplate('season');
if (isset($override)) {
  $items = $override;
}

?>
<div class="navigation__container">
  <?php if (isset($showMarquee) && $showMarquee): ?>
    <?php snippet('marquee'); ?>
  <?php endif; ?>
  <nav>
    <ul class="navigation">
        <li class="navigation__item home"><a href="<?= $site->url(); ?>"><?= $site->title(); ?></a></li>
      <?php foreach($items as $item): ?>
      <li id="nav-<?= $item->title()->slug(); ?>" class="navigation__item <?php e($item->isOpen() && !isset($override), 'highlight') ?>"><a href="<?= $item->url() ?>"><?= $item->title(); ?></a></li>
      <?php endforeach ?>
    </ul>
  </nav>
</div>
