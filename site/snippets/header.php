<!doctype html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <link rel="icon" href="/assets/rivers.png" >

  <?php
    $title = $page->title();
    if ($page->display()->exists() && $page->display()->isNotEmpty()) {
      $title = strip_tags($page->display()->kirbytextinline());
    }
  ?>
  <?php if ($title == "Home"): ?>
    <title><?= $site->title() ?></title>
  <?php else: ?>
    <title><?= $title ?> | <?= $site->title() ?></title>
  <?php endif; ?>

  <?php if ($page->main_content()->exists() && $page->main_content()->isNotEmpty()): ?>
    <meta name="description" content="<?= $page->main_content()->excerpt(200); ?>">
  <?php else: ?>
    <meta name="description" content="<?= $site->about(); ?>">
  <?php endif; ?>

  <?= css(['assets/css/main.css', '@auto']);?>
  <!-- <?= js(['assets/js/main.js', '@auto']); ?> -->

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', '<?= $site->ga(); ?>', 'auto');
    ga('send', 'pageview');
  </script>

</head>
<body>
