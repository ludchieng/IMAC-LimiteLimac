function Manager() {
  this.data;
  this.search = jQuery('#search-card').val().toLowerCase();

  (this.apiGetCards = () => {
    jQuery.ajax({
      type: 'GET',
      url: 'api/cards_list.php'
    }).done((r) => {
      this.data = r.response.data;
      this.domSetData();
      this.domRefreshCards();
    });
  })();

  this.domSetData = () => {
    jQuery('#card-panel').empty();
    for (let i in this.data) {
      let p = this.data[i];

      jQuery('#card-panel').append(`<div class="card-pack" data-id="${i}"></div>`);
      let domPack = jQuery(`.card-pack[data-id="${i}"]`);
      domPack.append(`
        <div class="card-pack-header">
          <h2>${p.name}</h2>
          <div class="card-pack-author">${p.pname ? '' : '(par défaut)'}</div>
        </div>
      `);

      jQuery('#select-packs').append(`
        <div class="col-6 custom-control custom-checkbox">
          <input type="checkbox" class="form-control custom-control-input" id="select-packs-${i}" data-id="${i}" checked>
          <label class="custom-control-label" for="select-packs-${i}">${p.name}</label>
        </div>
      `);

      for (let c of p.cards) {
        let isBlack = c.id_card.charAt(0) === 'B';
        domPack.append(`
          <div class="card card-${isBlack ? 'black' : 'white'}" data-id="${c.id_card}">
            <img class="card-icon" src="img/imac-uni-${(isBlack ? 'white' : 'darkblue')}.svg">
            <p class="card-content">${c.content}</p>
            <span class="card-author"></span>
          </div>
        `);
      }
    }

    jQuery('#select-packs input').click((e) => {
      let dom = jQuery(e.currentTarget);
      let idPack = dom.data('id');
      if (dom.is(':checked')) {
        jQuery(`.card-pack[data-id="${idPack}"]`).removeClass('hidden');
      } else {
        jQuery(`.card-pack[data-id="${idPack}"]`).addClass('hidden');
      }
      this.domRefreshInfo();
    });

    jQuery('main .card').click((e) => {
      let dom = jQuery(e.currentTarget);
      if (dom.hasClass('card-selected'))
        dom.removeClass('card-selected');
      else
        dom.addClass('card-selected');
    });
  };

  this.domRefreshCards = () => {
    for (let i in this.data) {
      let p = this.data[i];

      for (let c of p.cards) {
        isVisible = -1 != c.content.toLowerCase().indexOf(this.search);
        if (c.id_card.charAt(0) == 'B') {
          isVisible = isVisible && jQuery('#show-black').is(':checked');
        } else {
          isVisible = isVisible && jQuery('#show-white').is(':checked');
        }
        if (!isVisible) {
          jQuery(`.card[data-id="${c.id_card}"]`).addClass('hidden');
        } else {
          jQuery(`.card[data-id="${c.id_card}"]`).removeClass('hidden');
        }
      }
      /*if (0 == jQuery(`.card-pack[data-id="${p.id_pack}"] .card:not(.hidden)`).length) {
        // No card shown in this pack
        jQuery(`.card-pack[data-id="${i}"]`).addClass('hidden');
      } else {
        jQuery(`.card-pack[data-id="${i}"]`).removeClass('hidden');
      }*/
      this.domRefreshInfo();
    }
  };

  this.domRefreshInfo = () => {
    if (0 == jQuery('.card:not(.hidden)').length
      || 0 == jQuery('.card-pack:not(.hidden)').length) {
      // No pack shown
      jQuery('#info').removeClass('hidden');
    } else {
      jQuery('#info').addClass('hidden');
    }
  };
}