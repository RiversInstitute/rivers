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
    <?php foreach($page->archival_images()->toStructure() as $archival): ?>
      <li class="laura-mullen__images__image <?php e($archival->key_image()->toBool(), 'active'); ?>" <?php e($archival->key_image()->toBool(), 'data-key-image'); ?> data-idx="<?= $page->archival_images()->toStructure()->indexOf($archival) ?>">
        <img
          srcset="<?= $archival->archival_image()->toFile()->srcset([800, 1024, 1333, 2000]); ?>"
          class="laura-mullen__images__image__img"
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
    const keyImage = document.querySelector('[data-key-image]');
    const audio = document.querySelector('#audio');

    const numLoops = <?= $page->num_loops(); ?>;
    const intervalLength = <?= $page->slide_length(); ?> * 1000;
    let activeIdx = parseInt(keyImage.dataset.idx);
    let looper = null;
    let loopCount = -1;

    const startLooper = () => {
      looper = setInterval(() => {
        if (images[activeIdx] === keyImage) {
          loopCount++;
          if (loopCount > numLoops) {
            clearInterval(looper);
            looper = null;
            return;
          }
        }

        images[activeIdx].classList.remove('active');
        activeIdx = (activeIdx + 1) % images.length;
        images[activeIdx].classList.add('active');
      }, intervalLength);
    };

    const addImageContainerInteraction = () => {
      imageContainer.addEventListener('click', () => {
        if (audio.paused) {
          audio.play();
        } else {
          audio.pause();
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

    document.querySelector('#nav-poem a').target= '_blank';
  });
</script>
<?php snippet('footer'); ?>
