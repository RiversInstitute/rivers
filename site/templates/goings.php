<?php snippet('header', ['headerClass' => 'height-limited']); ?>
<?php snippet('nav'); ?>

<?php $shelf = [] ?>

<div class="subsection-nav-wrapper">
    <div class="subsection-nav">
        <?php $shelf = $page->children()->listed() ?>
        <?php snippet('subsection-grid-six', ['grid_items' => $shelf, 'nav' => true, 'images' => false]); ?>
    </div>

    <div class="back-to-top">
        <a href="<?= $page->url() ?>">
            Back to <?= $page->title() ?>
        </a>
    </div>

    <div class="subsection-blurb">
        <?= $page->blurb()->kt() ?>
    </div>

    <?php foreach($page->children()->listed() as $subpage): ?>
    <div class="subsection" id="<?= $subpage->slug() ?>">

        <?php $sub_shelf = $subpage->shelf()->toPages() ?>


        <div class="subsection-index-container">
            <h2 class="subsection-index-title"><?= $subpage->title() ?></h2>
            
            <div class="subsection-index">
                <?php foreach($subpage->children()->listed()->sortBy('start_date', 'desc') as $item): ?>
                    <div class="subsection-index-item">
                        <div class="subsection-index-item-content">
                            <a href="<?= $item->url() ?>">
                                <?php
                                // First try to get cover image
                                $image = null;
                                if($coverImage = $item->hero_image()->toFile()) {
                                    $image = $coverImage;
                                } 
                                // If no cover image, try to get first image
                                elseif($item->hasImages() && $firstImage = $item->images()->first()) {
                                    $image = $firstImage;
                                }
                                
                                if($image): ?>
                                    <figure>
                                        <img src="<?= $image->url() ?>" alt="<?= $item->title() ?>">
                                    </figure>
                                <?php endif; ?>
                                <h3 class="subsection-index-item-title"><?= $item->title() ?></h3>
                            </a>
                            <div class="subsection-index-item-preview">
                                <?php if($item->preview()->isNotEmpty()): ?>
                                <?= $item->preview()->kt()->excerpt(200) ?>
                                <?php elseif($item->main_content()->isNotEmpty()): ?>
                                <?= $item->main_content()->kt()->excerpt(200) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <?php endforeach ?>

    <br><br><br><br><br><br><br><br>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
  const subsectionNav = document.querySelector('.subsection-nav');
  const backToTop = document.querySelector('.back-to-top');
  
  // Initially hide the back to top button
  backToTop.style.display = 'none';
  
  // Create an Intersection Observer
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      // When subsection-nav is not in viewport, show the back to top button
      if (!entry.isIntersecting) {
        backToTop.style.display = 'block';
      } else {
        backToTop.style.display = 'none';
      }
    });
  }, {
    threshold: 0.1 // Trigger when at least 10% of the element is visible
  });
  
  // Start observing the subsection-nav
  observer.observe(subsectionNav);
});
</script>


<?php snippet('footer'); ?>
