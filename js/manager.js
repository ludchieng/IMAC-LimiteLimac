var manager;

$(document).ready(() => {
  manager = new Manager();

  $('#btn-home').click(() => {
    location.href = 'index.php';
  });
  
  $('#btn-play').click(() => {
    location.href = 'index.php?action=welcome';
  });
  
  $('#search-card').keyup((e) => {
    let dom = $(e.currentTarget);
    manager.search = dom.val().toLowerCase();
    manager.domRefreshCards();
  });
  
  $('#show-white').click(() => {
    manager.domRefreshCards();
  });
  
  $('#show-black').click(() => {
    manager.domRefreshCards();
  });

  $('#create-white').click(() => {
    let domCreate = $('#card-create-container');
    domCreate.removeClass('hidden');
    domCreate.find('.card').removeClass('card-black');
    domCreate.find('.card').addClass('card-white');
    domCreate.find('.card-icon-dark').removeClass('hidden');
    domCreate.find('.card-icon-light').addClass('hidden');
  });

  $('#create-black-1').click(() => {
    let domCreate = $('#card-create-container');
    domCreate.removeClass('hidden');
    domCreate.find('.card').removeClass('card-white');
    domCreate.find('.card').addClass('card-black');
    domCreate.find('.card-icon-dark').addClass('hidden');
    domCreate.find('.card-icon-light').removeClass('hidden');
  });

  $('#create-black-2').click(() => {
    let domCreate = $('#card-create-container');
    domCreate.removeClass('hidden');
    domCreate.find('.card').removeClass('card-white');
    domCreate.find('.card').addClass('card-black');
    domCreate.find('.card-icon-dark').addClass('hidden');
    domCreate.find('.card-icon-light').removeClass('hidden');
  });

  $('#btn-card-create').click(manager.apiCardCreate);

  $('#card-edit-submit').click(manager.apiCardEdit);

  $('#card-edit-delete').click(manager.apiCardDelete);
});