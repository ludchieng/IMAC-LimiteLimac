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

    <h1 class="title" id="board_text_to_change">Tu es le maître du jeu</h1>
    <div class="whiteCardBoard-container">
        <!--<div class="whiteCardGroup">-->
        <div class="whiteCard" id="WC1" onClick="wcVanish(this.id)">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
        <div class="whiteCard" id="WC2" onClick="wcVanish(this.id)">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
        <div class="whiteCard" id="WC3" onClick="wcVanish(this.id)">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
        <!--</div>
        <div class="whiteCardGroup">-->
        <div class="whiteCard" id="WC4" onClick="wcVanish(this.id)">
            <img src="img/imac_logo.png" alt="" srcset="">
            <p class="whiteCard-content">Lorem ipsum dolor</p>
        </div>
        <div class="whiteCard" id="WC5" onClick="wcVanish(this.id)">
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
    <p>Stats ?</p>
</aside>

<script>
    function wcVanish(clicked_id) {
        let id_to_vansih;
        for (let i = 1; i < 6; i++) {
            id_to_vanish = "WC" + i;
            if (id_to_vanish !== clicked_id) {
                document.getElementById(id_to_vanish).style.opacity = 0;
            }
        }
        document.getElementById("board_text_to_change").innerHTML = "Bidule <br> gagne cette manche !"
    }
</script>