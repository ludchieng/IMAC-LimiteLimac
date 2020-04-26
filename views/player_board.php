<header>
    <button type="button" data-toggle="modal" data-target="#settingsModal" data-whatever="@getbootstrap">Settings</button>
    <button type="button" data-toggle="modal" data-target="#newCardModal" data-whatever="@getbootstrap">New Card</button>
</header>
<?php
require_once('views/modals.php');
?>

<div id="game">

    <aside id="room-panel">
        <div id="room-round">Round : <span>12</span>/20</div>
        <div id="room-time">00:<span>30</span></div>
        <div id="black-card">
            <img src="img/imac-uni-white.svg">
            <p>Pourquoi je pécho pas ? Parce que __________</p>
        </div>
    </aside>

    <main>
        <h1 id="game-title">Choisis une carte</h1>
        <div id="white-cards-panel">
            <div class="white-card">
                <img src="img/imac-uni-darkblue.svg">
                <p>la collection de memes en ma défaveur</p>
            </div>
            <div class="white-card">
                <img src="img/imac-uni-darkblue.svg">
                <p>Une séance recette pompette avec Luc</p>
            </div>
            <div class="white-card">
                <img src="img/imac-uni-darkblue.svg">
                <p>Ma sobriété</p>
            </div>
            <div class="white-card">
                <img src="img/imac-uni-darkblue.svg">
                <p>Revenir du Québec avec l'accent</p>
            </div>
            <div class="white-card">
                <img src="img/imac-uni-darkblue.svg">
                <p>Mes incroyables skills en dessin sur OpenGL</p>
            </div>
            <div class="white-card">
                <img src="img/imac-uni-darkblue.svg">
                <p>Le micro d'Émilie Verger</p>
            </div>
            <div class="white-card">
                <img src="img/imac-uni-darkblue.svg">
                <p>Mes burnouts récursifs</p>
            </div>
        </div>
    </main>

    <aside id="room-players">
        <h1>Joueurs</h1>
        <ul>
            <li>
                <div class="room-players-dot" style="background-color: #56fe42; border-color: #56fe42"></div>
                <p>Protool</p>
            </li>
        </ul>
    </aside>

</div>

<script>
    jQuery('.white-card').click((e) => {
        jQuery(e.currentTarget).toggleClass('white-card-selected');
    })
</script>