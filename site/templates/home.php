<?php snippet('header', ["headerClass" => "no-pad home__container"]); ?>
<?php snippet('nav', ['showMarquee' => false]); ?>
<div class="layout-wrapper--full home">
  <!-- <div class="home__header">
    <a href="<?= $site->url(); ?>/about" class="home__site-title">
      <div class="site-title__text"><?= $site->full_title(); ?></div>
    </a>
  </div> -->

  <div class="home__ticker">
      <svg width="1244" height="483" viewBox="0 0 1244 483" xmlns="http://www.w3.org/2000/svg">
          <path id="path" d="M0.5 0.5H1205H1229.5C1237.23 0.5 1243.5 6.76801 1243.5 14.5V143C1243.5 150.732 1237.23 157 1229.5 157H14.5C6.76801 157 0.5 163.268 0.5 171V286C0.5 293.732 6.76801 300 14.5 300H1229.5C1237.23 300 1243.5 306.268 1243.5 314V468C1243.5 475.732 1237.23 482 1229.5 482H0.5" fill="none" stroke="black"/>
          <text>
              <textPath href="#path" id="marquee1" startOffset="0%">
                  Rivers Institute for Contemporary Art & Thought (Rivers) is a non-profit institute for research and publishing, exhibitions and convenings on art of the global diaspora.
              </textPath>
              <textPath href="#path" id="marquee2" startOffset="100%">
                  Rivers Institute for Contemporary Art & Thought (Rivers) is a non-profit institute for research and publishing, exhibitions and convenings on art of the global diaspora.
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
        srand(mktime(0, 0, 0));
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
            <a href="<?=$entry->page_link()->toPage()->url(); ?>">
          <?php else: ?>
            <a href="<?=$entry->url_link(); ?>">
          <?php endif; ?>
            <div
              class="home__block"
              data-hero-src="<?= $entry->hero_image()->isNotEmpty() ? $entry->hero_image()->toFile()->url() : ''; ?>"
              data-block-title="<?= $entry->title()->kt(); ?>"
              data-block-title-clean="<?= $entry->title(); ?>"
              >
            </div>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<!-- Home overlay -->
<div class="home__overlay">
  <div class="overlay__heading text"></div>
  <div id="home__blocks__overlay__container">
      <ul class="home__blocks__overlay" style="pointer-events: auto;">
      </ul>
  </div>
  <img src="" class="overlay__image" loading="lazy">
</div>
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

<script src="/assets/js/typed.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    var typed = new Typed('#typed-output', {
      loop: true,
      typeSpeed: 40,
      fadeOut: true,
      showCursor: false,
      stringsElement: '#typed-content'
    });
  });
  document.addEventListener('DOMContentLoaded', () => {
    const homeBlocks = document.querySelectorAll('.home__block');
    const homeOverlay = document.querySelector('.home__overlay');
    const homeContents = document.querySelector('.home__contents');
    const homeOverlayImage = homeOverlay.querySelector('.overlay__image');
    const homeOverlayHeading = homeOverlay.querySelector('.overlay__heading');
    const homeOverlayBlocks = homeOverlay.querySelector('.home__blocks__overlay');
    const defaultTickerText = document.querySelector('#marquee1').innerHTML;
    const homeTickerTexts = document.querySelectorAll('#marquee1, #marquee2');

    homeBlocks.forEach((el) => {
      el.addEventListener('mouseenter', (e) => {
        // Copy the parent li element to the overlay
        const liElement = el.closest('.home__block__container');
        const liClone = liElement.cloneNode(true);
        liClone.querySelector('.home__block').style.backgroundColor = 'var(--text-color)';
        homeOverlayBlocks.appendChild(liClone);

        homeContents.classList.add('active');

        const bgColor = getComputedStyle(el).backgroundColor;
        homeOverlay.style.backgroundColor = bgColor;

        const textColor = getComputedStyle(el).color;
        homeOverlay.style.color = textColor;

        if (el.dataset.heroSrc.length > 0) {
          homeOverlayImage.src = el.dataset.heroSrc;
          homeOverlayImage.classList.add('active');
        }
        homeOverlayHeading.innerHTML = el.dataset.blockTitle;
        homeOverlay.classList.add('active');

        // Set the ticker text to the block title
        homeTickerTexts.forEach((text) => {
          text.textContent = el.dataset.blockTitleClean + ' – What I want to do is code-switch. To have there be layers of history and politics, but also this heady, arty stuff—inside jokes...';
          text.style.fill = 'white';
        });
        
        console.log(el.dataset.blockTitleClean);

        homeBlocks.forEach((block) => {
          if (block !== el) {
            block.style.visibility = 'hidden';
          }
        });
      });

      el.addEventListener('mouseleave', (e) => {
        
        // Pause on hover for debugging
        // debugger;

        // Remove all li elements from overlay
        while (homeOverlayBlocks.firstChild) {
          homeOverlayBlocks.removeChild(homeOverlayBlocks.firstChild);
        }

        homeContents.classList.remove('active');

        homeOverlay.style.removeProperty('background-color');
        homeOverlay.style.removeProperty('color');
        homeOverlay.classList.remove('active');
        homeOverlayImage.classList.remove('active');

        homeBlocks.forEach((block) => {
          if (block !== el) {
            block.style.removeProperty('visibility');
          }
        });

        // Reset the ticker text to the previous text
        homeTickerTexts.forEach((text) => {
          text.innerHTML = defaultTickerText;
          text.style.fill = 'black';
        });

      });
    })
  });
</script>


<script>
        // JavaScript to animate the startOffset for perfect looping
        const marquee1 = document.getElementById("marquee1");
        const marquee2 = document.getElementById("marquee2");
        let offset = 0;

        // Make font size larger as the screen gets smaller
        function updateFontSize() {
            const text = document.querySelector('text');
            const screenWidth = window.innerWidth;
            if (screenWidth <= 1244) {
                text.style.fontSize = `${(1244 / screenWidth) * 26}px`;
            } else {
                text.style.fontSize = '26px';
            }
        }

        window.addEventListener('resize', updateFontSize);
        updateFontSize(); // Initial call

        function animateMarquee() {
            offset += 0.01; // Adjust speed here
            if (offset > 100) offset = 0; // Reset when the first text completes a cycle

            marquee1.setAttribute("startOffset", `${offset}%`);
            marquee2.setAttribute("startOffset", `${offset - 100}%`); // Second text follows the first

            requestAnimationFrame(animateMarquee);
        }

        animateMarquee();
</script>


<?php snippet('footer'); ?>
