<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper">
  <div class="text highlight">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<div class="layout-wrapper--full">
  <ul class="happenings">
    <?php foreach ($page->children()->listed()->sortBy('start_date','desc') as $listing): ?>
      <li class="listing__list">
        <a href="<?= $listing->url(); ?>">
          <?php if($listing->hero_image()->isNotEmpty()): ?>
            <img class="listing__hero" loading="lazy" src="<?= $listing->hero_image()->toFile()->resize(500)->url(); ?>">
          <?php endif; ?>
          <div class="listing__title">
            <?= $listing->title(); ?>
          </div>
          <div class="listing__date-time">
            <?php snippet('date-time', ['happening' => $listing]); ?>
          </div>
          <div class="listing__preview text">
            <?= $listing->preview()->kt(); ?>
          </div>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php snippet('footer'); ?>
