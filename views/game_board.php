<script src="js/action_game.js"></script>
<script src="js/Game.js"></script>

<header>
    <button type="button" data-toggle="modal" data-target="#settingsModal" data-whatever="@getbootstrap">Settings</button>
    <button type="button" data-toggle="modal" data-target="#newCardModal" data-whatever="@getbootstrap">New Card</button>
</header>
<?php
require_once('views/modals.php');
?>

<div id="game">

    <aside id="room-panel">
        <div id="room-round">Round : <span id="room-round-current">1</span>/<span id="room-round-max">20</span></div>
        <div id="room-time"><span id="room-time-min">••</span>:<span id="room-time-sec">••</span></div>
        <div id="black-card">
            <img src="img/imac-uni-white.svg">
            <p id="black-card-content"></p>
        </div>
    </aside>

    <main>
        <h1 id="game-title"></h1>
        <button id="game-ready-btn"><span>Prêt</span></button>
        <div id="white-cards-panel"></div>
        <div id="end-round-panel"></div>
    </main>

    <aside id="room-players">
        <h1>Joueurs</h1>
        <ul>
        </ul>
    </aside>

</div>