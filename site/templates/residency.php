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
  <ul class="listings" style="--nonmobile--width: 400px; --mobile--width: 45vw;">
    <li class="listings__item">
      <div class="text">
        <?= $page->main_description()->kt(); ?>
      </div>
    </li>
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
  </ul>
</div>
<?php snippet('footer'); ?>
