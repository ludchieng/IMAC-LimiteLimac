<aside id="lezami">
    <h1>En ligne</h1>
    <ul id="lezami-container">
    </ul>
</aside>


<div id="welcome">
    <h1 class="title">Bienvenue !</h1>
    <div>
        <button type="submit" class="sub" id="create-button"><span>Créer</span></button>
        <br><br>
        <div id="create-form">
            <input type="text" class="party-name" name="" id="" placeholder="couillesenski">
            <br><br>
            <button type="submit" class="minisub"><a class="sub_text" href="index.php?action=login"><span>Go</a></button>
        </div>
    </div>

    <div>
        <button type="submit" class="sub" id="join-button"><span>Rejoindre</span></button>
        <br><br>
        <div id="join-form">
            <input type="text" class="party-name" name="" id="" placeholder="3 boules 3 trous">
            <br><br>
            <button type="submit" class="minisub"><a class="sub_text" href="index.php?action=login"><span>Go</a></button>
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

<script src="js/get_users_online.js"></script>

<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>
<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>
<script>
jQuery("#create-button").click(() => {
    jQuery("#create-form").css('display', "inline-block");
    jQuery("#create-form").addClass('fade-in');
    jQuery("#join-form").css('display', "none");
});

jQuery("#join-button").click(() => {
    jQuery("#join-form").css('display', "inline-block");
    jQuery("#join-form").addClass('fade-in');
    jQuery("#create-form").css('display', "none");
});
</script>