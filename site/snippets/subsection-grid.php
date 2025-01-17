

<div class="subsection__contents__wrapper">
    <div class="subsection__contents">
        <div class="subsection__back__container">
            <a href="<?= $site->url(); ?>" class="subsection__back">Back</a>
        </div>
        <ul class="subsection__blocks">
          <?php foreach($subpages as $subpage): ?>
            <li class="subsection__block__container">
              <a href="<?= $subpage->url(); ?>">
                <div class="subsection__block" style="--outline-color: <?= $subpage->color(); ?>">
                  <?= $subpage->title(); ?>
                </div>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
</div>

<script>
  // Check if URL hash is #hide-back
  if (window.location.hash === '#hide-back') {
    // Find and hide the back container
    document.querySelector('.subsection__back__container').style.display = 'none';
  }
</script>