<?php

    /*if(isset($_POST["pseudo"]) && isset($_POST['vpasswd']) && isset($_POST['passwd']) && $_POST['vpasswd'] === $_POST['passwd']) {
        $sql = "INSERT INTO player(pname,pass) VALUES(?,PASSWORD(?))";

        $query = $pdo->prepare($sql);
        $query->execute(array($_POST['pseudo'], $_POST['passwd']));

       
        header("Location: index.php?action=welcome");
    }*/

    header("Location: index.php?action=welcome");
    



?>