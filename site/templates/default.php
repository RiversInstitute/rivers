<?php snippet('header'); ?>
<div class="layout-wrapper">
  <div class="main-content">
    <div class="main-content__item text">
      <?= $page->main_content()->kt(); ?>
    </div>
    <div class="main-content__item text">
      <?= $page->main_content_2()->kt(); ?>
    </div>
  </div>
</div>
<?php snippet('footer'); ?>
