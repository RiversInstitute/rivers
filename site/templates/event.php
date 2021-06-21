<?php snippet('header', ['headerClass' => 'happening']); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper">
  <div class="listing__title">
    <?= $page->title(); ?>
  </div>
  <div class="listing__date-time">
    <?php snippet('date-time', ['happening' => $page]); ?>
  </div>
  <div class="listing__content text">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<div class="layout-wrapper--full">
  <ul class="listing__gallery" id="gallery">
    <?php foreach($page->main_gallery()->toFiles() as $file): ?>
      <li class="listing__gallery__item">
        <a href="<?= $file->resize(2000)->url() ?>">
          <div class="listing__gallery__item__image">
            <img src="<?= $file->resize(500)->url() ?>" loading="lazy">
          </div>
          <div class="listing__gallery__item__caption text">
            <?= $file->caption()->kt(); ?>
          </div>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
<div class="layout-wrapper">
  <div class="listing__content text">
    <?= $page->main_content_continued()->kt(); ?>
  </div>
</div>
<?php snippet('footer'); ?>
