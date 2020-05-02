document.addEventListener('DOMContentLoaded', () => {
  if (null == getCookie('pname')) {
    jQuery('#btn-signout').addClass('btn-hidden');
    jQuery('#btn-user').addClass('btn-hidden');
  } else {
    jQuery('#btn-signout').removeClass('btn-hidden');
    jQuery('#btn-user').removeClass('btn-hidden');
  }
});

jQuery('#btn-play').click(() => {
  location.href = 'index.php?action=welcome';
});

jQuery('#btn-signout').click(() => {
  delCookie('pname');
  delCookie('token');
  location.href = 'index.php';
});