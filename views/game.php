<header>
    <button id="btn-quit" class="btn-icon">
        <svg id="i-signout" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
            <path d="M28 16 L8 16 M20 8 L28 16 20 24 M11 28 L3 28 3 4 11 4" />
        </svg>
    </button>
    <button class="btn-icon" data-toggle="modal" data-target="#user-modal" data-whatever="@getbootstrap">
        <svg id="i-user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
            <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" /></svg>
    </button>
</header>
<?php
require_once('views/modal_user.php');
?>

<div id="game">

    <aside id="room-panel">
        <div id="room-round">Round : <span id="room-round-current">•</span>/<span id="room-round-max">•</span></div>
        <div id="room-time"><span id="room-time-min">••</span>:<span id="room-time-sec">••</span></div>
        <div id="black-card">
            <img src="img/imac-uni-white.svg">
            <p id="black-card-content"></p>
        </div>
    </aside>

    <main>
        <h1 id="game-title"></h1>
        <div id="game-alert"></div>
        <button id="game-ready-btn"><span>Prêt</span></button>
        <div id="playing-round-cards-panel"></div>
        <div id="end-round-panel"></div>
        <div id="celebration-panel"></div>
        <div id="end-room-panel"></div>
    </main>

    <aside id="room-players">
        <h1>Joueurs</h1>
        <ul>
        </ul>
    </aside>

</div>

<script src="js/action_game.js"></script>
<script src="js/Game.js"></script>