<?php snippet('header', ['headerClass' => 'listing']); ?>
<?php snippet('nav'); ?>

<div class="layout-wrapper-two-columns">
  <!-- Main content -->
  <div class="listing__content" style="margin-top: 0;">
    <!-- Title -->
    <div class="listing__title highlight">
      <?= $page->title(); ?>
    </div>

    <!-- Content -->
    <div class="listing__content text">
      <?= $page->main_content()->kt(); ?>
    </div>

    <!-- Projects -->
    <div class="projects">

    </div>

    <!-- Image Viewer -->
    <div class="image__viewer" id="image-viewer">
      <?php if ($firstWork = $page->works()->toFiles()->first()) : ?>
        <figure class="image__viewer__item">
          <img src="<?= $firstWork->url(); ?>" alt="<?= $firstWork->alt(); ?>" />
          <figcaption>
            <?= $firstWork->caption(); ?>
          </figcaption>
        </figure>
      <?php endif; ?>
    </div>

    <br><br>

    <!-- Epherma -->
    <h3 class="listing__header">Epherma</h3>

    <div class="listing__blocks epherma">
      <?php foreach ($page->epherma()->toFiles() as $item) : ?>
        <a href="<?= $item->url()?>" class="listing__block">
            <?= $item->name() . '.' . $item->extension(); ?>
        </a>
      <?php endforeach ?>
    </div>
  </div>

  <!-- Sidebar -->
  <aside class="listing__sidebar">

    <!-- Works -->
    <h3 class="listing__header" style="margin-top: 0;">Works</h3>

    <div class="works__list">
      <?php foreach ($page->works()->toFiles() as $index => $work) : ?>
        <figure class="works__list__item" data-index="<?= $index ?>" data-url="<?= $work->url() ?>" data-alt="<?= $work->alt() ?>" data-caption="<?= $work->caption() ?>">
          <img src="<?= $work->url(); ?>" alt="<?= $work->alt(); ?>" />
        </figure>
      <?php endforeach; ?>
    </div>

    <br><br>

    <!-- Part of -->
    <h3 class="listing__header">Part of</h3>

    <div class="part-of">
      <a href="">
        <span class="part-of-symbol" style="background-color: #83B000;"></span>
        Public Programs
      </a>
      <a href="">
        <span class="part-of-symbol" style="background-color: #FF6253;"></span>
        Residency
      </a>
    </div>

    <br><br><br>

    <!-- Footnotes -->
    <span class="footnotes-symbol"></span>
    <h3 class="listing__header" style="margin-top: 5px;">Footnotes</h3>

    <div class="footnotes">
      <?php foreach ($page->footnotes()->toStructure() as $footnote) : ?>
        <div class="footnote">
          <?= $footnote->text()->kt(); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </aside>
</div>

<?php snippet('footer'); ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const workItems = document.querySelectorAll('.works__list__item');
    const imageViewer = document.querySelector('.image__viewer');
    
    if (workItems.length > 0 && imageViewer) {
      workItems.forEach(item => {
        item.addEventListener('click', function() {
          const url = this.getAttribute('data-url');
          const alt = this.getAttribute('data-alt');
          const caption = this.getAttribute('data-caption');
          
          // Update the image viewer
          imageViewer.innerHTML = `
            <figure class="image__viewer__item">
              <img src="${url}" alt="${alt}" />
              <figcaption>${caption}</figcaption>
            </figure>
          `;
          
          // Add active class to the clicked item and remove from others
          workItems.forEach(w => w.classList.remove('active'));
          this.classList.add('active');
          
          // Scroll to the image viewer with smooth behavior
          imageViewer.scrollIntoView({ 
            block: 'start' 
          });
        });
      });
      
      // Set the first item as active by default
      workItems[0].classList.add('active');
    }
  });
</script>
