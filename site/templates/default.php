<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<?php if($page->header()->isNotEmpty()): ?>
  <div class="layout-wrapper">
    <div class="text highlight">
      <?= $page->header()->kt(); ?>
    </div>
  </div>
<?php endif; ?>
<div class="layout-wrapper">
  <div class="text">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<?php snippet('footer'); ?>
