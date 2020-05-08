<!-- Modal -->
<div class="modal fade" id="create-room-modal" tabindex="-1" role="dialog" aria-labelledby="create-room-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Créer un salon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>

          <div class="row">
            <label for="room-name" class="col-sm-5 text-right col-form-label">Nom</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form-control-sm" id="room-name" placeholder="Le Mils">
            </div>
          </div>

          <div class="row">
            <label for="nb-rounds" class="col-sm-5 text-right col-form-label">Nb de Rounds</label>
            <div class="col-sm-7">
              <input type="number" class="form-control form-control-sm" id="nb-rounds" placeholder="8" value="8">
            </div>
          </div>

          <div class="row">
            <label for="round-duration" class="col-sm-5 text-right col-form-label">Durée du Round</label>
            <div class="col-sm-7">
              <input type="number" class="form-control form-control-sm" id="round-duration" placeholder="45" value="45">
            </div>
          </div>

          <div class="row">
            <label for="celebration-duration" class="col-sm-5 text-right col-form-label">Durée de Transition</label>
            <div class="col-sm-7">
              <input type="number" class="form-control form-control-sm" id="celebration-duration" placeholder="6" value="6">
            </div>
          </div>

          <div>
            <h5 class="mt-4">Packs de cartes</h5>

            <select id="select-packs" multiple></select>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <div id="create-room-modal-alert"></div>
        <button id="create-room-modal-btn" type="button" class="btn btn-primary">Créer</button>
      </div>
    </div>
  </div>
</div>

<script>
  var dlb;

  $('#create-room-btn').click(() => {
    $('.dual-listbox.select-packs').remove();
    $.ajax({
      type: "GET",
      url: "api/card_packs_list.php"
    }).done((r) => {
      if (!r.success) {
        $('#create-room-modal-alert').text('Erreur récupération des packs :(');
      } else {
        let options = r.response.packs;
        for (let o of options) {
          o.value = o.id_pack;
          o.text = o.name;
          if (o.id_pack == 1)
            o.selected = true;
          delete o.id_pack;
          delete o.name;
        }
        dlb = new DualListbox('#select-packs', {
          availableTitle: 'Disponibles',
          selectedTitle: 'Sélectionnés',
          addButtonText: '>',
          removeButtonText: '<',
          addAllButtonText: '>>',
          removeAllButtonText: '<<',
          options: options
        });
        $('.dual-listbox__search').addClass('form-control');
      }
    });
  });


  $('#create-room-modal-btn').click(() => {
    if ($('#room-name').val() == '') {
      $('#create-room-modal-alert').html('<span class="text-danger">Renseigne le nom du salon</span>');
    } else if (dlb.selected.length < 1) {
      $('#create-room-modal-alert').html('<span class="text-danger">Sélectionne au moins un pack</span>');
    } else {
      $('#create-room-modal-alert').empty();
      createRoom();
    }
  });

  function createRoom() {
    let packs = [];
    for (let s of dlb.selected) {
      packs.push(s.dataset.id);
    }
    packs.push(2);

    $.ajax({
      type: "POST",
      url: "api/room_create.php",
      data: {
        pname: getCookie('pname'),
        token: getCookie('token'),
        name: $('#room-name').val(),
        nbRounds: $('#nb-rounds').val(),
        roundDuration: $('#round-duration').val(),
        celebrationDuration: $('#celebration-duration').val(),
        packs: packs
      }
    }).done((r) => {
      if (!r.success) {
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              $('#create-room-modal-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            default:
              $('#create-room-modal-alert').text('Erreur création du salon :(');
          }
        }
      } else {
        setCookie('token', r.response.token, 4);
        location.href = "index.php?action=play";
      }
    });
  };
</script>