<?php

echo('<div class="form-container"><h1 class="title">Créer un compte</h1>
<form class="initForm" action="index.php?action=registerGo" method="post">
    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
    <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" required>
    <input type="password" name="vpasswd" id="passwd" placeholder="Confirmez le mdp" required>
    <br><a href="index.php?action=login">J\'ai déjà un compte</a><br><br>
    <button type="submit" class="sub"><span>Entrer</span></button>
</form></div>');