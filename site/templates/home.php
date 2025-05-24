<?php snippet('header', ["headerClass" => "no-pad home__container"]); ?>
<?php snippet('nav', ['showMarquee' => false]); ?>
<div class="layout-wrapper--full home">
  <div class="home-blurb">
  </div>

  <!-- Ticker path -->
  <div class="home__ticker">
    <svg width="1244" height="483" viewBox="0 0 1244 483" xmlns="http://www.w3.org/2000/svg">
        <path id="path" d="M0 0.5H1229.5C1237.23 0.5 1243.5 6.76801 1243.5 14.5V143C1243.5 150.732 1237.23 157 1229.5 157H14.5C6.76801 157 0.5 163.268 0.5 171V286C0.5 293.732 6.76801 300 14.5 300H1229.5C1237.23 300 1243.5 306.268 1243.5 314V468C1243.5 475.732 1237.23 482 1229.5 482H14.5C6.76801 482 0.5 475.732 0.5 468V14.5C0.5 6.76801 6.76801 0.5 14.5 0.5H0Z" fill="none" stroke="black"/>
        <text>
            <textPath href="#path" id="marquee1" startOffset="0%" side="right">
                <?= $page->ticker_content(); ?>
            </textPath>
            <textPath href="#path" id="marquee2" startOffset="100%" side="right">
                <?= $page->ticker_content(); ?>
            </textPath>
        </text>
    </svg>
  </div>

  <div class="home__contents">
    <?php if ($page->ticker_url()->isNotEmpty()): ?>
        <a href="<?= $page->ticker_url(); ?>" class="home__ticker__url">
      <?php endif; ?>  

      <div class="home__ticker__url__text">
        <?= $page->ticker_url_text(); ?>
      </div>
    <?php if ($page->ticker_url()->isNotEmpty()): ?>
      </a>
    <?php endif; ?>

    <ul class="home__blocks">
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
        
        srand($timestamp);  // Use timestamp for seeding instead of directly using mktime
        $positions = [];
        $coords = array_fill(0, 6, 0);  // 3x2 grid = 6 positions
        
        // Get total number of entries
        $entries = $page->entries()->toStructure();
        $numEntries = $entries->count();
        
        // Safety check - limit entries to available grid spaces
        $numEntries = min($numEntries, 6);
        
        foreach($entries->limit($numEntries) as $idx=>$entry) {
          $attempts = 0;
          do {
            $x = rand(0, 2);  // 3 columns (0,1,2)
            $y = rand(0, 1);  // 2 rows (0,1)
            $index = $y * 3 + $x;  // Convert to linear index
            $attempts++;
            
            // Prevent infinite loops
            if ($attempts > 100) {
              // Find first empty position
              for ($i = 0; $i < 6; $i++) {
                if ($coords[$i] == 0) {
                  $index = $i;
                  $x = $i % 3;
                  $y = floor($i / 3);
                  break;
                }
              }
              break;
            }
          } while ($coords[$index] != 0);
          
          $coords[$index] = 1;
          array_push($positions, [$x+1, $y+1]);
        }
        srand();
      ?>
      <?php foreach($page->entries()->toStructure() as $idx=>$entry): ?>
        <li
          class="home__block__container"
          style="
            --text-color: <?= $entry->hover_color(); ?>;
            --background-color: <?= $entry->block_color(); ?>;
            --grid-area: <?= $positions[$idx][1]; ?> / <?= $positions[$idx][0]; ?>;
            "
          >
          <?php if($entry->links_to() == "page"): ?>
            <?php if($entry->url_link()->isNotEmpty()): ?>
              <a href="<?=$entry->url_link()->url(); ?>">
            <?php else: ?>
              <a href="">
            <?php endif; ?>
          <?php else: ?>
            <a href="<?=$entry->url_link(); ?>">
          <?php endif; ?>
            <div
              class="home__block"
              data-block-title="<?= $entry->title()->kt(); ?>"
              data-block-blurb="<?= $entry->blurb(); ?>"
              >
            </div>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<!-- Home overlay -->
<?php if($page->takeover()->toBool()): ?>
  <div class="home__takeover">
    <iframe 
      class="home__takeover__iframe"
      src="<?= $page->takeover_iframe_url(); ?>"
    >
    </iframe>
    <button onclick="closeTakeover()" class="home__takeover__close">Close</button>
  </div>
  <script>
    const closeTakeover = () => {
      document.querySelector('.home__takeover').classList.add('hidden');
    }

    setTimeout(() => {
      document.querySelector('.home__takeover__close').classList.add('active');
    }, 5000);
  </script>
