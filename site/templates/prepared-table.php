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

    <!-- Images -->
    <h2><?= $page->images_heading() ?></h2>

    <div class="gallery">
        <?php foreach($page->main_gallery()->toFiles() as $image): ?>
            <img src="<?= $image->url() ?>" alt="<?= $image->title() ?>">
        <?php endforeach ?>
    </div>

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
