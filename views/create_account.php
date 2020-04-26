<div class="form-container"><h1 class="title">Créer un compte</h1>

<form id="register" class="initForm">
    <div id="register-info"></div>
    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
    <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" maxlength="12" required>
    <input type="password" name="vpasswd" id="vpasswd" placeholder="Confirmez le mdp" required>
    <br><a href="index.php?action=login">J'ai déjà un compte</a><br><br>
    <button type="submit" class="sub"><span>Entrer</span></button>
</form></div>
<script src="js/action_register.js"></script>