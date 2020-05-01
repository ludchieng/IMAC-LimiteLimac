(function Manager() {
  this.data;

  (this.apiGetCards = () => {
    jQuery.ajax({
      type: 'GET',
      url: 'api/cards_list.php'
    }).done((r) => {
      this.data = r.response.data;
      for (let i in this.data) {
        let p = this.data[i];
        jQuery('#card-panel').append(`<div class="card-pack" data-id="${i}"></div>`);
        let domPack = jQuery(`.card-pack[data-id="${i}"]`);
        domPack.append(`<h2>${p.name}</h2>`);
        for (let c of p.cards) {
          let isBlack = c.id_card.charAt(0) === 'B';
          domPack.append(`
            <div class="card card-${isBlack ? 'black' : 'white'}">
                <img class="card-icon" src="img/imac-uni-${(isBlack ? 'white' : 'darkblue')}.svg">
                <p class="card-content">${c.content}</p>
                <span class="card-author">${c.pname}</span>
            </div>
          `);
        }
      }
      jQuery('.card').click((e) => {
        let dom = jQuery(e.currentTarget);
        if (dom.hasClass('card-selected'))
          dom.removeClass('card-selected');
        else
          dom.addClass('card-selected');
      });
    });
  })();
})();