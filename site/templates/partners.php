<?php snippet('header', ['headerClass' => 'no-pad']); ?>
<?php snippet('nav'); ?>
<div class="height-constrained">
  <div class="layout-wrapper--full">
    <div class="text col-2">
      <?= $page->main_content()->kt(); ?>
    </div>
  </div>
  <div class="partners__container">
    <ul class="partners" style="--partner--count: <?= $page->partners()->toStructure()->count(); ?>;">
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
</div>
<?php snippet('footer'); ?>
