<?php
require_once('actions/actions.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once('views/includes_before_body.php');
    ?>
    <title>Limite Limac</title>
</head>

<body>
    <!-- particles.js container -->
    <div id="particles-js"></div>

    <a id="logo" href="index.php?action=landing"><img src="img/imac_logo.png" alt="Logo IMAC"></a>

    <div class="main">
        <?php
        // Quelle est l'action à faire ?
        if (isset($_GET["action"])) {
            $action = $_GET["action"];
        } else {
            $action = "landing";
        }

        // Est ce que cette action existe dans la liste des actions
        if (array_key_exists($action, $listeDesActions) == false) {
            include("views/404.php"); // NON : page 404
        } else {
            include($listeDesActions[$action]); // Oui, on la charge
        }
        ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
        ?>
    </div>
    <?php
    require_once('views/footer.php');
    ?>
</body>
<?php
require_once('views/includes_after_body.php');
?>

</html>