<div class="layout-wrapper--full season--origin">
  <div class="origin__header">
    <a href="<?= $site->url(); ?>/about" class="origin__site-title">
      <div class="site-title__text"><?= $site->full_title(); ?></div>
      <!-- <div class="site-title__logo"><?php snippet('rivers_r') ?></div> -->
    </a>
    <div class="origin__definition-container expanded" id="origin-container">
      <div class="origin__title" id="origin-title">
        <?= $season->main_content_title(); ?>
      </div>
      <div class="origin__definition text">
        <?= $season->main_content_body()->kt(); ?>
      </div>
    </div>
    <div class="bibliography" id="bibliography">
      <div class="bibliography__header">
        <button id="bibliography__title" class="bibliography__header__button">Bibliography</button>
      </div>
      <ul class="bibliography__list">
        <?php foreach ($season->bibliography_item()->toStructure() as $bib): ?>
          <li class="bibliography__item">
            <div class="text">
              <?= $bib->citation()->kt(); ?>
            </div>
            <div class="bibliography__item__embed">
              <?= $bib->embed(); ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="origin__contents">
    <ul class="origin__blocks">
      <?php
        srand(mktime(0, 0, 0));
        $positions = [];
        $coords = array_fill(0, 18, 0);
        foreach($season->entries()->toStructure() as $idx=>$entry) {
          $x = rand(0, 5);
          $y = rand(0, 2);
          while ($coords[$x*$y] != 0) {
            $x = rand(0,5);
            $y = rand(0,2);
          }
          $coords[$x*$y] = 1;
          array_push($positions, [$x+1, $y+1]);
        }
        srand();
      ?>
      <?php foreach($season->entries()->toStructure() as $idx=>$entry): ?>
        <li
          class="origin__block__container"
          style="
            --background-color: <?= $entry->block_color(); ?>;
            --grid-area: <?= $positions[$idx][1]; ?> / <?= $positions[$idx][0]; ?>;
            "
          >
          <a href="<?=$entry->season_block()->toPage()->url(); ?>">
            <div
              class="origin__block"
              data-hero-src="<?= $entry->hero_image()->isNotEmpty() ? $entry->hero_image()->toFile()->url() : ''; ?>"
              data-block-title="<?= $entry->title()->kt(); ?>"
              >
            </div>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<div class="origin__overlay">
  <div class="overlay__heading text"></div>
  <img src="" class="overlay__image" loading="lazy">
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('origin-title').addEventListener('click', (e) => {
      document.getElementById('origin-container').classList.toggle('expanded');
    });

    document.getElementById('bibliography__title').addEventListener('click', (e) => {
      document.getElementById('bibliography').classList.toggle('expanded');
    });

    const originBlocks = document.querySelectorAll('.origin__block');
    const originOverlay = document.querySelector('.origin__overlay');
    const originContents = document.querySelector('.origin__contents');
    const originOverlayImage = originOverlay.querySelector('.overlay__image');
    const originOverlayHeading = originOverlay.querySelector('.overlay__heading');

    originBlocks.forEach((el) => {
      el.addEventListener('mouseenter', (e) => {
        originContents.classList.add('active');

        const bgColor = getComputedStyle(el).backgroundColor;
        originOverlay.style.backgroundColor = bgColor;
        if (el.dataset.heroSrc.length > 0) {
          originOverlayImage.src = el.dataset.heroSrc;
          originOverlayImage.classList.add('active');
        }
        originOverlayHeading.innerHTML = el.dataset.blockTitle;
        originOverlay.classList.add('active');

        originBlocks.forEach((block) => {
          if (block !== el) {
            block.style.visibility = 'hidden';
          }
        });
      });

      el.addEventListener('mouseleave', (e) => {
        originContents.classList.remove('active');

        originOverlay.style.removeProperty('background-color');
        originOverlay.classList.remove('active');
        originOverlayImage.classList.remove('active');

        originBlocks.forEach((block) => {
          if (block !== el) {
            block.style.removeProperty('visibility');
          }
        });
      });
    })
  });
</script>
