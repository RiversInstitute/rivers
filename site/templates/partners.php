<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper">
  <div class="text">
    <?= $page->main_content()->kt(); ?>
  </div>
</div>
<div class="layout-wrapper--full">
  <ul class="partners">
    <?php foreach ($page->partners()->toStructure() as $partner): ?>
      <li class="partners__partner" style="--partner-color: <?= $partner->color(); ?>;">
        <a href="<?= $partner->url(); ?>">
          <div class="partner__logo">
            <img class="partner__logo__image" loading="lazy" src="<?= $partner->logo()->toFile()->resize(500)->url(); ?>">
          </div>
        </a>
        <div class="partner__description text">
          <?= $partner->description()->kt(); ?>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php snippet('footer'); ?>
