<?php snippet('header', ['headerClass' => 'weber-payton']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>
  <div class="weber-payton__bio-credits">
    <div class="layout-wrapper">
      <div class="bio text">
        <?= $page->bio_credits()->kt(); ?>
      </div>
    </div>
  </div>
  
  <div class="weber-payton__wrapper">
    <div class="weber-payton__intro">
      <div class="weber-payton__intro__title text"><?= $page->introduction_title()->kt(); ?></div>
      <div class="weber-payton__intro__content text"><?= $page->introduction()->kt(); ?></div>
    </div>
    <div class="weber-payton__main">
      <div class="weber-payton__main__title text"><?= $page->main_title()->kt(); ?></div>
      <div class="weber-payton__main__content text"><?= $page->main_content()->kt(); ?></div>
    </div>
    <div class="weber-payton__histories">
      <ul class="weber-payton__histories__list">
        <?php foreach($page->oral_histories()->toStructure() as $history): ?>
          <li class="weber-payton__histories__list__item">
            <div class="weber-payton__histories__list__item__title text">
              <b><?= $history->title(); ?></b>
              <br>
              <?= $history->subtitle(); ?>
            </div>
            <div class="weber-payton__histories__list__item__content">
              <div class="weber-payton__histories__list__item__content__item">
                <a href="<?= $history->main_image()->toFile()->resize(2000)->url(); ?>">
                  <img
                    src="<?= $history->main_image()->toFile()->resize(1024)->url(); ?>"
                  />
                </a>
                <div class="text">
                  <?= $history->main_image_caption()->kt(); ?>
                </div>
              </div>
              <div class="weber-payton__histories__list__item__content__item">
                <audio controls>
                  <source src="<?= $history->audio_file()->toFile()->url(); ?>" type="<?= $history->audio_file()->toFile()->mime(); ?>">
                </audio>
                <div class="text">
                  <?= $history->audio_caption()->kt(); ?>
                </div>
              </div>
              <div class="weber-payton__histories__list__item__content__item">
                <a href="<?= $history->pdf_file()->toFile()->url(); ?>">
                  <img
                    src="<?= $history->pdf_image()->toFile()->resize(1024)->url(); ?>"
                  />
                </a>
                <div class="text">
                  <?= $history->pdf_caption()->kt(); ?>
                </div>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
<?php snippet('footer'); ?>

<script>
  document.querySelector('#nav-about').addEventListener('click', () => {
    document.querySelector('.weber-payton__bio-credits').classList.toggle('active');
      });
</script>