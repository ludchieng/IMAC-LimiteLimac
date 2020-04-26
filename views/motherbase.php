<header>
    <button type="button" data-toggle="modal" data-target="#settingsModal" data-whatever="@getbootstrap">Settings</button>
    <button type="button" data-toggle="modal" data-target="#newCardModal" data-whatever="@getbootstrap">New Card</button>
</header>
<?php
require_once('views/modals.php');
?>

<div id="welcome">
    <aside id="lezami">
        <h1>Joueurs</h1>
        <ul></ul>
    </aside>

    <main>
        <h1 class="title">Bienvenue !</h1>
        <div id="room-form">
            <div id="room-form-buttons">
                <button type="submit" class="sub" id="create-button"><span>Créer</span></button>
                <button type="submit" class="sub" id="join-button"><span>Rejoindre</span></button>
            </div>
            <form id="room-create">
                <div id="room-create-info"></div>
                <input type="text" placeholder="Nom du salon">
                <button type="submit" class="minisub"><span>Go</span></button>
            </form>
            <form id="room-join">
                <div id="room-join-info"></div>
                <input type="text" placeholder="ID du salon">
                <button type="submit" class="minisub"><span>Go</span></button>
            </form>
        </div>
    </main>

    <aside id="lezalons">
        <h1>Salons</h1>
        <ul></ul>
    </aside>
</div>

<script src="js/get_users_online.js"></script>
<script src="js/get_rooms_online.js"></script>
<script src="js/action_welcome.js"></script>