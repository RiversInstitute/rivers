<?php snippet('header', ['headerClass' => 'listing']); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper">
  <div class="listing__title highlight">
    <?= $page->title(); ?>
  </div>
  <br>
  <div class="listing__content text">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<div class="layout-wrapper--full">
  <?php snippet('listing-gallery', ["files" => $page->main_gallery()->toFiles()]); ?>
</div>
<?php snippet('footer'); ?>
