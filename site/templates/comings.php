<?php snippet('header', ['headerClass' => 'height-limited']); ?>
<?php snippet('nav'); ?>

<div class="subsection-nav-wrapper">
    <div class="subsection-nav" style="height: 80dvh;">
        <?php snippet('subsection-grid-six', ['grid_items' => $page->children()->listed(), 'nav' => false, 'images' => false, 'color' => $page->color()]); ?>
    </div>

    <div class="subsection-blurb">
        <?= $page->blurb()->kt() ?>
    </div>
</div>

<?php snippet('footer'); ?>
