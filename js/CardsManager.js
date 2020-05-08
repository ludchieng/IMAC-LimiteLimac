function Manager() {
  this.pname = getCookie('pname');
  this.token = getCookie('token');
  this.data;
  this.search = $('aside #search-card').val().toLowerCase();
  this.selected;

  (this.apiGetCards = () => {
    $.ajax({
      type: 'GET',
      url: 'api/cards_list.php'
    }).done((r) => {
      this.data = r.response.data;
      this.domSetData();
      this.domRefreshCards();
    });
  })();

  this.apiCardCreate = () => {
    $.ajax({
      type: 'POST',
      url: 'api/card_create.php',
      data: {
        pname: this.pname,
        token: this.token,
        content: $('#card-create-content').text(),
        type: $('input[name="card-create"]:checked').val()
      }
    }).done((r) => {
      if (!r.success) {
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              $('#manager-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            case 401:
            case 403:
              $('#manager-alert').text("Échec de l'authentification");
              break;
            default:
              $('#manager-alert').text('Erreur création de carte :(');
          }
        }
      } else {
        let c = r.response.card;
        if (undefined === this.data[c.id_pack]) {
          this.data[c.id_pack] = {
            cards: [],
            name: r.response.pack.name,
            id_pack: r.response.pack.id_pack
          };
        }
        this.data[c.id_pack].cards.push(c);
        let domPack = $(`.card-pack[data-id="${µ(c.id_pack)}"]`);
        let isBlack = c.id_card.charAt(0) === 'B';
        domPack.append(`
          <div class="card card-${µ(isBlack ? 'black' : 'white')} card-selectable" data-id="${µ(c.id_card)}">
            <img class="card-icon" src="img/imac-uni-${µ(isBlack ? 'white' : 'darkblue')}.svg">
            <p class="card-content">${µ(c.content)}</p>
            <span class="card-author"></span>
          </div>
        `);
        $(`main .card[data-id="${µ(c.id_card)}"]`).click(this.onClickCard);

        if (r.response.hasCreatedPack == true) {
          this.domSetData();
        }
      }
    });
  };

  this.apiCardEdit = () => {
    $.ajax({
      type: 'POST',
      url: 'api/card_edit.php',
      data: {
        pname: this.pname,
        token: this.token,
        idcard: this.selected.data('id'),
        content: $('#card-edit-content').text()
      }
    }).done((r) => {
      if (!r.success) {
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              $('#manager-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            case 400:
              $('#manager-alert').text(`Requête non autorisé: ${µ(e.message)}`);
              break;
            case 401:
            case 403:
              $('#manager-alert').text("Échec de l'authentification");
              break;
            default:
              $('#manager-alert').text('Erreur édition de carte :(');
          }
        }
      } else {
        let c = r.response.card;
        let domCard = $(`.card-pack[data-id="${µ(c.id_pack)}"] .card[data-id="${µ(c.id_card)}"]`);
        domCard.find('.card-content').text(µ(c.content));
      }
    });
  };

  this.apiCardDelete = () => {
    $.ajax({
      type: 'POST',
      url: 'api/card_delete.php',
      data: {
        pname: this.pname,
        token: this.token,
        idcard: this.selected.data('id')
      }
    }).done((r) => {
      if (!r.success) {
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              $('#manager-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            case 400:
              $('#manager-alert').text(`Requête non autorisé: ${µ(e.message)}`);
              break;
            case 401:
            case 403:
              $('#manager-alert').text("Échec de l'authentification");
              break;
            default:
              $('#manager-alert').text('Erreur suppression de carte :(');
          }
        }
      } else {
        let domCard = $(`.card[data-id="${this.selected.data('id')}"]`);
        domCard.remove();
      }
    });
  };

  this.domSetData = () => {
    $('#card-panel').empty();
    $('aside #select-packs').empty();

    for (let i in this.data) {
      let p = this.data[i];

      if (p.name == this.pname) {
        $('#card-panel').prepend(`<div class="card-pack" data-id="${µ(i)}"></div>`);
      } else {
        $('#card-panel').append(`<div class="card-pack" data-id="${µ(i)}"></div>`);
      }
      let domPack = $(`.card-pack[data-id="${µ(i)}"]`);
      domPack.append(`
        <div class="card-pack-header">
          <h2>${µ(p.name)}</h2>
          <div class="card-pack-author"></div>
        </div>
      `);

      $('aside #select-packs').append(`
        <div class="col-6 custom-control custom-checkbox">
          <input type="checkbox" class="form-control custom-control-input" id="select-packs-${µ(i)}" data-id="${µ(i)}" checked>
          <label class="custom-control-label" for="select-packs-${µ(i)}">${µ(p.name)}</label>
        </div>
      `);

      for (let c of p.cards) {
        let isBlack = c.id_card.charAt(0) === 'B';
        domPack.append(`
          <div class="card card-${µ(isBlack ? 'black' : 'white')}${µ(p.name == this.pname ? ' card-selectable' : '')}" data-id="${µ(c.id_card)}">
            <img class="card-icon" src="img/imac-uni-${µ(isBlack ? 'white' : 'darkblue')}.svg">
            <p class="card-content">${µ(c.content)}</p>
            <span class="card-author"></span>
          </div>
        `);
      }
    }

    $('#select-packs input').click((e) => {
      let dom = $(e.currentTarget);
      let idPack = dom.data('id');
      if (dom.is(':checked')) {
        $(`.card-pack[data-id="${µ(idPack)}"]`).removeClass('hidden');
      } else {
        $(`.card-pack[data-id="${µ(idPack)}"]`).addClass('hidden');
      }
      this.domRefreshInfo();
    });

    $('main .card-selectable').click(this.onClickCard);
  };

  this.domRefreshCards = () => {
    for (let i in this.data) {
      let p = this.data[i];

      for (let c of p.cards) {
        isVisible = -1 != c.content.toLowerCase().indexOf(this.search);
        if (c.id_card.charAt(0) == 'B') {
          isVisible = isVisible && $('#show-black').is(':checked');
        } else {
          isVisible = isVisible && $('#show-white').is(':checked');
        }
        if (!isVisible) {
          $(`.card[data-id="${µ(c.id_card)}"]`).addClass('hidden');
        } else {
          $(`.card[data-id="${µ(c.id_card)}"]`).removeClass('hidden');
        }
      }
      /*if (0 == $(`.card-pack[data-id="${µ(p.id_pack)}"] .card:not(.hidden)`).length) {
        // No card shown in this pack
        $(`.card-pack[data-id="${µ(i)}"]`).addClass('hidden');
      } else {
        $(`.card-pack[data-id="${µ(i)}"]`).removeClass('hidden');
      }*/
      this.domRefreshInfo();
    }
  };

  this.domRefreshInfo = () => {
    if (0 == $('.card:not(.hidden)').length
      || 0 == $('.card-pack:not(.hidden)').length) {
      // No pack shown
      $('#info').removeClass('hidden');
    } else {
      $('#info').addClass('hidden');
    }
  };

  this.onClickCard = (e) => {
    $('#card-edit-container').removeClass('hidden');
    $('#card-edit-alert').addClass('hidden');
    if (this.selected !== undefined)
      this.selected.removeClass('card-selected');
    let dom = $(e.currentTarget);
    this.selected = dom;
    if (dom.hasClass('card-selected'))
      dom.removeClass('card-selected');
    else
      dom.addClass('card-selected');
    let domEdit = $('#card-edit .card');
    if (dom.hasClass('card-white')) {
      domEdit.addClass('card-white');
      domEdit.removeClass('card-black');
      domEdit.find('.card-icon-dark').removeClass('hidden');
      domEdit.find('.card-icon-light').addClass('hidden');
    } else {
      domEdit.addClass('card-black');
      domEdit.removeClass('card-white');
      domEdit.find('.card-icon-dark').addClass('hidden');
      domEdit.find('.card-icon-light').removeClass('hidden');
    }
    let content = dom.find('.card-content').text();
    domEdit.find('#card-edit-content').text(content);
  }
}