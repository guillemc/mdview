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

        <div class="page_header">
            <h1 class="text-danger"><?php echo htmlspecialchars($title) ?></h1>
        </div>

        <?php echo $content ?>

        <?php if ($code == 404): ?>
        <p><a href="<?php echo $basePath ?>">Home</a></p>
        <?php endif ?>

    </div>

  </body>
</html>