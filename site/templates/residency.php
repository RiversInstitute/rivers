<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper">
  <div class="text highlight">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<div class="layout-wrapper--full">
  <ul class="listings">
    <?php foreach ($page->children()->listed() as $listing): ?>
      <li class="listings__item">
        <a href="<?= $listing->url(); ?>">
          <?php if($listing->hero_image()->isNotEmpty()): ?>
            <img class="listing__hero" loading="lazy" src="<?= $listing->hero_image()->toFile()->resize(500)->url(); ?>">
          <?php endif; ?>
          <div class="listing__title highlight">
            <?= $listing->title(); ?>
          </div>
          <div class="listing__preview text">
            <?= $listing->preview_content()->kt(); ?>
          </div>
        </a>
      </li>
    <?php endforeach; ?>
    <li class="listings__item">
      <div class="text">
        <?= $page->main_description()->kt(); ?>
      </div>
    </li>
  </ul>
</div>
<?php snippet('footer'); ?>
