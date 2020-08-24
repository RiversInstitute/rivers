<?php snippet('header'); ?>
<?php snippet('nav', ['showMarquee' => $page->show_marquee()->toBool()]); ?>
<?php if ($page->active_season()->isNotEmpty()): ?>
  <?php 
    $seasonPage = $page->active_season()->toPage();
    $seasonFile = 'seasons/' . $seasonPage->slug() . '/index'; 
    ?>
  <?php snippet($seasonFile, ['season' => $seasonPage]); ?>
<?php endif; ?>
<?php snippet('footer'); ?>
