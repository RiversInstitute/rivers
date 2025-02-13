<div class="subsection__contents__wrapper">
    <ul class="subsection__blocks">
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
        $entries = $page->children()->limit(6);
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
        
        srand();  // Reset the random number generator
      ?>
      <?php foreach($positions as $position): ?>
        <li
          class="subsection__block__container"
          style="--grid-area: <?= $position['y']; ?> / <?= $position['x']; ?>;"
        >
            <a href="<?= $position['entry']->url(); ?>" class="subsection__block">
                <?= $position['entry']->title(); ?>
            </a>
        </li>
      <?php endforeach; ?>
    </ul>
</div>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Check if URL hash is #hide-back
    if (window.location.hash === '#hide-back') {
      // Find and hide the back container
      const backContainer = document.querySelector('.subsection__back__container');
      if (backContainer) {
        backContainer.style.display = 'none';
      }
    }
  });
</script>