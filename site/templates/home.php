<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<?php if ($page->active_season()->isNotEmpty()): ?>
  <?php 
    $seasonPage = $page->active_season()->toPage();
    $seasonFile = 'seasons/' . $seasonPage->slug() . '/index'; 
    ?>
  <?php snippet($seasonFile, ['season' => $seasonPage]); ?>
<?php endif; ?>
<?php if ($page->show_marquee()->toBool()): ?>
  <?php snippet('marquee'); ?>
<?php endif; ?>
<?php snippet('footer'); ?>
