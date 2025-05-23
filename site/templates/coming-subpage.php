<?php snippet('header', ['headerClass' => 'height-limited']); ?>
<?php snippet('nav'); ?>
<div class="comings-layout">
    <a href="<?= $page->parent()->url() ?>" id="back-to-comings">Comings</a>

    <h1 id="page-title"><a href="<?= $page->parent()->url() ?>"><?= $page->parent()->title() ?></a> / <?= $page->title() ?></h1>

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
    <section class="narrow-section">
        <div class="content">
            <?= $page->intro_content()->kt() ?>
        </div>
    </section>
    <?php endif ?>

    <!-- Participants -->
    <?php if($page->participants()->isNotEmpty()): ?>
    <section class="narrow-section">
        <h2><?= $page->participants_heading() ?></h2>

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

    <!-- Images -->
    <?php if($page->main_gallery()->isNotEmpty()): ?>
    <section class="wide-section">
        <h2><?= $page->images_heading() ?></h2>
    
        <div class="gallery">
            <?php foreach($page->main_gallery()->toFiles() as $image): ?>
                <figure>
                    <img src="<?= $image->url() ?>" alt="<?= $image->title() ?>">
                    <figcaption><?= $image->caption() ?></figcaption>
                </figure>
            <?php endforeach ?>
        </div>
    </div>
    <?php endif ?>

    <!-- Materials -->
    <?php if($page->materials()->isNotEmpty()): ?>
    <h2><?= $page->materials_heading() ?></h2>

    <div class="materials">
        <?php foreach($page->materials()->toFiles() as $material): ?>
            <img src="<?= $material->url() ?>" alt="<?= $material->title() ?>">
        <?php endforeach ?>
    </div>
    <?php endif ?>

    <!-- Sources -->
    <?php if($page->sources()->isNotEmpty()): ?>
    <h2><?= $page->sources_heading() ?></h2>

    <div class="sources">
        <?php foreach($page->sources()->toStructure() as $source): ?>
            <div class="source"><?= $source->citation()->kt() ?></div>
        <?php endforeach ?>
    </div>
    <?php endif ?>

</div>
<?php snippet('footer'); ?>
