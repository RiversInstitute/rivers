<?php snippet('header', ['headerClass' => 'jennings']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>

<div class="jennings__bio-credits">
  <div class="layout-wrapper">
    <div class="bio">
      <?= $page->bio_credits()->kt(); ?>
    </div>
  </div>
</div>

<div class="jennings_wrapper__horizontal">
  <ul class="jennings_wrapper__vertical">
    <?php foreach ($page->video_item()->toStructure() as $video): ?>
      <li class="video__item">
        <div class="video__item__embed">
          <?= $video->embed(); ?>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<script>
  document.querySelector('#nav-credits').addEventListener('click', () => {
      document.querySelector('.jennings__bio-credits').classList.toggle('active');
    });
</script>


<?php snippet('footer'); ?>
