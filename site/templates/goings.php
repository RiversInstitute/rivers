<?php snippet('header', ['headerClass' => 'height-limited']); ?>
<?php snippet('nav'); ?>

<div class="layout-wrapper--full goings">
    <div class="home__header">
    <a href="<?= $site->url(); ?>/about" class="home__site-title">
        <div class="site-title__text"><?= $site->full_title(); ?></div>
    </a>
    </div>

    <?php snippet('subsection-grid', ['subpages' => $page->children()->listed()->sortBy()]); ?>
</div>  

<?php snippet('footer'); ?>
