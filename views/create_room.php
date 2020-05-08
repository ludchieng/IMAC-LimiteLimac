<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
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
              <input type="number" class="form-control form-control-sm" id="nb-rounds" value="8">
            </div>
          </div>

          <div class="row">
            <label for="round-duration" class="col-sm-5 text-right col-form-label">Durée du Round</label>
            <div class="col-sm-7">
              <input type="number" class="form-control form-control-sm" id="round-duration" value="45">
            </div>
          </div>

          <div class="row">
            <label for="celebration-duration" class="col-sm-5 text-right col-form-label">Durée de Transition</label>
            <div class="col-sm-7">
              <input type="number" class="form-control form-control-sm" id="celebration-duration" value="6">
            </div>
          </div>

          <div>
            <h5 class="mt-4">Packs de cartes</h5>

            <select id="select-packs" multiple></select>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button id="room-create-modal-btn" type="button" class="btn btn-primary">Créer</button>
      </div>
    </div>
  </div>
</div>

<script>
  jQuery('#create-button').click(() => {
    jQuery('.dual-listbox.select-packs').remove();
    jQuery.ajax({
      type: "GET",
      url: "api/card_packs_list.php"
    }).done((r) => {
      if (!r.success) {
        jQuery('#room-create-modal-info').text('Erreur récupération des packs :(');
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
      }
    });
    jQuery('.dual-listbox__search').addClass('form-control');
  });

  jQuery('#room-create-modal-btn').click(() => {
    let packs = [];
    for (let s of dlb.selected) {
      packs.push(s.dataset.id);
    }
    packs.push(2);

    jQuery.ajax({
      type: "POST",
      url: "api/room_create.php",
      data: {
        pname: getCookie('pname'),
        token: getCookie('token'),
        name: jQuery('#room-name').val(),
        nbRounds: jQuery('#nb-rounds').val(),
        roundDuration: jQuery('#round-duration').val(),
        celebrationDuration: jQuery('#celebration-duration').val(),
        packs: packs
      }
    }).done((r) => {
      if (!r.success) {
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              jQuery('#room-create-modal-info').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            default:
              jQuery('#room-create-modal-info').text('Erreur création du salon :(');
          }
        }
      } else {
        setCookie('token', r.response.token, 4);
        location.href = "index.php?action=player";
      }
    });
  });
</script>