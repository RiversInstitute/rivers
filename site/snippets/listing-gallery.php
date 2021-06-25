<ul class="listing__gallery" id="gallery">
    <?php foreach($files as $file): ?>
        <li class="listing__gallery__item">
        <a href="<?= $file->resize(2000)->url() ?>">
            <div class="listing__gallery__item__image">
            <img src="<?= $file->resize(500)->url() ?>" loading="lazy">
            </div>
            <div class="listing__gallery__item__caption text">
            <?= $file->caption()->kt(); ?>
            </div>
        </a>
        </li>
    <?php endforeach; ?>
</ul>