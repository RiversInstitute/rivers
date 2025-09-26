<?php snippet('header', ['headerClass' => 'height-limited']); ?>
<?php snippet('nav'); ?>
<div class="subsection-nav-wrapper">
    <div class="subsection-blurb">
        <?= $page->blurb()->kt() ?>
    </div>

    <div class="subsection-index-container">
        <!-- <h2 class="subsection-index-title">All artists</h2> -->
        
        <div class="subsection-index">
            <?php foreach($page->children()->listed() as $item): ?>
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
                        </a>
                        <?= $item->title() ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <br><br><br><br><br><br><br><br><br><br>
</div>
<?php snippet('footer'); ?>
