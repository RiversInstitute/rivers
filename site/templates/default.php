<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper">
  <div class="main-content">
    <div class="main-content__item text">
      <?= $page->main_content()->kt(); ?>
    </div>
  </div>
</div>
<?php snippet('footer'); ?>
