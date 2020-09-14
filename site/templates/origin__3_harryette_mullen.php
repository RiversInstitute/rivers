<?php snippet('header', ['headerClass' => 'mullen']); ?>
<div class="navigation__container">
  <nav>
    <ul class="navigation">
      <li class="navigation__item highlight"><a href="<?= $site->url(); ?>"><?= $site->title(); ?></a></li>
    </ul>
  </nav>
</div>

<div class="layout-wrapper">


    <div class="poem">
    <?= $page->poem()->kt(); ?>
    </div>


    <div class="poem_citation">
    <?= $page->poem_citation()->kt(); ?>
    </div>

    <!-- <?php foreach($page->blocks()->toStructure() as $block): ?>

    <div class="audio__caption">
      <?= $block->block_text()->kt(); ?>
    </div>
    <?php endforeach; ?> -->

<ul>
  <div class="audio">

      <?php foreach($page->blocks()->toStructure() as $block): ?>

        <div class="audio__caption">
          <?= $block->block_text()->kt(); ?>
        </div>

        <?php if ($block->block_type() == 'upload'): ?>

            <?php $blockFile = $block->block_upload()->toFile(); ?>

              <?php if ($blockFile->type() == 'audio'): ?>
                <audio controls>
                  <source id="myaudio" src="<?= $blockFile->url(); ?>" type="<?= $blockFile->mime(); ?>">
                </audio>
              <?php endif; ?>

        <?php elseif ($block->file_type() == 'embed'): ?>
            <?= $block->file_embed(); ?>

        <?php endif; ?>
        <?php endforeach; ?>
      </div>
  </ul>

  <div class="bib">
  <?= $page->bibliography()->kt(); ?>
  </div>

  </div>



<?php snippet('footer'); ?>
