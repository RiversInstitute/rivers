<?php snippet('header', ['headerClass' => 'codeswitch']); ?>
<?php snippet('nav', ['override' => $page->nav_override()->toStructure()]); ?>
<div id="viewer"></div>
<script src="<?= $site->url(); ?>/assets/js/openseadragon/openseadragon.min.js"></script>
<script>
  var viewer = OpenSeadragon({
      id: "viewer",
      prefixUrl: "/assets/js/openseadragon/images/",
      showNavigationControl: false,
      tileSources: {
        type: 'image',
        url:  '<?= $page->viewer_images()->toFile()->url(); ?>'
      }
  });
</script>
<?php snippet('footer'); ?>