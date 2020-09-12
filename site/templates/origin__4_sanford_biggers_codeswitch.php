<?php snippet('header', ['headerClass' => 'codeswitch']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>
<div class="codeswitch__overlay">
  <div class="codeswitch__overlay__content">
    <div class="codeswitch__overlay__title text">
      <?= $page->overlay_title()->kt(); ?>
    </div>
    <div class="codeswitch__overlay__note text">
      <?= $page->overlay_note()->kt(); ?>
    </div>
  </div>
</div>
<ul class="codeswitch__content">
  <?php $idx = $page->blocks()->toStructure()->count(); ?>
  <?php foreach($page->blocks()->toStructure() as $block): ?>
    <li 
      class="codeswitch__block"
      style="
        --width: <?= rand(20, 35); ?>vw;
        --order: <?= $idx--; ?>
        "
      >
      <?php if ($block->block_type() == 'upload'): ?>
        <div class="codeswitch__block__upload">
          <?php $blockFile = $block->block_upload()->toFile(); ?>
            <?php if ($blockFile->type() == 'image'): ?>
              <img src="<?=$blockFile->resize(1000)->url(); ?>" loading="lazy">
            <?php elseif ($blockFile->type() == 'video'): ?>
              <video controls playsinline loop controlslist="nodownload">
                <source src="<?= $blockFile->url(); ?>" type="<?= $blockFile->mime(); ?>">
              </video>
            <?php elseif ($blockFile->type() == 'audio'): ?>
              <audio controls>
                <source src="<?= $blockFile->url(); ?>" type="<?= $blockFile->mime(); ?>">
              </audio>
            <?php else: ?>
              <a href="<?=$blockFile->url(); ?>">
                <div class="text highlight">
                  <?=$blockFile->filename(); ?>
                </div>
              </a>
            <?php endif; ?>
        </div>
      <?php elseif ($block->block_type() == 'embed'): ?>
        <div class="codeswitch__block__embed">
          <?= $block->block_embed(); ?>
        </div>
      <?php endif; ?>
      <div class="codeswitch__block__text text">
        <?= $block->block_text()->kt(); ?>
      </div>
    </li>
  <?php endforeach; ?>
</ul>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const blocks = document.querySelectorAll('.codeswitch__block');
    let idx = 1;
    document.querySelector('.codeswitch__content').addEventListener('click', () => {
      if (idx < blocks.length) {
        blocks[idx].style.display = 'block';
        idx++;
      }
    });

    document.body.style.overflow = 'hidden';
    document.querySelector('.codeswitch__overlay').addEventListener('click', () => {
      document.querySelector('.codeswitch__overlay').style.display = 'none';
      document.body.style.removeProperty('overflow');
    });
  });
</script>
<?php snippet('footer'); ?>