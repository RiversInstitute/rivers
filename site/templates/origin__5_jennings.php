<?php snippet('header', ['headerClass' => 'jennings']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>

<div class="jennings_wrapper__horizontal">
<ul class="jennings_wrapper__vertical">
  <?php foreach ($page->video_item()->toStructure() as $video): ?>
    <li class="video__item">
      <!-- <div class="text">
        <?= $video->citation()->kt(); ?>
      </div> -->
      <div class="video__item__embed">
        <?= $video->embed(); ?>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
</div>
