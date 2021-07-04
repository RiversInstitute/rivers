<?php snippet('header', ["headerClass" => "no-pad home__container"]); ?>
<?php snippet('nav', ['showMarquee' => false]); ?>
<div class="layout-wrapper--full home">
  <div class="home__header">
    <a href="<?= $site->url(); ?>/about" class="home__site-title">
      <div class="site-title__text"><?= $site->full_title(); ?></div>
    </a>
    <div class="home__ticker-container">
      <div class="home__ticker text" id="typed-content">
        <?= $page->ticker_content()->kt(); ?>
      </div>
      <span id="typed-output"></span>
    </div>
    <div class="bibliography" id="bibliography">
      <div class="bibliography__header">
        <button id="bibliography__title" class="bibliography__header__button">Bibliography</button>
      </div>
      <ul class="bibliography__list">
        <?php foreach ($page->bibliography_item()->toStructure() as $bib): ?>
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
  <div class="home__contents">
    <ul class="home__blocks">
      <?php
        srand(mktime(0, 0, 0));
        $positions = [];
        $coords = array_fill(0, 18, 0);
        foreach($page->entries()->toStructure() as $idx=>$entry) {
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
              >
            </div>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<div class="home__overlay">
  <div class="overlay__heading text"></div>
  <img src="" class="overlay__image" loading="lazy">
</div>

<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
  window.addEventListener('load', () => {
    var typed = new Typed('#typed-output', {
      loop: true,
      typeSpeed: 40,
      fadeOut: true,
      showCursor: false,
      stringsElement: '#typed-content'
    });
  });
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('bibliography__title').addEventListener('click', (e) => {
      document.getElementById('bibliography').classList.toggle('expanded');
    });

    const homeBlocks = document.querySelectorAll('.home__block');
    const homeOverlay = document.querySelector('.home__overlay');
    const homeContents = document.querySelector('.home__contents');
    const homeOverlayImage = homeOverlay.querySelector('.overlay__image');
    const homeOverlayHeading = homeOverlay.querySelector('.overlay__heading');

    homeBlocks.forEach((el) => {
      el.addEventListener('mouseenter', (e) => {
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

        homeBlocks.forEach((block) => {
          if (block !== el) {
            block.style.visibility = 'hidden';
          }
        });
      });

      el.addEventListener('mouseleave', (e) => {
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
      });
    })
  });
</script>
<?php snippet('footer'); ?>
