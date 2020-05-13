<header>
    <button id="btn-signout" class="btn-icon btn-red btn-hidden">
        <svg id="i-signout" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
            <path d="M28 16 L8 16 M20 8 L28 16 20 24 M11 28 L3 28 3 4 11 4" />
        </svg>
    </button>
    <button id="btn-user" class="btn-icon btn-hidden" data-toggle="modal" data-target="#user-modal" data-whatever="@getbootstrap">
        <svg id="i-user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
            <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" /></svg>
    </button>
    <button id="btn-edit" class="btn-icon btn-hidden">
        <svg id="i-compose" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
            <path d="M27 15 L27 30 2 30 2 5 17 5 M30 6 L26 2 9 19 7 25 13 23 Z M22 6 L26 10 Z M9 19 L13 23 Z" /></svg>
    </button>
    <button id="btn-play" class="btn-icon">
        <span>Jouer</span>
        <svg id="i-forwards" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
            <path d="M16 2 L30 16 16 30 16 16 2 30 2 2 16 16 Z" />
        </svg>
    </button>
</header>
<?php
require_once('views/modal_user.php');
?>

<div id="landing">
    <div id="landing-left">
        <div id="landing-anim">
            <div class="card card-black">
                <img class="card-icon" src="img/imac-uni-white.svg">
                <p class="card-content">Étape 1 : __________ Étape 2 : __________ Étape 3 : Succès et célébrité.</p>
                <span class="card-author"></span>
            </div>
            <div class="card card-white">
                <img class="card-icon" src="img/imac-uni-darkblue.svg">
                <p class="card-content">Un jeudimac au bord du Rhin</p>
                <span class="card-author"></span>
            </div>
            <div class="card card-white">
                <img class="card-icon" src="img/imac-uni-darkblue.svg">
                <p class="card-content">Se faire verbaliser par la Polizei de Karlsruhe pour tapage nocturne</p>
                <span class="card-author"></span>
            </div>
        </div>
    </div>

    <div id="landing-right">
        <h1>LIMITE_LIMAC</h1>
        <p>Le jeu klakos pour des étudiants rigolos</p>
        <div class="flex-break"></div>
        <p class="lighter">Si tu n'est pas un IMAC 🤩, ce jeu n'est probablement pas fait pour toi ! Tu risques de pas comprendre toutes les références 👹<br>
           <span style="font-weight: bolder">BISOUS.</span></p>
        <div class="flex-break"></div>
        <button type="submit" class="sub" onclick="location.href = '/index.php?action=login';">
            <span class="sub_text">GO !</span>
        </button>
    </div>
</div>

<script src="js/action_landing.js"></script>