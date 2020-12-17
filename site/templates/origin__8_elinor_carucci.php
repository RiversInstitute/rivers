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
  <ul class="image__list" id="image-list">
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

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const imageList = document.getElementById('image-list');
    const wrapper = imageList.parentElement;
    const windowWidth = innerWidth / 2;

    imageList.addEventListener('click', () => {
      const beforeWidth = wrapper.scrollWidth;
      const beforeScrollPos = wrapper.scrollLeft + windowWidth;


      imageList.classList.toggle('expanded');

      const afterWidth = wrapper.scrollWidth;
      const ratio = afterWidth / beforeWidth;

      wrapper.scrollTo(beforeScrollPos * ratio - windowWidth, 0);

    });
  });
</script>
<?php snippet('footer'); ?>
