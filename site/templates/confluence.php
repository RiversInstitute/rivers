<?php snippet('header', ['headerClass' => 'height-limited']); ?>
<?php snippet('nav'); ?>
<div class="comings-layout">
    <a href="<?= $page->parent()->url() ?>" id="back-to-comings">Comings</a>

    <h1 id="page-title"><?= $page->title() ?></h1>

    <!-- Navigation -->
    <?php if($page->navigation()->isNotEmpty()): ?>
    <nav id="jump-nav">
        <?php foreach($page->navigation()->toStructure() as $item): ?>
            <a href="<?= $item->url() ?>"><?= $item->title() ?></a>
        <?php endforeach ?>
    </nav>
    <?php endif ?>

    <!-- Intro -->
    <?php if($page->intro_content()->isNotEmpty()): ?>
    <div class="content">
        <?= $page->intro_content()->kt() ?>
    </div>
    <?php endif ?>

    <!-- Events -->
    <div class="subsection-index-container">
        <h2 class="subsection-index-title">Events</h2>
        
        <div class="subsection-index">
            <?php foreach($page->children()->listed()->sortBy() as $item): ?>
                <div class="subsection-index-item">
                    <div class="tiny-square" style="--tiny-square-color: <?= $item->color() ?>;"></div>
                    <div class="subsection-index-item-content">
                        <a href="<?= $item->url() ?>">
                            <?php
                            // First try to get cover image
                            $image = null;
                            if($coverImage = $item->cover_image()->toFile()) {
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

</div>
<?php snippet('footer'); ?>
