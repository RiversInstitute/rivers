<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<?php $seasonFile = 'seasons/' . $page->slug() . '/index'; ?>
<?php snippet($seasonFile, ['season' => $page]); ?>
<?php snippet('footer'); ?>
