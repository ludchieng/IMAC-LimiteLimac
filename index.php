<?php
require_once('actions/actions.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once('views/includes_before_body.php'); ?>
  <title>Limite Limac</title>
</head>

<body>
  <div id="particles-js"></div>

  <a id="logo" href="/"><img src="img/imac-uni-white.svg" alt="Logo IMAC"></a>

  <div class="main">
    <?php
    $action = $action ?? $_GET["action"] ?? '';

    switch ($action) {
      case 'hub':
      case 'play':
        if (!isset($_COOKIE['pname'], $_COOKIE['token']))
          header('Location: /index.php?action=login');
        break;
      case 'login':
        if (isset($_COOKIE['pname'], $_COOKIE['token']))
          header('Location: /index.php?action=hub');
        break;
    }

    if (array_key_exists($action, $listeDesActions) == false) {
      include("views/404.php");
    } else {
      include($listeDesActions[$action]);
    }
    ?>
  </div>
  <?php require_once('views/footer.php'); ?>
  <?php require_once('views/includes_after_body.php'); ?>
</body>

</html>