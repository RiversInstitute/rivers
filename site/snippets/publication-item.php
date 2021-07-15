<li class="listings__item">
  <div class="publication__title text">
    <a class="no-highlight" href="
      <?php if ($publication->publication_type() == "physical"): ?>
        <?= $publication->url(); ?>
      <?php else: ?>
        <?= $publication->digital_publication_page()->url(); ?>
      <?php endif; ?>
      ">
      <?= $publication->publication_title()->kt(); ?>
    </a>
  </div>
  <?php if ($publication->publication_images()->toFiles()->isNotEmpty()): ?>
    <ul class="publication__images">
      <?php $idx = 0; ?>
      <?php foreach($publication->publication_images()->toFiles() as $key=>$image): ?>
        <img class="publication__images__image <?php e($idx++ == 0, 'active'); ?>" src="<?= $image->resize(500)->url(); ?>" loading="lazy">
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <?php if ($publication->publication_type() == "physical"): ?>
    <div class="publication__price">
      <?= $publication->price(); ?> <?php if ($publication->purchase_url()->isNotEmpty()): ?><a class="highlight" href="<?= $publication->purchase_url(); ?>">Purchase&nbsp;&#8599;&#xFE0E;</a><?php endif; ?>
    </div>
  <?php else: ?>
    <div class="publication__link">
      <a class="highlight" href="<?= $publication->digital_publication_page()->url(); ?>">Digital publication&nbsp;&#8599;&#xFE0E;</a>
    </div>
  <?php endif; ?>
  <div class="publication__reviews text">
    <?= $publication->reviews()->kt(); ?>
  </div>
  <div class="publication__content text">
    <?= $publication->main_content()->kt(); ?>
  </div>
  <div class="publication__credits text">
    <?= $publication->credits()->kt(); ?>
  </div>
  <?php if ($publication->publication_type() == "physical"): ?>
    <div class="publication__metadata text">
      <?= $publication->metadata()->kt(); ?>
    </div>
  <?php endif; ?>
</li>