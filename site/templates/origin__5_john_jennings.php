<?php snippet('header', ['headerClass' => 'jennings']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>
<?= $page->video_embed(); ?>
<?php snippet('footer'); ?>
