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

<div class="carucci__overlay">
  <div class="carucci__overlay__content">
    <div class="carucci__overlay__title text">
      <?= $page->overlay_title()->kt(); ?>
    </div>
    <div class="carucci__overlay__note text">
      <?= $page->overlay_note()->kt(); ?>
    </div>
    <div class="carucci__overlay__enter_button">
      <button type="button">Enter</button>
    </div>
  </div>
</div>

<div class="carucci__audio">
  <audio id="carucciAudio">
    <?php $audio = $page->carucci_audio()->toFile(); ?>
    <source src="<?= $audio->url(); ?>" type="<?= $audio->mime(); ?>">
  </audio>
</div>

<div class="carucci__essay">
  <div class="layout-wrapper--full">
    <div class="carucci__essay__title text">
      <?= $page->essay_title()->kt(); ?>
    </div>
    <div class="carucci__essay__content text">
      <?= $page->essay()->kt(); ?>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const imageList = document.getElementById('image-list');
    const wrapper = imageList.parentElement;
    const windowWidth = innerWidth/2;

    imageList.addEventListener('click', () => {
      const beforeWidth = wrapper.scrollWidth;
      const beforeScrollPos = wrapper.scrollLeft + windowWidth;


      imageList.classList.toggle('expanded');

      const afterWidth = wrapper.scrollWidth;
      const ratio = (afterWidth) / (beforeWidth);

      wrapper.scrollTo(beforeScrollPos * ratio + 400 - windowWidth, 0);

    });
  });

  document.querySelector('#nav-listen').addEventListener('click', () => {
    const csAudio = document.querySelector('#carucciAudio');
    if (csAudio.paused) {
      csAudio.play();
      document.querySelector('#nav-listen a').innerText = 'Pause';
    } else {
      csAudio.pause();
      document.querySelector('#nav-listen a').innerText = 'Listen';
    }
  });

  document.querySelector('#nav-about').addEventListener('click', () => {
    document.querySelector('.carucci__bio-credits').classList.toggle('active');
    document.querySelector('.carucci__essay').classList.remove('active');
  });

  document.querySelector('#nav-essay').addEventListener('click', () => {
    document.querySelector('.carucci__essay').classList.toggle('active');
    document.querySelector('.carucci__bio-credits').classList.remove('active');
  });

  document.body.style.overflow = 'hidden';
  document.querySelector('.carucci__overlay').addEventListener('click', () => {
    document.querySelector('.carucci__overlay').style.display = 'none';
    document.body.style.removeProperty('overflow');
    const csAudio = document.querySelector('#carucciAudio');
    csAudio.play();
  });


</script>
<?php snippet('footer'); ?>
