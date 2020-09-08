<?php snippet('header', ['headerClass' => 'codeswitch']); ?>
<div class="navigation__container">
  <nav>
    <ul class="navigation">
      <li class="navigation__item highlight"><a href="<?= $site->url(); ?>"><?= $site->title(); ?></a></li>
      <li class="navigation__item"><button onclick="showBio()">Sanford Biggers</button></li>
    </ul>
  </nav>
</div>
<ul class="codeswitch__content">
  <?php $idx = $page->blocks()->toStructure()->count(); ?>
  <?php foreach($page->blocks()->toStructure() as $block): ?>
    <li 
      class="codeswitch__block"
      style="
        --width: <?= rand(20, 40); ?>vw;
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
  <li 
    class="codeswitch__block codeswitch__bio" 
    style="
      --width: <?= rand(30, 40); ?>vw;
      --order: -1;
      "
    >
    <div class="codeswitch__block__text text">
      <?= $page->bio_content()->kt(); ?>
    </div>
  </li>
</ul>
<script>
  const showBio = () => {
    const bio = document.querySelector('.codeswitch__bio');
    if (bio.style.display === 'block') {
      bio.style.display = 'none';
    } else {
      bio.style.display = 'block';
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const blocks = document.querySelectorAll('.codeswitch__block');
    const blocksNoBio = document.querySelectorAll('.codeswitch__block:not(.codeswitch__bio)');
    let idx = 1;
    document.querySelector('.codeswitch__content').addEventListener('click', () => {
      if (idx < blocksNoBio.length) {
        blocksNoBio[idx].style.display = 'block';
        idx++;
      }
    });
  });
</script>
<?php snippet('footer'); ?>