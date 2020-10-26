<?php snippet('header', ['headerClass' => 'rivero']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>

<div class="rivero__bio-credits">
  <div class="layout-wrapper">
    <div class="bio text">
      <?= $page->bio_credits()->kt(); ?>
    </div>
  </div>
</div>

<div class="rivero__installation">
  <ul class="installation__images">
    <?php $images = $page->installation_images()->toStructure(); ?>
    <?php foreach($images as $image): ?>
      <li class="installation__image__item">
        <img
          src="<?= $image->installation_image()->toFile()->resize(2000)->url(); ?>"
          loading="lazy"
          class="installation__image__item__image"
          >
        <div class="installation__image__item__location text">
          <?= $image->location()->kt() ?>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<div class="rivero__wrapper">
  <div class="numbers__image">
    <ul class="numers__image__list">
      <?php $number = $page->image_items()->toStructure()->count(); ?>
      <?php for ($i = 0; $i < $number; $i++): ?>
        <li class="numbers__image__item <?php e($i == 0, 'active'); ?>">
          <button class="numbers__image__item__button" onclick="setActiveImage(<?= $i ?>)">
            <?= $i+1 . "." ?>
          </button>
        </li>
      <?php endfor; ?>
    </ul>
  </div>

  <ul class="image__list">
    <?php $images = $page->image_items()->toStructure(); ?>
    <?php foreach($images as $image): ?>
      <li class="image__item <?php e($images->indexOf($image) == 0, 'active'); ?>" id="<?= $image->id() ?>">
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

  <div class="text__container active">
    <ul class="text__container__numbers">
      <?php $number = $page->text_items()->toStructure()->count(); ?>
      <?php for ($i = 0; $i < $number; $i++): ?>
        <li class="text__container__number__item <?php e($i == 0, 'active'); ?>">
          <button onclick="setActiveCard(<?= $i ?>)">
            <?php 
              $idx = $i . ".";
              if ($idx == $number - 1) {
                $idx = "*";
              }
            ?>
            <?= $idx; ?>
          </button>
        </li>
      <?php endfor; ?>
    </ul>
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

  <div class="text__container__toggle">
    <button class="text__container__toggle__button active" onClick="toggleText()">Close notes</button>
  </div>
</div>

<script>
  function toggleText() {
    document.querySelector('.text__container').classList.toggle('active');
    const toggleButton = document.querySelector('.text__container__toggle__button');
        toggleButton.classList.toggle('active');
        if(toggleButton.innerHTML === "Close notes") {
  	       toggleButton.innerHTML = "Open notes";
        } else {
  	  	  toggleButton.innerHTML = "Close notes";
        }
  }


  function setActiveImage(idx) {
    const images = document.querySelectorAll('.image__item');
    const imageNumbers = document.querySelectorAll('.numbers__image__item');
    images.forEach((img) => img.classList.remove('active'));
    imageNumbers.forEach((imgNum) => imgNum.classList.remove('active'));

    images[idx].classList.add('active');
    imageNumbers[idx].classList.add('active');
  }

  function setActiveCard(idx) {
    const cards = document.querySelectorAll('.text__item');
    const cardNumbers = document.querySelectorAll('.text__container__number__item');
    cards.forEach((card) => card.classList.remove('active'));
    cardNumbers.forEach((cardNum) => cardNum.classList.remove('active'));

    cards[idx].classList.add('active');
    cardNumbers[idx].classList.add('active');
  }

  function getIndexOfImage(el) {
    return Array.prototype.indexOf.call(el.parentNode.children, el);
  }

  document.querySelectorAll('a[href*="image"]').forEach((link) => {
    link.addEventListener('click', () => {
      const imageId = link.getAttribute('href');
      const image = document.querySelector(imageId);
      setActiveImage(getIndexOfImage(image));
    });
  });

  document.querySelector('#nav-about').addEventListener('click', () => {
    document.querySelector('.rivero__bio-credits').classList.toggle('active');
  });

  document.querySelector('#nav-installation').addEventListener('click', () => {
    document.querySelector('.rivero__installation').classList.toggle('active');
  });
</script>
<?php snippet('footer'); ?>
