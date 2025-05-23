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
    <section class="narrow-section" id="introduction">
        <div class="content">
            <?= $page->intro_content()->kt() ?>
        </div>
    </section>
    <?php endif ?>

    <!-- Participants -->
    <?php if($page->participants()->isNotEmpty()): ?>
    <section class="narrow-section" id="<?= $page->participants_heading()->slug() ?>">
        <h2 class="section-heading"><?= $page->participants_heading() ?></h2>

        <div class="participants">
            <?php foreach($page->participants()->toStructure() as $participant): ?>
                <div class="participant">
                    <div class="participant-header">
                        <div class="tiny-square" style="--tiny-square-color: <?= $participant->color() ?>;"></div>
                        <div class="participant-name">
                            <?php if($participant->page_link()->isNotEmpty()): ?>
                                <a href="<?= $participant->page_link()->first()->toPage()->url() ?>"><?= $participant->name() ?></a>
                            <?php else: ?>
                                <?= $participant->name() ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="participant-bio">
                        <?= $participant->bio()->kt() ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
    <?php endif ?>

    <!-- Subpages -->
    <?php if($page->children()->listed()->count() > 0): ?>
    <div class="wide-section subsection-index-container" id="<?= $page->subpages_heading()->slug() ?>">
        <h2 class="subsection-index-title"><?= $page->subpages_heading() ?></h2>
        
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
    <?php endif ?>

    <!-- Images -->
    <?php if($page->main_gallery()->isNotEmpty()): ?>
    <section class="wide-section" id="<?= $page->images_heading()->slug() ?>">
        <h2 class="section-heading"><?= $page->images_heading() ?></h2>
    
        <div class="gallery">
            <?php foreach($page->main_gallery()->toFiles() as $image): ?>
                <figure>
                    <img src="<?= $image->url() ?>" alt="<?= $image->title() ?>">
                    <figcaption><?= $image->caption() ?></figcaption>
                </figure>
            <?php endforeach ?>
        </div>
    </section>
    <?php endif ?>

    <!-- Materials -->
    <?php if($page->materials()->isNotEmpty()): ?>
    <section class="narrow-section" id="<?= $page->materials_heading()->slug() ?>">
        <h2 class="section-heading"><?= $page->materials_heading() ?></h2>
    
        <div class="materials">
            <?php foreach ($page->materials()->toFiles() as $item) : ?>
                <a href="<?= $item->url()?>" class="materials-block">
                    <?= $item->name() . '.' . $item->extension(); ?>
                </a>
            <?php endforeach ?>
        </div>
    </section>
    <?php endif ?>

    <!-- Sources -->
    <?php if($page->sources()->isNotEmpty()): ?>
    <section class="narrow-section sources-section" id="<?= $page->sources_heading()->slug() ?>">
        <h2 class="section-heading"><?= $page->sources_heading() ?></h2>
    
        <ul class="sources">
            <?php foreach($page->sources()->toStructure() as $source): ?>
                <li class="source"><?= $source->citation()->kt() ?></li>
            <?php endforeach ?>
        </ul>
    </section>
    <?php endif ?>

</div>
<?php snippet('footer'); ?>
