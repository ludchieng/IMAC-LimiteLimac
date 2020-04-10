<?php

echo('<div class="form-container"><h1 class="title">Authentification</h1>

<form class="initForm" action="index.php?action=loginGo" method="post">
    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
    <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" required>
    <br><a href="index.php?action=register">Créer un compte</a><br><br>
    <button type="submit" class="sub"><span>Entrer</span></button>
</form></div>');