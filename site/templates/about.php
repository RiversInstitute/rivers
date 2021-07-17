<?php snippet('header', ['headerClass' => 'invert']); ?>
<?php snippet('nav'); ?>
<div class="about__container">
  <div class="text">
    <?= $page->main_content()->kt(); ?>
  </div>
  <div class="text about__rail">
    <?= $page->right_rail()->kt(); ?>
  </div>
</div>
<?php snippet('footer'); ?>
