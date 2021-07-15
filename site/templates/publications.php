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
  <ul class="listings" style="--nonmobile--width: 300px; --mobile--width: 45vw;">
    <?php foreach ($page->children()->template('publication')->listed() as $publication): ?>
      <li class="listings__item"><?php snippet('publication-item', ["publication" => $publication]); ?></li>
    <?php endforeach; ?>
  </ul>
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
