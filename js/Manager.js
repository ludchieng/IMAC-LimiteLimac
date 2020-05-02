var manager;
var dlb;

document.addEventListener('DOMContentLoaded', () => {
  manager = new Manager();

  /*dlb = new DualListbox('#select-packs', {
    addEvent: function (value) {
      //console.log(value);
    },
    removeEvent: function (value) {
      //console.log(value);
    },
    availableTitle: 'Disponibles',
    selectedTitle: 'Sélectionnés',
    addButtonText: '>',
    removeButtonText: '<', addAllButtonText: '>>',
    removeAllButtonText: '<<'
  });
  jQuery('.dual-listbox__search').addClass('form-control');*/
});

jQuery('#search-card').keyup((e) => {
  let dom = jQuery(e.currentTarget);
  manager.search = dom.val().toLowerCase();
  manager.domRefreshCards();
});

jQuery('#show-white').click((e) => {
  manager.domRefreshCards();
});

jQuery('#show-black').click((e) => {
  manager.domRefreshCards();
});