<aside class="leftDivBoard">
    <h3 class="round">Round : 12/20</h3>
    <h1 class="time">00:30</h1>
    <div class="blackCard">
        <img src="img/imac_logo.png" alt="">
        <p class="blackCard-content">Lorem ipsum dolor, sit amet consectetur ________</p>
    </div><br>
    <h3 class="leader_name">Sylvain</h3>
</aside>

<div class="centerDivBoard">

    <h1 class="title">Choisis une carte</h1>
    <div class="whiteCardBoard-container">
        <!--<div class="whiteCardGroup">-->
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
        <!--</div>
        <div class="whiteCardGroup">-->
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
        <!--</div>-->
    </div>
</div>

<aside class="rightDivBoard">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCardModal" data-whatever="@getbootstrap">New Card</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#settingsModal" data-whatever="@getbootstrap">Settings</button>
    <?php
    require_once('views/modals.php');
    ?>
    <br><br>
    <h1 class="title">Lé Zamis</h1>
    <div class="lezami">
        <div class="lezami-content">
            <div class="score">10</div>
            <p class="lezami-text">Sylvain</p>
        </div>
        <div class="lezami-content">
            <div class="score">10</div>
            <p class="lezami-text">mmmmmmmmmm</p>
        </div>
        <div class="lezami-content">
            <div class="score">10</div>
            <p class="lezami-text">cofez^fzpucou</p>
        </div>
        <div class="lezami-content">
            <div class="score">10</div>
            <p class="lezami-text">cofzezefucou</p>
        </div>
        <div class="lezami-content">
            <div class="score">10</div>
            <p class="lezami-text">cofzezefucou</p>
        </div>
        <div class="lezami-content">
            <div class="score">10</div>
            <p class="lezami-text">cofzezefucou</p>
        </div>
    </div>
</aside>