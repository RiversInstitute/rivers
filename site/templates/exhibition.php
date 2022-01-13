<?php snippet('header', ['headerClass' => 'listing']); ?>
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
<?php if ($page->gallery_heading()->isNotEmpty()): ?>
  <div class="layout-wrapper--full highlight center">
    <br>
    <?= $page->gallery_heading(); ?>
  </div>
<?php endif; ?>
<div class="layout-wrapper--full">
  <?php snippet('listing-gallery', ["files" => $page->main_gallery()->toFiles()]); ?>
</div>
<?php if ($page->associated_content_heading()->isNotEmpty()): ?>
  <div class="layout-wrapper--full highlight center">
    <br>
    <?= $page->associated_content_heading(); ?>
  </div>
<?php endif; ?>
<div class="layout-wrapper--full">
  <?php snippet('associated-grid', ["contents" => $page->associated_content()->toStructure()]); ?>
</div>
<div class="layout-wrapper">
  <div class="listing__content text">
    <?= $page->main_content_continued()->kt(); ?>
  </div>
</div>
<?php snippet('footer'); ?>
