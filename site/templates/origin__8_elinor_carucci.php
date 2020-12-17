<?php snippet('header', ['headerClass' => 'carucci']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>

<div class="carucci__bio-credits">
  <div class="layout-wrapper">
    <div class="bio text">
      <?= $page->bio_credits()->kt(); ?>
    </div>
  </div>
</div>


<div class="carucci__wrapper">

  <div class="scroll1">
    <ul class="image__list">
      <?php $images = $page->image_items()->toStructure(); ?>
      <?php foreach($images as $image): ?>
        <li class="image__item">
          <img
            src="<?= $image->image_file()->toFile()->resize(2000)->url(); ?>"
            loading="lazy"
            class="image__item__image"
            data-idx="<?= $images->indexOf($image) ?>"
            >
          <div class="image__item__caption text">
            <?= $image->caption()->kt() ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- <div id="scroll2">
    <ul class="image__list">
      <?php $images = $page->image_items()->toStructure(); ?>
      <?php foreach($images as $image): ?>
        <li class="image__item">
          <img
            src="<?= $image->image_file()->toFile()->resize(2000)->url(); ?>"
            loading="lazy"
            class="image__item__image"
            data-idx="<?= $images->indexOf($image) ?>"
            >
          <div class="image__item__caption text">
            <?= $image->caption()->kt() ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div> -->



<?php snippet('footer'); ?>
