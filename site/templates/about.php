<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="about__container">
  <div class="text">
    <?= $page->main_content()->kt(); ?>
  </div>
  <div class="about__rail">
    <div class="text about__rail__primary">
      <?= $page->right_rail_1()->kt(); ?>
    </div>
    <div class="text about__rail__secondary">
      <?= $page->right_rail_2()->kt(); ?>
    </div>
  </div>
</div>
<?php snippet('footer'); ?>
