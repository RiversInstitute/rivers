<div class="event-ticker">
  <ul class="ticker__list">
    <?php
      $listings = $site->index()
        ->listed()
        ->filterBy('template','event')
        ->filterBy('highlight_on_index', 'true')
        ->filter(function ($item) { 
          $date = $item->start_date();
          if ($item->end_date()->isNotEmpty()) {
            $date = $item->end_date();
          }
          return $date->toDate() > time(); 
          })
        ->sortBy('start_date','desc');
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
  }
</script>