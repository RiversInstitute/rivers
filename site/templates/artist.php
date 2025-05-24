<?php snippet('header', ['headerClass' => 'listing']); ?>
<?php snippet('nav'); ?>

<div class="layout-wrapper-two-columns">
  <!-- Main content -->
  <div class="listing__content" style="margin-top: 0;">
    <!-- Title -->
    <div class="listing__title highlight">
      <a href="<?= $page->parent()->url(); ?>"><?= $page->parent()->title(); ?></a> / <?= $page->title(); ?>
    </div>

    <!-- Content -->
    <div class="listing__content text">
      <?= $page->main_content()->kt(); ?>
    </div>

    <!-- Image Viewer -->
    <div class="image__viewer" id="image-viewer">
      <?php if ($firstWork = $page->works()->toFiles()->first()) : ?>
        <figure class="image__viewer__item">
          <img src="<?= $firstWork->url(); ?>" alt="<?= $firstWork->alt(); ?>" />
          <figcaption>
            <?= $firstWork->caption()->kt(); ?>
          </figcaption>
        </figure>
      <?php endif; ?>
    </div>

    <br><br>

    <!-- Projects -->
    <?php if ($page->part_of()->toPages()->count() > 0) : ?>
    <h3 class="listing__header">Exhibitions & Projects</h3>

    <div class="listing__blocks projects" id="projects">
      <?php 
      // Get all pages from the part_of field
      $projects = $page->part_of()->toPages();
      
      foreach($projects as $project): 
        // Get the parent ID for filtering
        $parentId = $project->parent() ? $project->parent()->id() : '';
      ?>
        <a href="<?= $project->url() ?>" class="listing__block" data-parent="<?= $parentId ?>" style="--hover-color: <?= $project->parent()->color() ?>">
          <?= $project->title() ?>
        </a>
      <?php endforeach ?>
    </div>

    <br><br>
    <?php endif; ?>

    <!-- Epherma -->
    <?php if ($page->epherma()->toFiles()->count() > 0) : ?>
    <h3 class="listing__header">Epherma</h3>

    <div class="listing__blocks epherma">
      <?php foreach ($page->epherma()->toFiles() as $item) : ?>
        <a href="<?= $item->url()?>" class="listing__block">
            <?= $item->name() . '.' . $item->extension(); ?>
        </a>
      <?php endforeach ?>
    </div>
    <?php endif; ?>
  </div>

  <!-- Sidebar -->
  <aside class="listing__sidebar">

    <!-- Works -->
    <?php if ($page->works()->toFiles()->count() > 0) : ?>
    <h3 class="listing__header" style="margin-top: 0;">Works</h3>

    <div class="works__list">
      <?php foreach ($page->works()->toFiles() as $index => $work) : ?>
        <figure class="works__list__item" data-index="<?= $index ?>" data-url="<?= $work->url() ?>" data-alt="<?= $work->alt() ?>" data-caption="<?= $work->caption()->kt() ?>">
          <img src="<?= $work->url(); ?>" alt="<?= $work->alt(); ?>" />
        </figure>
      <?php endforeach; ?>
    </div>

    <br><br>
    <?php endif; ?>

    <!-- Part of -->
    <?php if ($page->part_of()->toPages()->count() > 0) : ?>
    <h3 class="listing__header">Part of</h3>

    <div class="part-of">
      <?php 
      // Get all pages from the part_of field
      $partOfPages = $page->part_of()->toPages();
      
      // Create an array to store unique parent pages
      $parentPages = [];
      
      // Get parent pages and remove duplicates
      foreach($partOfPages as $partOfPage) {
        if($parent = $partOfPage->parent()) {
          $parentId = $parent->id();
          if(!isset($parentPages[$parentId])) {
            $parentPages[$parentId] = $parent;
          }
        }
      }
      
      // Display each unique parent page
      foreach($parentPages as $parentId => $parentPage): 
        // Get the color from the parent page
        $color = $parentPage->color()->isNotEmpty() ? $parentPage->color()->value() : '#cccccc'; // Default to gray if no color is set
      ?>
        <div class="filter-toggle" data-parent="<?= $parentId ?>">
          <span class="part-of-symbol" style="background-color: <?= $color ?>;"></span>
          <span class="part-of-title"><?= $parentPage->title() ?></span>
        </div>
      <?php endforeach; ?>
    </div>

    <br><br><br>
    <?php endif; ?>

    <!-- Footnotes -->
    <?php if ($page->footnotes()->toStructure()->count() > 0) : ?>
      <span class="footnotes-symbol"></span>
      <h3 class="listing__header" style="margin-top: 5px;">Footnotes</h3>

      <div class="footnotes">
      <?php foreach ($page->footnotes()->toStructure() as $footnote) : ?>
        <div class="footnote">
          <?= $footnote->text()->kt(); ?>
        </div>
      <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </aside>
</div>

<?php snippet('footer'); ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Works image viewer functionality
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

    // Projects filtering functionality
    const filterToggles = document.querySelectorAll('.filter-toggle');
    const projectsContainer = document.querySelector('.listing__blocks.projects');
    const projectItems = document.querySelectorAll('.listing__blocks.projects .listing__block');
    
    filterToggles.forEach(toggle => {
      toggle.addEventListener('click', function() {
        const parentId = this.getAttribute('data-parent');
        const wasActive = this.classList.contains('active');
        
        // Remove active class from all filters first
        filterToggles.forEach(t => t.classList.remove('active'));
        
        // If the clicked filter wasn't already active, make it active
        if (!wasActive) {
          this.classList.add('active');
        }
        
        // Check if any filters are active
        const activeFilters = document.querySelectorAll('.filter-toggle.active');
        
        if (activeFilters.length > 0) {
          // Add filtering class to container
          projectsContainer.classList.add('filtering');
          
          // Show only projects matching active filters
          projectItems.forEach(item => {
            let shouldShow = false;
            
            // Check if this project matches any active filter
            activeFilters.forEach(filter => {
              if (item.getAttribute('data-parent') === filter.getAttribute('data-parent')) {
                shouldShow = true;
              }
            });
            
            if (shouldShow) {
              item.classList.add('active');
            } else {
              item.classList.remove('active');
            }
          });
        } else {
          // If no filters are active, remove filtering
          projectsContainer.classList.remove('filtering');
          projectItems.forEach(item => {
            item.classList.remove('active');
          });
        }
        
        // Scroll to the projects section
        document.getElementById('projects').scrollIntoView({ 
          behavior: 'smooth',
          block: 'start'
        });
      });
    });
  });
</script>
