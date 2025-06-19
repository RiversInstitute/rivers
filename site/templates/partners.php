<?php snippet('header', ['headerClass' => 'no-pad']); ?>
<?php snippet('nav', ['support' => true]); ?>
<div>
  <div class="layout-wrapper--full">
    <div class="text col-2">
      <?= $page->main_content()->kt(); ?>
    </div>
  </div>

  <div class="subsection-index-container">
        <h2 class="subsection-index-title">Partners</h2>
        
        <div class="subsection-index partners">
            <?php foreach($page->partners()->toStructure() as $item): ?>
                <div class="subsection-index-item">
                    <div class="subsection-index-item-content">
                        <a href="<?= $item->url() ?>">
                            <figure>
                                <div class="partner-logo-inner" style="--partner-color: <?= $item->color() ?>;">
                                    <img src="<?= $item->logo()->toFile()->resize(500)->url(); ?>" alt="<?= $item->title() ?>">
                                </div>
                            </figure>
                            <!-- <?= $item->name() ?> -->
                        </a>
                        <div class="subsection-index-item-preview" style="--partner-color: <?= $item->color() ?>;">
                            <?= $item->description()->kt(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
  </div>

  <br><br><br>
</div>
<?php snippet('footer'); ?>
