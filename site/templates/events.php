<?php snippet('header', ['headerClass' => 'height-limited']); ?>
<?php snippet('nav'); ?>
<div class="listings__wrapper">
  <div class="listings__header">
    <div class="layout-wrapper--full">
      <div class="text highlight">
        <?= $page->main_content()->kt(); ?>
      </div>
    </div>
  </div>
  <?php snippet('listings-grid', ["nonmobile_width" => "300px", "mobile_width" => "45vw", "listings" => $page->children()->listed()->sortBy('start_date', 'desc')]); ?>
</div>
<?php snippet('footer'); ?>
