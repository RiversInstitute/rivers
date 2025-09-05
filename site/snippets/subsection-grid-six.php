<div class="grid-six-container">
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

        $color = isset($color) ? $color : '#f0f0f0';
        
        // Seed the random number generator with the timestamp
        srand($timestamp);
        
        // Get entries and limit to 6
        $entries = $grid_items;
        $totalEntries = $entries->count();
        
        // Initialize grid positions
        $positions = [];
        $coords = array_fill(0, 6, 0);  // 3x2 grid = 6 positions
        
        foreach ($entries as $index => $entry) {
          $attempts = 0;
          do {
            $x = rand(0, 2);  // 3 columns (0,1,2)
            $y = rand(0, 1);  // 2 rows (0,1)
            $gridIndex = $y * 3 + $x;  // Convert to linear index
            $attempts++;
            
            // Prevent infinite loops
            if ($attempts > 100) {
              // Find first empty position
              for ($i = 0; $i < 6; $i++) {
                if ($coords[$i] == 0) {
                  $gridIndex = $i;
                  $x = $i % 3;
                  $y = floor($i / 3);
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
        
        // Fill in empty positions with placeholder blocks
        for ($i = 0; $i < 6; $i++) {
          if ($coords[$i] == 0) {
            $x = $i % 3;
            $y = floor($i / 3);
            $positions[] = [
              'entry' => null,
              'x' => $x + 1,
              'y' => $y + 1,
              'is_placeholder' => true
            ];
          }
        }
        
        srand();  // Reset the random number generator
        
        // Check if images parameter is set
        $showImages = isset($images) ? $images : false;

        // Check if nav parameter is set
        $showNav = isset($nav) ? $nav : false;
        
        // Default placeholder color
        $placeholderColor = isset($placeholderColor) ? $placeholderColor : '#fff';
      ?>
      <?php foreach($positions as $position): ?>
        <li
          class="grid-block-container <?= $showImages ? 'grid-block-container-image' : ''; ?> <?= isset($position['is_placeholder']) ? 'grid-block-placeholder' : ''; ?>"
          style="
            --grid-area: <?= $position['y']; ?> / <?= $position['x']; ?>;
            --section-color: <?= isset($position['is_placeholder']) ? $placeholderColor : $position['entry']->color(); ?>;
          "
        >
            <?php if(isset($position['is_placeholder'])): ?>
              <div class="grid-block">
                <!-- Empty placeholder block -->
              </div>
            <?php else: ?>
              <?php
              // First try to get cover image
              $image = null;
              if($coverImage = $position['entry']->hero_image()->toFile()) {
                  $image = $coverImage;
              } 
              // If no cover image, try to get first image
              elseif($position['entry']->hasImages() && $firstImage = $position['entry']->images()->first()) {
                  $image = $firstImage;
              }
              ?>

              <?php if($showImages && $image): ?>
                <a href="<?= $showNav ? '#' . $position['entry']->slug() : $position['entry']->url(); ?>" class="grid-block-image" style="background-color: <?= $color; ?>">
                  <div class="grid-block-text">
                    <?= $position['entry']->title(); ?>
                  </div>
                  <img src="<?= $image->url(); ?>" alt="<?= $position['entry']->title(); ?>" loading="lazy">
                </a>
              <?php else: ?>
                <a href="<?= $showNav ? '#' . $position['entry']->slug() : $position['entry']->url(); ?>" class="grid-block">
                  <?= $position['entry']->title(); ?>
                </a>
              <?php endif; ?>
            <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
</div>