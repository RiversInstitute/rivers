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
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('origin-title').addEventListener('click', (e) => {
      document.getElementById('origin-container').classList.toggle('expanded');
    });
  });
</script>
