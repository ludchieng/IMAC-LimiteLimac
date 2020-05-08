<?php
if (isset($_GET['join'])) {
  $param = "&join={$_GET['join']}";
} else {
  $param = '';
}
?>
<div class="form-fullscreen">
    <h1 class="form-fullscreen-title">Authentification</h1>

    <form id="login">
        <div id="form-fullscreen-alert"></div>
        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
        <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" required>
        <br><a href="index.php?action=register<?= $param ?>">Créer un compte</a><br><br>
        <button type="submit" class="sub"><span>Entrer</span></button>
    </form>
</div>
<script src="js/action_login.js"></script>