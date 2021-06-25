<?php snippet('header', ['headerClass' => 'happening']); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper">
  <div class="listing__title highlight">
    <?= $page->title(); ?>
  </div>
  <div class="listing__date-time highlight">
    <?php snippet('date-time', ['happening' => $page]); ?>
  </div>
  <div class="listing__content text">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<div class="layout-wrapper--full">
  <?php snippet('listing-gallery', ["files" => $page->main_gallery()->toFiles()]); ?>
</div>
<div class="layout-wrapper">
  <div class="listing__content text">
    <?= $page->main_content_continued()->kt(); ?>
  </div>
</div>
<?php snippet('footer'); ?>
