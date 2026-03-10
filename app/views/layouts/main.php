<!DOCTYPE html>
<html>
<head>
  <title><?= $title ?? 'Porra mundial' ?></title>
    
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name=author content="Javier Renedo">

    <link rel="icon" type="image/png" href="img/favicon-euro-2024.png">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    
  <!-- <link rel="stylesheet" href="/assets/css/main.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/body.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/menu.css">

  <?php if(!empty($styles)): ?>
    <?php foreach($styles as $style): ?>
      <link rel="stylesheet" type="text/css" href="<?= $style ?>">
    <?php endforeach; ?>
  <?php endif; ?>
</head>
<body>

<?= $content ?>

<!-- JS global -->
<!-- <script src="/assets/js/jquery.min.js"></script> -->
<!-- <script src="/assets/js/main.js"></script> -->

<!-- JS de la página -->
<?php if(!empty($scripts)): ?>
    <?php foreach($scripts as $script): ?>
        <script src="<?= $script ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>