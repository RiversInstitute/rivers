<div class="layout-wrapper--full season--origin">
  <div class="origin__header">
    <div class="origin__site-title">
      <a href="<?= $site->url(); ?>"><?= $site->full_title(); ?></a>
    </div>
    <div class="origin__definition-container expanded" id="origin-container">
      <div class="origin__title" id="origin-title">
        <?= $season->main_content_title(); ?>
      </div>
      <div class="origin__definition text">
        <?= $season->main_content_body()->kt(); ?>
      </div>
    </div>
  </div>
  <div class="origin__contents">
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

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('origin-title').addEventListener('click', (e) => {
      document.getElementById('origin-container').classList.toggle('expanded');
    });
  });
</script>

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