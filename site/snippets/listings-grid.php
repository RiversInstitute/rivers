<ul class="listings">
  <?php foreach ($listings as $listing): ?>
    <li class="listings__item">
      <a href="<?= $listing->url(); ?>">
        <?php if($listing->hero_image()->isNotEmpty()): ?>
          <img class="listing__hero" loading="lazy" src="<?= $listing->hero_image()->toFile()->resize(500)->url(); ?>">
        <?php endif; ?>
        <div class="listing__title">
          <?= $listing->title(); ?>
        </div>
        <div class="listing__date-time">
          <?php snippet('date-time', ['happening' => $listing]); ?>
        </div>
        <div class="listing__preview text">
          <?= $listing->preview()->kt(); ?>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
</ul>