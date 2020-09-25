<?php snippet('header', ['headerClass' => 'no-pad']); ?>
<?php snippet('nav'); ?>
<div class="height-constrained">
  <div class="layout-wrapper">
    <div class="text highlight">
      <?= $page->main_content()->kt(); ?>
    </div>
  </div>
  <div class="layout-wrapper--full height-100">
    <ul class="shop">
      <?php foreach ($page->children()->listed() as $item): ?>
        <li class="item">
          <div class="item__title text">
            <?= $item->item_title()->kt(); ?>
          </div>
          <?php if ($item->item_images()->toFiles()->isNotEmpty()): ?>
            <ul class="item__images">
              <?php $idx = 0; ?>
              <?php foreach($item->item_images()->toFiles() as $key=>$image): ?>
                <img class="item__images__image <?php e($idx++ == 0, 'active'); ?>" src="<?= $image->resize(500)->url(); ?>" loading="lazy">
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
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
              <?= $item->price(); ?> <?php if ($item->purchase_url()->isNotEmpty()): ?><a class="highlight" href="<?= $item->purchase_url(); ?>">Purchase &#8599;</a><?php endif; ?>
          </div>
          <div class="item__metadata text">
            <?= $item->metadata()->kt(); ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.item__images').forEach((imageContainer) => {
      imageContainer.addEventListener('click', () => {
        const images = imageContainer.querySelectorAll('.item__images__image');
        const activeImage = imageContainer.querySelector('.item__images__image.active');
        let activeIdx = [].findIndex.call(images, (el) => el === activeImage);
        images[activeIdx].classList.remove('active');
        images[(activeIdx + 1) % images.length].classList.add('active');
      });
    });
  });
</script>
<?php snippet('footer'); ?>
