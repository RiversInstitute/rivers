<?php snippet('header', ['headerClass' => 'no-pad invert']); ?>
<?php snippet('nav'); ?>
<div class="height-constrained">
  <div class="layout-wrapper--full grid-2">
    <div class="text highlight">
      <?= $page->main_content()->kt(); ?>
    </div>
  </div>
  <div class="layout-wrapper--full height-100">
    <ul class="publications">
      <?php foreach ($page->children()->template('publication')->listed() as $publication): ?>
        <?php snippet('publication-item', ["publication" => $publication]); ?>
      <?php endforeach; ?>
    </ul>
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
