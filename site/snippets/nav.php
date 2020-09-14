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
      <?php if ($page->hide_home_nav() && !$page->hide_home_nav()->toBool()): ?>
        <li class="navigation__item highlight"><a href="<?= $site->url(); ?>"><?= $site->title(); ?></a></li>
      <?php endif; ?>
      <?php foreach($items as $item): ?>
      <li class="navigation__item <?php e($item->isOpen() && !isset($override), 'highlight') ?>"><a href="<?= $item->url() ?>"><?= $item->title()->html() ?></a></li>
      <?php endforeach ?>
    </ul>
  </nav>
</div>
