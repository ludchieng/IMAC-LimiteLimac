<?php
    require_once('actions/actions.php');
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/static.css">
    <title>TEST CSS</title>
</head>
<body>
    <a href="index.php?action=landing"><img class="logo" src="img/imac_logo.png" alt="logo_IMAC"></a>
    
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
                include("vues/404.php"); // NON : page 404
            }
            else {
                include($listeDesActions[$action]); // Oui, on la charge
            }

            ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
        ?>
    </div>

    <?php
        //require_once('includes/landing.php');
        //require_once('includes/create_account.php');
        //require_once('includes/auth.php');
        require_once('views/footer.php');
        echo('</body></html>');
    ?>