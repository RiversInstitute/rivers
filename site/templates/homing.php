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
    <section class="narrow-section">
        <div class="content">
            <?= $page->intro_content()->kt() ?>
        </div>
    </section>
    <?php endif ?>

    <!-- Images -->
    <section class="wide-section">
        <h2 class="section-heading"><?= $page->images_heading() ?></h2>
    
        <div class="gallery">
            <?php foreach($page->main_gallery()->toFiles() as $image): ?>
                <img src="<?= $image->url() ?>" alt="<?= $image->title() ?>">
            <?php endforeach ?>
        </div>
    </section>

    <!-- Materials -->
    <?php if($page->materials()->isNotEmpty()): ?>
    <section class="narrow-section">
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
    <section class="narrow-section sources-section">
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
