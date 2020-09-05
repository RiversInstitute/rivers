<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper--full shop__header">
  <div class="shop__title">
    <?= $page->title(); ?>
  </div>
  <div class="shop__content text">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<div class="layout-wrapper--full">
  <ul class="shop">
    <?php foreach ($page->children()->listed() as $item): ?>
      <li class="item">
        <div class="item__title text">
          <?= $item->item_title()->kt(); ?>
        </div>
        <div class="item__reviews text">
          <?= $item->reviews()->kt(); ?>
        </div>
        <div class="item__content text">
          <?= $item->main_content()->kt(); ?>
        </div>
        <div class="item__credits text">
          <?= $item->credits()->kt(); ?>
        </div>
        <div class="item__price">
          <?= $item->price(); ?>
        </div>
        <div class="item__metadata text">
          <?= $item->metadata()->kt(); ?>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php snippet('footer'); ?>
