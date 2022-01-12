<?php
  srand(mktime(0, 0, 0));
  $positions = [];
  $width = 6;
  $height = size($contents);
  $coords = array_fill(0, $width * $height, 0);
  foreach($contents as $idx=>$entry) {
    $x = rand(0, $width-1);
    $y = rand(0, $height-1);
    while ($coords[$x*$y] != 0) {
      $x = rand(0,$width-1);
      $y = rand(0,$height-1);
    }
    $coords[$x*$y] = 1;
    array_push($positions, [$x+1, $y+1]);
  }
  srand();
?>
<ul 
  class="associated__grid" 
  id="associated" 
  style="
    --width--count: <?= $width; ?>;
    --height--count: <?= $height; ?>;
  "
  >
  <?php foreach($contents as $idx=>$content): ?>
    <li 
      class="associated__grid__item"
      style="
        --grid-area: <?= $positions[$idx][1]; ?> / <?= $positions[$idx][0]; ?>;
      "
      >
      <?php if($content->links_to() == "page"): ?>
        <a href="<?=$content->page_link()->toPage()->url(); ?>">
      <?php else: ?>
        <a href="<?=$content->url_link(); ?>">
      <?php endif; ?>
        <div class="associated__grid__item__title">
          <p class="text">
            <?= $content->title(); ?>
          </p>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
</ul>