<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo $basePath ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>

    <div class="container">

    <?php echo $content ?>

    </div>

  </body>
</html>