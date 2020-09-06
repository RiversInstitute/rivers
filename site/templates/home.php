<?php if ($page->active_season()->isNotEmpty()): ?>
  <?php 
    $seasonPage = $page->active_season()->toPage();
    $seasonFile = 'seasons/' . $seasonPage->slug() . '/index'; 
    ?>
  <?php snippet('header', ['headerClass' => $seasonPage->slug()]); ?>
  <?php snippet('nav', ['showMarquee' => $page->show_marquee()->toBool()]); ?>
  <?php snippet($seasonFile, ['season' => $seasonPage]); ?>
<?php else: ?>
  <?php snippet('header'); ?>
  <?php snippet('nav', ['showMarquee' => $page->show_marquee()->toBool()]); ?>
<?php endif; ?>
<?php snippet('footer'); ?>