<?php endif; ?>

<!-- <script src="/assets/js/typed.js"></script> -->

<!-- Ticker marquee -->
<script>
    const marquee1 = document.getElementById("marquee1");
    const marquee2 = document.getElementById("marquee2");
    const speed = 0.01;
    let offset = 0;
    let currentText = marquee1.textContent.trim();
    
    // Check if user prefers reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function updateFontSize() {
        const text = document.querySelector('text');
        const svg = document.querySelector('.home__ticker svg');
        const path = document.querySelector('.home__ticker path');
        const screenWidth = window.innerWidth;

        if (screenWidth <= 520) {
            svg.setAttribute('viewBox', '0 0 320 371');
            svg.setAttribute('width', '320');
            svg.setAttribute('height', '371');
            path.setAttribute('d', 'M319 106.935V15C319 7.26801 312.732 1 305 1H296.553H15C7.26801 1 1 7.26801 1 15V356C1 363.732 7.26802 370 15 370H305C312.732 370 319 363.732 319 356V244.523C319 236.791 312.732 230.523 305 230.523H91.9981C84.2661 230.523 77.9981 224.255 77.9981 216.523V134.935C77.9981 127.203 84.2661 120.935 91.9981 120.935H305C312.732 120.935 319 114.667 319 106.935Z');
            text.style.fontSize = '20px';
        } else {
            svg.setAttribute('viewBox', '0 0 1244 483');
            svg.setAttribute('width', '1244');
            svg.setAttribute('height', '483');
            path.setAttribute('d', 'M0 0.5H1229.5C1237.23 0.5 1243.5 6.76801 1243.5 14.5V143C1243.5 150.732 1237.23 157 1229.5 157H14.5C6.76801 157 0.5 163.268 0.5 171V286C0.5 293.732 6.76801 300 14.5 300H1229.5C1237.23 300 1243.5 306.268 1243.5 314V468C1243.5 475.732 1237.23 482 1229.5 482H14.5C6.76801 482 0.5 475.732 0.5 468V14.5C0.5 6.76801 6.76801 0.5 14.5 0.5H0Z');
            text.style.fontSize = screenWidth <= 1244 ? `${(1244 / screenWidth) * 26}px` : '26px';
        }
    }

    window.addEventListener('resize', updateFontSize);
    updateFontSize();

    function animateMarquee() {
        if (prefersReducedMotion) return;
        
        offset += speed;
        if (offset > 100) offset -= 100;

        marquee1.setAttribute("startOffset", `${offset}%`);
        marquee2.setAttribute("startOffset", `${offset - 100}%`);

        requestAnimationFrame(animateMarquee);
    }

    // Function to update ticker text
    function updateTickerText(newText) {
        currentText = newText;
        marquee1.textContent = newText;
        marquee2.textContent = newText;
    }

    animateMarquee();
</script>

<!-- Home blocks overlay -->
<script>
  const blocks = document.querySelectorAll('.home__block');
  const tickerText = document.querySelector('.home__ticker text');
  const htmlElement = document.documentElement;
  const navContainer = document.querySelector('.navigation__container');
  const homeBlurb = document.querySelector('.home-blurb');
  const originalText = marquee1.textContent.trim();

  blocks.forEach(block => {
    block.addEventListener('mouseenter', () => {
      tickerText.style.fill = '#fff';
      const blockColor = getComputedStyle(block.parentElement).getPropertyValue('--background-color');
      htmlElement.style.backgroundColor = blockColor;
      
      // Make other blocks transparent
      blocks.forEach(otherBlock => {
        if (otherBlock !== block) {
          otherBlock.style.opacity = '0';
        }
      });

      // Hide navigation
      navContainer.style.visibility = 'hidden';

      // Update ticker text
      const blockTitle = block.getAttribute('data-block-blurb');
      updateTickerText(blockTitle);

      // Update home-blurb with title
      homeBlurb.innerHTML = block.getAttribute('data-block-title');
    });
    
    block.addEventListener('mouseleave', () => {
      tickerText.style.fill = '#000';
      htmlElement.style.backgroundColor = '';
      
      // Reset opacity of all blocks
      blocks.forEach(otherBlock => {
        otherBlock.style.opacity = '';
      });

      // Show navigation
      navContainer.style.visibility = '';

      // Reset ticker text
      updateTickerText(originalText);

      // Clear home-blurb
      homeBlurb.innerHTML = '';

    });
  });
</script>


<?php snippet('footer'); ?>
