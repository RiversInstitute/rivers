<?php snippet('header', ['headerClass' => 'rivero']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>

<div class="rivero__bio-credits">
  <div class="layout-wrapper">
    <div class="bio text">
      <?= $page->bio_credits()->kt(); ?>
    </div>
  </div>
</div>

<div class="rivero__wrapper">

  <div class="numbers__image">
    <ul>
      <button onclick="setActiveImage(idx)">
        <?php $number = $page->image_items()->toStructure()->count(); ?>
        <?php for ($i = 1; $i <= $number; $i++): ?>
          <?= $i.="." ?>
        <?php endfor; ?>
     </button>
    </ul>
  </div>

  <ul class="image__container">
    <?php $images = $page->image_items()->toStructure(); ?>
    <?php foreach($images as $image): ?>
      <li class="image__item" id="<?= $image->slug() ?>">
        <img
          src="<?= $image->image_file()->toFile()->resize(2000)->url(); ?>"
          loading="lazy"
          class="image__item__image <?php e($images->indexOf($image) == 0, 'active'); ?>"
          data-idx="<?= $images->indexOf($image) ?>"
          >
        <div class="image__item__caption text <?php e($images->indexOf($image) == 0, 'active'); ?>">
          <?= $image->caption()->kt() ?>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>

  <div class="text__container">

    <div class="text__container__numbers">
      <ul>
        <button onclick="setActiveCard(idx)">
          <?php $number = $page->text_items()->toStructure()->count(); ?>
          <?php for ($i = 1; $i <= $number; $i++): ?>
            <?= $i.="." ?>
          <?php endfor; ?>
      </button>
      </ul>
    </div>

    <ul class="text__container__text">
        <?php $texts = $page->text_items()->toStructure(); ?>
        <?php foreach($texts as $text): ?>
          <li class="text__item text <?php e($texts->indexOf($text) == 0, 'active'); ?>"
          data-idx="<?= $texts->indexOf($text) ?>" >
            <?= $text->text()->kt() ?>
          </li>
        <?php endforeach; ?>
    </ul>

</div>

<script>

function setActiveImage(idx) {

  document.querySelectorAll('.image__item').forEach((item) => {
    item.addEventListener('click', (e) => {
      const images = item.querySelectorAll('.image__item__image');
      const active = item.querySelector('.image__item__image.active');

      const activeIdx = parseInt(active.dataset.idx);
      const nextIdx = (activeIdx+1) % images.length;
      console.log(activeIdx, nextIdx);
      images[activeIdx].classList.remove('active');
      images[nextIdx].classList.add('active');
    });
  });
}

function setActiveCard(idx) {

  document.querySelectorAll('.text__item.text').forEach((item) => {
    item.addEventListener('click', (e) => {
      const cards = item.querySelectorAll('.text__item.text');
      const active = item.querySelector('.text__item.text.active');

      const activeIdx = parseInt(active.dataset.idx);
      const nextIdx = (activeIdx+1) % cards.length;
      console.log(activeIdx, nextIdx);
      cards[activeIdx].classList.remove('active');
      cards[nextIdx].classList.add('active');
    });
  });
}

  document.querySelector('#nav-about').addEventListener('click', () => {
    document.querySelector('.rivero__bio-credits').classList.toggle('active');
  });

</script>

<?php snippet('footer'); ?>
