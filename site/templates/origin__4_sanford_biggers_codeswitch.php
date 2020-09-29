<?php snippet('header', ['headerClass' => 'codeswitch']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>
<div class="codeswitch__bio-credits">
  <div class="layout-wrapper text">
    <?= $page->bio_credits()->kt(); ?>
  </div>
</div>
<div class="codeswitch__tutorial">
  <div class="layout-wrapper text">
    <?= $page->how_to()->kt(); ?>
  </div>
</div>
<div class="codeswitch__audio">
  <audio id="codeswitchAudio">
    <?php $audio = $page->codeswitch_audio()->toFile(); ?>
    <source src="<?= $audio->url(); ?>" type="<?= $audio->mime(); ?>">
  </audio>
</div>
<ul class="codeswitch__container">
  <?php for($i = 0; $i < 8; $i++): ?>
    <li class="codeswitch__item">
      <?php $images = $page->viewer_images()->toFiles(); ?>
      <?php foreach($images as $image): ?>
        <img 
          src="<?= $image->resize(2000)->url(); ?>" 
          loading="lazy" 
          class="codeswitch__item__image <?php e($images->indexOf($image) == 0, 'active'); ?>"
          data-idx="<?= $images->indexOf($image) ?>"
          >
      <?php endforeach; ?>
    </li>
  <?php endfor; ?>
</ul>
<script>
  document.querySelectorAll('.codeswitch__item').forEach((item) => {
    item.addEventListener('click', (e) => {
      const images = item.querySelectorAll('.codeswitch__item__image');
      const active = item.querySelector('.codeswitch__item__image.active');
      
      const activeIdx = parseInt(active.dataset.idx);
      const nextIdx = (activeIdx+1) % images.length;
      console.log(activeIdx, nextIdx);
      images[activeIdx].classList.remove('active');
      images[nextIdx].classList.add('active');
    });
  });

  document.querySelector('#nav-credits').addEventListener('click', () => {
    document.querySelector('.codeswitch__bio-credits').classList.toggle('active');
  });

  document.querySelector('#nav-how-to').addEventListener('click', () => {
    document.querySelector('.codeswitch__tutorial').classList.toggle('active');
  });

  document.querySelector('#nav-play').addEventListener('click', () => {
    const csAudio = document.querySelector('#codeswitchAudio');
    if (csAudio.paused) {
      csAudio.play();
      document.querySelector('#nav-play a').innerText = 'Pause';
    } else {
      csAudio.pause();
      document.querySelector('#nav-play a').innerText = 'Play';
    }
  });
</script>
<?php snippet('footer'); ?>