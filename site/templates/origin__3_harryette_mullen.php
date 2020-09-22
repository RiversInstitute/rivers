<?php snippet('header', ['headerClass' => 'mullen']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>

<div class="mullen__layout-wrapper">
  <div class="poem text">
    <?= $page->poem()->kt(); ?>
  </div>

  <div class="poem__citation text">
    <?= $page->poem_citation()->kt(); ?>
  </div>
</div>

<div class="mullen__bio-credits">
  <div class="layout-wrapper text">
    <?= $page->bio_credits()->kt(); ?>
  </div>

  <ul>
    <?php foreach($page->blocks()->toStructure() as $block): ?>
      <li class="audio">
        <div class="audio__caption text">
          <?= $block->block_text()->kt(); ?>
        </div>
        <?php if ($block->block_type() == 'upload'): ?>
          <?php $blockFile = $block->block_upload()->toFile(); ?>
          <?php if ($blockFile->type() == 'audio'): ?>
            <div class="audio__block">
              <audio controls>
                <source id="myaudio" src="<?= $blockFile->url(); ?>" type="<?= $blockFile->mime(); ?>">
              </audio>
            </div>
          <?php endif; ?>
        <?php elseif ($block->file_type() == 'embed'): ?>
          <?= $block->file_embed(); ?>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>

</div>

<script>
  document.querySelector('#nav-credits').addEventListener('click', () => {
      document.querySelector('.mullen__bio-credits').classList.toggle('active');
    });
</script>


<?php snippet('footer'); ?>
