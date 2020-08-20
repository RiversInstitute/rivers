<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper event-exhibition">
  <div class="listing__title">
    <?= $page->title(); ?>
  </div>
  <div class="listing__date-time">
    <?php snippet('date-time', ['event' => $page]); ?>
  </div>
  <div class="listing__content text">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<?php snippet('footer'); ?>
