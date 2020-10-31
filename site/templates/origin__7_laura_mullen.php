<?php snippet('header', ['headerClass' => 'laura-mullen']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>


<div class="laura-mullen-audio__wrapper__vertical" id="audio-container">
  <div class="laura-mullen-audio__wrapper__horizontal">
    <audio controls loop class="laura-mullen-audio__audio" id="audio">
      <?php $audio = $page->laura_mullen_audio()->toFile(); ?>
      <source src="<?= $audio->url(); ?>" type="<?= $audio->mime(); ?>">
    </audio>
  </div>
</div>

<div class="laura-mullen-image__wrapper" id="image-container">
  <ul class="laura-mullen__images">
    <?php foreach($page->archival_images()->toFiles() as $image): ?>
      <li class="laura-mullen__images__image">
        <img
          src="<?= $image->resize(2000)->url(); ?>"
          class="laura-mullen__images__image__img"
          _loading="lazy"
        >
      </li>
    <?php endforeach; ?>
  </ul>
</div>


<div class="laura-mullen__bio-credits">
  <div class="layout-wrapper">
    <div class="bio text">
      <?= $page->bio_credits()->kt(); ?>
    </div>
  </div>
</div>

<div class="laura-mullen__notes">
  <div class="layout-wrapper--full">
    <div class="laura-mullen__notes__note text">
      <?= $page->notes()->kt(); ?>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const audioContainer = document.querySelector('#audio-container');
    const imageContainer = document.querySelector('#image-container');
    const images = imageContainer.querySelectorAll('.laura-mullen__images__image');
    const audio = document.querySelector('#audio');

    let activeIdx = -1;
    let looper = null;

    const startLooper = () => {
      if (looper) {
        return;
      }

      looper = setInterval(() => {
        if (activeIdx >= 0)
          images[activeIdx].classList.remove('active');
        activeIdx = (activeIdx + 1) % images.length;
        images[activeIdx].classList.add('active');
      }, 1000);
    };

    const pauseLooper = () => {
      clearInterval(looper);
      looper = null;
    }

    const addImageContainerInteraction = () => {
      imageContainer.addEventListener('click', () => {
        if (audio.paused) {
          audio.play();
          startLooper();
        } else {
          audio.pause();
          pauseLooper();
        }
      });
    }

    audioContainer.addEventListener('click', () => {
      audio.play();
      audioContainer.classList.add('hidden');
      imageContainer.classList.add('visible');
      startLooper();
      setTimeout(addImageContainerInteraction, 5000);
    });

    document.querySelector('#nav-about').addEventListener('click', () => {
      document.querySelector('.laura-mullen__bio-credits').classList.toggle('active');
      document.querySelector('.laura-mullen__notes').classList.remove('active');
    });

    document.querySelector('#nav-notes').addEventListener('click', () => {
      document.querySelector('.laura-mullen__notes').classList.toggle('active');
      document.querySelector('.laura-mullen__bio-credits').classList.remove('active');
    });

    document.querySelector('#nav-score a').target= '_blank';
  });
</script>
<?php snippet('footer'); ?>
