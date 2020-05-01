<header>
    <button id="btn-signout" class="btn-icon btn-red">
        <svg id="i-signout" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
            <path d="M28 16 L8 16 M20 8 L28 16 20 24 M11 28 L3 28 3 4 11 4" />
        </svg>
    </button>
    <button class="btn-icon">
        <svg id="i-user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
            <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" /></svg>
    </button>
    <button class="btn-icon" data-toggle="modal" data-target="#settingsModal" data-whatever="@getbootstrap">
        <svg id="i-settings" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
            <path d="M13 2 L13 6 11 7 8 4 4 8 7 11 6 13 2 13 2 19 6 19 7 21 4 24 8 28 11 25 13 26 13 30 19 30 19 26 21 25 24 28 28 24 25 21 26 19 30 19 30 13 26 13 25 11 28 8 24 4 21 7 19 6 19 2 Z" />
            <circle cx="16" cy="16" r="4" />
        </svg>
    </button>
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