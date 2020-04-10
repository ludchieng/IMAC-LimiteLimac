<?php 



?>



<aside class="leftDivBoard">
    <h3 class="round">Round : 12/20</h3>
    <h1 class="time">00:30</h1>
    <div class="blackCard">
        <img src="img/imac_logo.png" alt="">
        <p class="blackCard-content">Lorem ipsum dolor, sit amet consectetur ________</p>
    </div>
</aside>

<div class="centerDiv">
    <h1 class="title">Choisis une carte</h1>
    <div class="whiteCardGroup">
        <div class="whiteCard">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
        <div class="whiteCard">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
        <div class="whiteCard">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
    </div>
    <div class="whiteCardGroup">
        <div class="whiteCard">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
        <div class="whiteCard">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
        <div class="whiteCard">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
    </div>
</div>

<aside class="rightDiv">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCardModal" data-whatever="@getbootstrap">New Card</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#settingsModal" data-whatever="@getbootstrap">Settings</button>
        <?php 
            require_once('views/modals.php');
        ?>
        <br><br>
        <p>Stats ?</p>

</aside>


