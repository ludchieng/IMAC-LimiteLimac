$(document).ready(() => {
  if (null == getCookie('pname')) {
    $('#btn-signout').addClass('btn-hidden');
    $('#btn-user').addClass('btn-hidden');
    $('#btn-edit').addClass('btn-hidden');
  } else {
    $('#btn-signout').removeClass('btn-hidden');
    $('#btn-user').removeClass('btn-hidden');
    $('#btn-edit').removeClass('btn-hidden');
  }
});

$('#btn-play').click(() => {
  location.href = '/index.php?action=hub';
});

$('#btn-edit').click(() => {
  location.href = 'manager.php';
});

$('#btn-signout').click(() => {
  delCookie('pname');
  delCookie('token');
  location.href = 'index.php';
});