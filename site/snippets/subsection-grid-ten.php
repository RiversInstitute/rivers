<div class="grid-ten-container">
    <ul class="grid-blocks">
      <?php
        // Get date from URL parameter or use current date
        $dateParam = get('date');
        if ($dateParam) {
          $timestamp = strtotime($dateParam);
          if ($timestamp === false) {
            $timestamp = mktime(0, 0, 0); // Fallback to current date if invalid
          }
        } else {
          $timestamp = mktime(0, 0, 0);
        }
        
        // Seed the random number generator with the timestamp
        srand($timestamp);
        
        // Get entries and limit to 6
        if (isset($subpages)) {
            $entries = $subpages;
        } elseif (isset($shelf)) {
            $entries = $shelf;
        } else {
            $entries = new Kirby\Cms\Pages([]); // Empty collection as fallback
        }
        $totalEntries = $entries->count();
        
        // Initialize grid positions
        $positions = [];
        $coords = array_fill(0, 10, 0);  // 5x2 grid = 10 positions
        
        foreach ($entries as $index => $entry) {
          $attempts = 0;
          do {
            $x = rand(0, 4);  // 5 columns (0,1,2,3,4)
            $y = rand(0, 1);  // 2 rows (0,1)
            $gridIndex = $y * 5 + $x;  // Convert to linear index
            $attempts++;
            
            // Prevent infinite loops
            if ($attempts > 100) {
              // Find first empty position
              for ($i = 0; $i < 10; $i++) {
                if ($coords[$i] == 0) {
                  $gridIndex = $i;
                  $x = $i % 5;
                  $y = floor($i / 5);
                  break;
                }
              }
              break;
            }
          } while ($coords[$gridIndex] != 0);
          
          $coords[$gridIndex] = 1;
          $positions[] = [
            'entry' => $entry,
            'x' => $x + 1,
            'y' => $y + 1
          ];
        }
        
        srand();  // Reset the random number generator
      ?>
      <?php foreach($positions as $position): ?>
        <li
          class="grid-block-container"
          style="
            --grid-area: <?= $position['y']; ?> / <?= $position['x']; ?>;
            --background-color: <?= $position['entry']->color(); ?>;
          "
        >
            <?php
            // First try to get cover image
            $image = null;
            if($coverImage = $position['entry']->cover()->toFile()) {
                $image = $coverImage;
            } 
            // If no cover image, try to get first image
            elseif($position['entry']->hasImages() && $firstImage = $position['entry']->images()->first()) {
                $image = $firstImage;
            }
            ?>

            <?php if($image): ?>
              <a href="<?= $position['entry']->url(); ?>" class="grid-block-image">
                <img src="<?= $image->url(); ?>" alt="<?= $position['entry']->title(); ?>">
              </a>
            <?php else: ?>
              <a href="<?= $position['entry']->url(); ?>" class="grid-block">
                <?= $position['entry']->title(); ?>
              </a>
            <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
</div>