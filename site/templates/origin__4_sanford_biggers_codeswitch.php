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
  <?php foreach($page->blocks()->toStructure() as $block): ?>
    <li 
      class="codeswitch__block"
      style="
        --width: <?= rand(30, 50); ?>vw;
        --left: <?= rand(10, 50); ?>vw;
        --top: <?= rand(0, 50); ?>vh;
        "
      >
      <div class="codeswitch__block__container">
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
      </div>
    </li>
  <?php endforeach; ?>
  <li 
    class="codeswitch__block codeswitch__bio" 
    style="
      --width: <?= rand(20, 30); ?>vw;
      --left: var(--margin);
      --top: var(--margin);
      "
    >
    <div class="codeswitch__block__container">
      <div class="codeswitch__block__text text">
        <?= $page->bio_content()->kt(); ?>
      </div>
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

    blocks.forEach((el) => {
      let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
      el.addEventListener('click', (e) => {
        e.stopPropagation();
      });

      el.addEventListener('mousedown', (e) => {
        e.stopPropagation();

        pos3 = e.clientX;
        pos4 = e.clientY;
        
        el.addEventListener('mousemove', updatePosition);
        el.addEventListener('mouseup', () => {
          el.querySelectorAll('div').forEach((d) => { d.style.removeProperty('pointer-events')});
          el.removeEventListener('mousemove', updatePosition);
        })
      });

      const updatePosition = (e) => {
        e.preventDefault();
        el.querySelectorAll('div').forEach((d) => { d.style.pointerEvents = 'none'});
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        el.style.top = (el.offsetTop - pos2) + "px";
        el.style.left = (el.offsetLeft - pos1) + "px";
      }
    });
  });
</script>
<?php snippet('footer'); ?>