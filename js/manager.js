var manager;
var dlb;

document.addEventListener('DOMContentLoaded', () => {
  manager = new Manager();

  jQuery('#btn-home').click(() => {
    location.href = 'index.php';
  });
  
  jQuery('#btn-play').click(() => {
    location.href = 'index.php?action=welcome';
  });
  
  jQuery('#search-card').keyup((e) => {
    let dom = jQuery(e.currentTarget);
    manager.search = dom.val().toLowerCase();
    manager.domRefreshCards();
  });
  
  jQuery('#show-white').click(() => {
    manager.domRefreshCards();
  });
  
  jQuery('#show-black').click(() => {
    manager.domRefreshCards();
  });

  jQuery('#create-white').click(() => {
    let domCreate = jQuery('#card-create-container');
    domCreate.removeClass('hidden');
    domCreate.find('.card').removeClass('card-black');
    domCreate.find('.card').addClass('card-white');
    domCreate.find('.card-icon-dark').removeClass('hidden');
    domCreate.find('.card-icon-light').addClass('hidden');
  });

  jQuery('#create-black-1').click(() => {
    let domCreate = jQuery('#card-create-container');
    domCreate.removeClass('hidden');
    domCreate.find('.card').removeClass('card-white');
    domCreate.find('.card').addClass('card-black');
    domCreate.find('.card-icon-dark').addClass('hidden');
    domCreate.find('.card-icon-light').removeClass('hidden');
  });

  jQuery('#create-black-2').click(() => {
    let domCreate = jQuery('#card-create-container');
    domCreate.removeClass('hidden');
    domCreate.find('.card').removeClass('card-white');
    domCreate.find('.card').addClass('card-black');
    domCreate.find('.card-icon-dark').addClass('hidden');
    domCreate.find('.card-icon-light').removeClass('hidden');
  });

  jQuery('#btn-card-create').click(manager.apiCardCreate);

  jQuery('#card-edit-submit').click(manager.apiCardEdit);

  jQuery('#card-edit-delete').click(manager.apiCardDelete);
});