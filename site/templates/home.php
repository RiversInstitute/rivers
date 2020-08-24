<?php snippet('header'); ?>
<?php snippet('nav'); ?>

<div class="layout-wrapper--full">

  <div class="season">

      <div class="season__title" onclick="openorcloseBody()">
        <?= $page->main_content_title()->kt(); ?>
      </div>

      <div class="season__body" id="season_text">
        <?= $page->main_content_body()->kt(); ?>
    </div>

  </div>

  <div class="bibliography">

      <div class="bibliography__header">
        <div id="bibliography_title" onclick="openNav()">Bibliography</div>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" >&times;</a>
      </div>

      <!-- <div id="bibliography_info"> -->
          <ul class="bibliography__list">
            <?php foreach ($page->bibliography_item()->toStructure() as $bib): ?>
                <li class="bibliography__item">
                  <?= $bib->citation()->kt(); ?>
                </li>
            <?php endforeach ?>
          </ul>
     <!-- </div> -->

  </div>

</div>

  <div class="event-ticker">
    <ul class="ticker__list">
      <?php
        $listings = $site->index()->listed()->filterBy('template','event')->filterBy('highlight_on_index', 'true')->filter(function ($item) { return $item->start_date()->toDate() > time(); })->sortBy('start_date','desc');
      ?>
      <?php foreach($listings as $listing):?>
        <li class="ticker__item">
          <a href="<?= $listing->url(); ?>"><?= $listing->index_copy(); ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

<script>
  document.addEventListener('DOMContentLoaded', (e) => {
    initTicker(document.querySelector('.event-ticker .ticker__list'));
  });

  const initTicker = (ticker) => {
    const tickerW = -1 * ticker.scrollWidth - 100;
    ticker.style.setProperty('--ticker-width', `${tickerW}px`);
    ticker.style.setProperty('animation-name', 'marquee');
  };

  function openorcloseBody() {

    if (document.getElementById("season_text").style.visibility == "visible") {
      document.getElementById("season_text").style.visibility = "hidden";
    }
    else {
    document.getElementById("season_text").style.visibility = "visible";
    }
  };

  let openBtn = document.querySelector("#bibliography_title");
  openBtn.addEventListener("click", () => {
    showBib();

  });
  let closeBtn = document.querySelector(".closebtn");
  closeBtn.addEventListener("click", () => {
     hideBib();
  });

  function showBib() {
     document.querySelector(".bibliography__list").style.visibility = "visible";
     document.querySelector(".closebtn").style.visibility = "visible";
    document.querySelector(".bibliography__header").style.justifyContent = "space-between";
  };

  function hideBib() {
     document.querySelector(".bibliography__list").style.visibility = "hidden";
     document.querySelector(".closebtn").style.visibility = "hidden";
     document.querySelector(".bibliography__header").style.justifyContent = "flex-end";
   };

</script>

<?php snippet('footer'); ?>
</div>
