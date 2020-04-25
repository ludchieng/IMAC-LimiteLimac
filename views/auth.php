<?php

echo('<div class="form-container"><h1 class="title">Authentification</h1>

<form id="login" class="initForm" action="index.php?action=loginGo" method="post">
    <div id="register-info"></div>
    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" maxlength="12" required>
    <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" required>
    <br><a href="index.php?action=register">Créer un compte</a><br><br>
    <button type="submit" class="sub"><span>Entrer</span></button>
</form></div>
<script src="js/action_login.js"></script>'
);