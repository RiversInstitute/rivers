<?php snippet('header'); ?>
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
    <li class="codeswitch__block">
      <?php if ($block->block_type() == 'upload'): ?>
        <div class="codeswitch__block__upload">
          <?php $blockFile = $block->block_upload()->toFile(); ?>
            <?php if ($blockFile->type() == 'image'): ?>
              <img src="<?=$blockFile->resize(1000)->url(); ?>" loading="lazy">
            <?php elseif ($blockFile->type() == 'video'): ?>
              <div class="ratio-container">
                <video class="ratio-contained" controls playsinline loop controlslist="nodownload">
                  <source src="<?= $blockFile->url(); ?>" type="<?= $blockFile->mime(); ?>">
                </video>
              </div>
            <?php else: ?>
              <a href="<?=$blockFile->url(); ?>">
                <div class="text">
                  <?=$blockFile->filename(); ?>
                </div>
              </a>
            <?php endif; ?>
        </div>
      <?php elseif ($block->block_type() == 'embed'): ?>
        <div class="codeswitch__block__embed">
        </div>
      <?php endif; ?>
      <div class="codeswitch__block__text">
        <?= $block->text()->kt(); ?>
      </div>
    </li>
  <?php endforeach; ?>
</ul>

<script>
  const showBio = () => {
    console.log('show bio');
  }
</script>
<?php snippet('footer'); ?>