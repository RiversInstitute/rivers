<div class="layout-wrapper--full season--origin">
  <div class="origin__header">
    <a href="<?= $site->url(); ?>" class="origin__site-title">
      <div class="site-title__text"><?= $site->full_title(); ?></div>
      <div class="site-title__logo"><?php snippet('rivers_r') ?></div>
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
      <?php foreach($season->entries()->toStructure() as $entry): ?>
        <li class="origin__block__container" style="--background-color: <?= $entry->block_color(); ?>">
          <a href="<?=$entry->season_block()->toPage()->url(); ?>">
            <div class="origin__block">
              <div class="text">
                <!-- <?= $entry->title()->kt(); ?> -->
              </div>
            </div>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
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
    originBlocks.forEach((el) => {
      el.addEventListener('mouseenter', (e) => {
        const bgColor = getComputedStyle(el).backgroundColor;
        document.body.style.backgroundColor = bgColor;
        originBlocks.forEach((block) => {
          if (block !== el) {
            block.style.visibility = 'hidden';
          }
        });
      });

      el.addEventListener('mouseleave', (e) => {
        document.body.style.removeProperty('background-color');
        originBlocks.forEach((block) => {
          if (block !== el) {
            block.style.removeProperty('visibility');
          }
        });
      });
    })
  });
</script>
