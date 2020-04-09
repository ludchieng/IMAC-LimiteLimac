<?php

    /*$sql = "SELECT * FROM player WHERE pname=? AND pass=PASSWORD(?)";

    $query=$pdo->prepare($sql);
    $query->execute(array($_POST['pseudo'], $_POST['passwd']));
    $line = $query->fetch();

    if($line==false){
        header("Location: index.php?action=login");
    } else {
        //$_SESSION['id'] = $line['id'];
        $_SESSION['pseudo'] = $line['pname'];
        header("Location: index.php?action=welcome");
    }*/
    
    
    header("Location: index.php?action=welcome");
    

?>