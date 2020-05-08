<div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="user-modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user-modalLabel"><?= $_COOKIE['pname'] ?? 'Utilisateur' ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Couleur</label>
                        <div id="color-picker">
                            <div id="view"></div>
                            <div id="colors">
                                <input type="text" id="txt" value="">
                                <input class="inp" type="range" id="inp1" min="0" max="360" value="331" draggable="false">
                                <input class="inp" type="range" id="inp2" min="0" max="100" value="100" draggable="false">
                                <input class="inp" type="range" id="inp3" min="0" max="100" value="50" draggable="false">
                                <p id="rgb">rgb(255, 255, 255)</p>
                                <p id="hex">#ffffff</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button id="btn-submit-color" type="button" class="btn btn-primary">Valider</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/colorpicker.js"></script>
<script>
$(document).ready(() => {
    let cp = new ColorPicker(getCookie('color'));
    cp.init();
    

    $('#btn-submit-color').click(() => {
        $.ajax({
            type: "POST", url: "api/player_edit_color.php",
            data: {
                pname: getCookie('pname'),
                token: getCookie('token'),
                color: $('#hex').text().slice(1,7)
            }
        }).done((r) => {
            if (!r.success) {
                throw 'Error edit color';
            } else {
                setCookie('color', r.response.color);
            }
        });
        $('#user-modal').modal('hide');
    });
});
</script>