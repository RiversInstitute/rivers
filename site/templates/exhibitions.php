<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper">
  <div class="text highlight">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<div class="layout-wrapper--full">
  <?php snippet('listings-grid', ["listings" => $page->children()->listed()->sortBy('start_date', 'desc')]); ?>
</div>
<?php snippet('footer'); ?>
