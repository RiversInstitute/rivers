<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<?php if ($page->active_season()->isNotEmpty()): ?>
  <?php snippet('season', ['season' => $page->active_season()->toPage()]); ?>
<?php endif; ?>
<?php if ($page->show_marquee()->toBool()): ?>
  <?php snippet('marquee'); ?>
<?php endif; ?>
<?php snippet('footer'); ?>
