<?php snippet('header', ['headerClass' => 'edwards']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>
<div class="edwards__bio-credits">
  <div class="layout-wrapper">
    <div class="bio">
      <?= $page->bio_credits()->kt(); ?>
    </div>
  </div>
</div>


<div class="edwards__layout-wrapper">
  <ul>
    <li class="edwards__title slide active">
      <div class="text">
        <?= $page->work_title()->kt(); ?>
      </div>
      <ul class="edwards__title__numbers">
        <?php $number = $page->works()->toStructure()->count(); ?>
        <?php for ($i = 1; $i <= $number; $i++): ?>
          <li class="edwards__number">
            <button class="edwards__number__button" onclick="selectSlide(event, <?= $i ?>)">
              <?= $i . "." ?>
            </button>
          </li>
        <?php endfor; ?>
      </ul>
    </li>
    <?php foreach($page->works()->toStructure() as $idx=>$work): ?>
      <li class="works slide" data-idx="<?= $idx; ?>" style="--count: <?= $work->works_contents()->toStructure()->count(); ?>">
        <?php foreach($work->works_contents()->toStructure() as $workContent): ?>
          <img
            src="<?= $workContent->work_content()->toFile()->resize(2000)->url(); ?>"
            loading="lazy"
            class="slide__image"
            style="
              --self-align: <?= $workContent->work_content_align(); ?>;
              <?php if($workContent->work_content_size()->isNotEmpty()): ?>
                --slide-width: <?= $workContent->work_content_size(); ?>vw;
              <?php endif; ?>
            "
            alt="<?= $workContent->work_content()->toFile()->caption(); ?>"
          >
        <?php endforeach; ?>
        <?php if($work->audio()->isNotEmpty()): ?>
          <audio class="slide__audio">
            <?php $audio = $work->audio()->toFile(); ?>
            <source src="<?= $audio->url(); ?>" type="<?= $audio->mime(); ?>">
          </audio>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>

  <ul class="edwards__numbers">
    <li class="edwards__number active">
      <button class="edwards__number__button" onclick="selectSlide(event, 0)">●</button>
    </li>
    <?php $number = $page->works()->toStructure()->count(); ?>
    <?php for ($i = 1; $i <= $number; $i++): ?>
      <li class="edwards__number">
        <button class="edwards__number__button" onclick="selectSlide(event, <?= $i ?>)">
          <?= $i . "." ?>
        </button>
      </li>
    <?php endfor; ?>
  </ul>
</div>


<script>
  let activeIdx = 0;
  let activeAudio = null;
  const slides = document.querySelectorAll('.slide');
  const slideNumbers = document.querySelectorAll('.edwards__numbers .edwards__number');

  document.querySelector('#nav-about').addEventListener('click', () => {
    document.querySelector('.edwards__bio-credits').classList.toggle('active');
  });

  document.querySelector('.edwards__layout-wrapper').addEventListener('click', () => {
    advanceSlide(1);
  })

  document.addEventListener('keydown', (e) => {
    switch (e.key) {
      case 'ArrowLeft':
        advanceSlide(-1);
        break;
      case 'ArrowRight':
        advanceSlide(1);
        break;
    }
  });
  

  let advanceSlide = (increment) => {
    let incr = increment;
    if (activeIdx+increment >= slides.length || activeIdx+increment < 0) {
      incr = 0;
    }
    selectSlide(null, activeIdx+incr);
  };

  let selectSlide = (event, idx) => {
    activeIdx = idx;

    if (event) {
      event.stopPropagation();
    }

    if (idx > 0) {
      document.querySelector('.edwards__numbers').classList.add('visible');
    } else {
      document.querySelector('.edwards__numbers').classList.remove('visible');
    }

    if (activeAudio) {
      activeAudio.pause();
    }
    let audio = slides[idx].querySelector('audio');
    if (audio) {
      activeAudio = audio;
      activeAudio.currentTime = 0;
      activeAudio.play();
    }
    
    slides.forEach((img) => img.classList.remove('active'));
    slideNumbers.forEach((imgNum) => imgNum.classList.remove('active'));

    slides[idx].classList.add('active');
    slideNumbers[idx].classList.add('active');
  }
</script>

<?php snippet('footer'); ?>
