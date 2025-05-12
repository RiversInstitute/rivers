<?php snippet('header', ['headerClass' => 'height-limited']); ?>
<?php snippet('nav'); ?>
<div class="subsection-nav-wrapper">
    <div class="subsection-nav" style="height: 80dvh;">
        <?php snippet('subsection-grid-six', ['grid_items' => $page->shelf()->toPages(), 'nav' => false, 'images' => true, 'color' => $page->color()]); ?>
    </div>

    <div class="subsection-blurb">
        <?= $page->blurb()->kt() ?>
    </div>

    <div class="subsection-index-container">
        <h2 class="subsection-index-title">All artists</h2>
        
        <div class="subsection-index">
            <?php foreach($page->children()->listed()->sortBy() as $item): ?>
                <div class="subsection-index-item">
                    <div class="tiny-square" style="--tiny-square-color: <?= $item->color() ?>;"></div>
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
                            <?= $item->title() ?>
                        </a>
                        <div class="subsection-index-item-preview">
                            <?php if($item->preview()->isNotEmpty()): ?>
                                <?= $item->preview()->kt()->excerpt(300) ?>
                            <?php elseif($item->main_content()->isNotEmpty()): ?>
                                <?= $item->main_content()->kt()->excerpt(300) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <br><br><br><br><br><br><br><br><br><br>
</div>
<?php snippet('footer'); ?>
