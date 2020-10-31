<?php snippet('header', ['headerClass' => 'mullen']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>

<div class="mullen__bio-credits">
  <div class="layout-wrapper">
    <div class="bio">
      <?= $page->bio_credits()->kt(); ?>
    </div>

  </div>
</div>


<div class="mullen__layout-wrapper">

  <div class="poem__title text" onclick="playAudio()">
    <?= $page->poem_title()->kt(); ?>
  </div>

  <div class="hidden">

    <div class="poem text">
      <?= $page->poem()->kt(); ?>
    </div>
    <div class="poem__citation text">
      <?= $page->poem_citation()->kt(); ?>
    </div>

    <ul>
      <?php foreach($page->blocks()->toStructure() as $block): ?>
        <li class="audio">

          <?php if ($block->block_type() == 'upload'): ?>
            <?php $blockFile = $block->block_upload()->toFile(); ?>
            <?php if ($blockFile->type() == 'audio'): ?>
              <div class="audio__block">
                <audio id="myaudio" controls>
                  <source src="<?= $blockFile->url(); ?>" type="<?= $blockFile->mime(); ?>">
                </audio>
              </div>
            <?php endif; ?>
          <?php elseif ($block->file_type() == 'embed'): ?>
            <?= $block->file_embed(); ?>
          <?php endif; ?>

          <div class="audio__caption text">
            <?= $block->block_text()->kt(); ?>
          </div>
          
        </li>
      <?php endforeach; ?>
    </ul>
</div>
</div>


<script>
  document.querySelector('#nav-about').addEventListener('click', () => {
      document.querySelector('.mullen__bio-credits').classList.toggle('active');
    });

    document.querySelector('.poem__title').addEventListener('click', (e) => {
      document.querySelector('.hidden').classList.add('expanded');
    });

    function playAudio () {
      var audio = document.getElementById("myaudio");
      audio.play();
      document.querySelector('.poem__title').removeAttribute("onclick");
    }


</script>




<?php snippet('footer'); ?>
