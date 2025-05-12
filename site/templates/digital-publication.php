<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper">
<div class="publication">
  <div class="publication__title text">
    <a class="no-highlight" href="
      <?php if ($page->publication_type() == "physical"): ?>
        <?= $page->url(); ?>
      <?php else: ?>
        /<?= $page->digital_publication_page()->url(); ?>
      <?php endif; ?>
      ">
      <?= $page->publication_title()->kt(); ?>
    </a>
  </div>
  <?php if ($page->publication_images()->toFiles()->isNotEmpty()): ?>
    <ul class="publication__images">
      <?php $idx = 0; ?>
      <?php foreach($page->publication_images()->toFiles() as $key=>$image): ?>
        <img class="publication__images__image <?php e($idx++ == 0, 'active'); ?>" src="<?= $image->resize(500)->url(); ?>" loading="lazy">
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <?php if ($page->publication_type() == "physical"): ?>
    <div class="publication__price">
      <?= $page->price(); ?> <?php if ($page->purchase_url()->isNotEmpty()): ?><a class="highlight" href="<?= $page->purchase_url(); ?>">Purchase&nbsp;&#8599;&#xFE0E;</a><?php endif; ?>
    </div>
  <?php else: ?>
    <div class="publication__link">
      <a class="highlight" href="/<?= $page->digital_publication_page()->url(); ?>">Digital publication&nbsp;&#8599;&#xFE0E;</a>
    </div>
  <?php endif; ?>
  <div class="publication__reviews text">
    <?= $page->reviews()->kt(); ?>
  </div>
  <div class="publication__content text">
    <?= $page->main_content()->kt(); ?>
  </div>
  <div class="publication__credits text">
    <?= $page->credits()->kt(); ?>
  </div>
  <?php if ($page->publication_type() == "physical"): ?>
    <div class="publication__metadata text">
      <?= $page->metadata()->kt(); ?>
    </div>
  <?php endif; ?>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.publication__images').forEach((imageContainer) => {
      imageContainer.addEventListener('click', () => {
        const images = imageContainer.querySelectorAll('.publication__images__image');
        const activeImage = imageContainer.querySelector('.publication__images__image.active');
        let activeIdx = [].findIndex.call(images, (el) => el === activeImage);
        images[activeIdx].classList.remove('active');
        images[(activeIdx + 1) % images.length].classList.add('active');
      });
    });
  });
</script>
<?php snippet('footer'); ?>
