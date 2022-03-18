<?php
  srand(mktime(0, 0, 0));
  $positions = [];
  $positionsMobile = [];
  
  $width = 6;
  $widthMobile = 2;
  $height = size($contents);
  $heightMobile = size($contents) * 2;

  $coords = array_fill(0, $width * $height, 0);
  $coordsMobile = array_fill(0, $widthMobile * $heightMobile, 0);
  
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

  foreach($contents as $idx=>$entry) {
    $x = rand(0, $widthMobile-1);
    $y = rand(0, $heightMobile-1);
    while ($coords[$x*$y] != 0) {
      $x = rand(0,$widthMobile-1);
      $y = rand(0,$heightMobile-1);
    }
    $coordsMobile[$x*$y] = 1;
    array_push($positionsMobile, [$x+1, $y+1]);
  }
  srand();
?>
<ul 
  class="associated__grid" 
  id="associated" 
  style="
    --width--count: <?= $width; ?>;
    --height--count: <?= $height; ?>;
    --width--count--mobile: <?= $widthMobile; ?>;
    --height--count--mobile: <?= $heightMobile; ?>;
  "
  >
  <?php foreach($contents as $idx=>$content): ?>
    <li 
      class="associated__grid__item"
      style="
        --opacity: <?= $idx * (.2 / size($contents)) + .5 ?>;
        --grid-area: <?= $positions[$idx][1]; ?> / <?= $positions[$idx][0]; ?>;
        --grid-area--mobile: <?= $positionsMobile[$idx][1]; ?> / <?= $positionsMobile[$idx][0]; ?>;
      "
      >
      <?php if($content->links_to() == "page"): ?>
        <a href="<?=$content->page_link()->toPage()->url(); ?>">
      <?php else: ?>
        <a href="<?=$content->url_link(); ?>">
      <?php endif; ?>
        <div class="associated__grid__item__title">
          <p class="text">
            <?= $content->title()->kt(); ?>
          </p>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
</ul>