<?php snippet('header'); ?>
<?php snippet('nav'); ?>
<div class="layout-wrapper__about">

  <div class="about_page">

    <div class="main_text">
      <?= $page->main_content()->kt(); ?>
    </div>

    <div class="side_text">

      <div class="subscribe">
        <?= $page->subscribe()->kt(); ?>
      </div>

      <div class="colophon">
        <?= $page->colophon()->kt(); ?>
      </div>

    </div>

  </div>

</div>
<?php snippet('footer'); ?>
