<?php
if (!isset($_GET['idroom']))
  header('Location: /index.php');

if (!is_numeric($_GET['idroom']))
  header('Location: /index.php');

if (!isset($_COOKIE['pname'], $_COOKIE['token']))
  header("Location: /index.php?action=login&join={$_GET['idroom']}");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once('views/includes_before_body.php'); ?>
  <title>Join · Limite Limac</title>
</head>

<body>

  <main>
    <div class="form-fullscreen">
      <h1 class="form-fullscreen-title">Rejoindre le salon ?</h1>
      <div id="room-details" class="text-center"></div>
      <form id="join" style="border: none">
        <div id="form-fullscreen-alert"></div>
        <button type="submit" class="sub"><span>Oui</span></button>
      </form>
    </div>
  </main>

  <div id="particles-js"></div>
  <?php require_once('views/includes_after_body.php'); ?>
</body>

<script src="js/action_join.js"></script>

</html>