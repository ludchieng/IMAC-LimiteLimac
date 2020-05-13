$('#btn-edit').click(() => {
  location.href = 'manager.php';
});

$('#btn-signout').click(() => {
  delCookie('pname');
  delCookie('token');
  location.href = 'index.php';
});

$("#join-room-btn").click(() => {
  $("#room-join").css('display', "inline-block");
  $("#room-join").addClass('fade-in');
  $("#room-create").css('display', "none");
});


// Ajax join room
$('#room-join').submit((e) => {
  e.preventDefault();

  let idroom = $('#room-join input').val();
  if (idroom != "") {
    if (null == getCookie('pname')) {
      location.href = "/index.php?action=login";
    }
    if (null == getCookie('token')) {
      location.href = "/index.php?action=login";
    }
    $.ajax({
      type: "POST",
      url: "api/room_join.php",
      data: {
        idroom: idroom,
        pname: getCookie('pname'),
        token: getCookie('token')
      }
    }).done((r) => {
      if (r.success) {
        setCookie('token', r.response.token, 4);
        location.href = "/index.php?action=play";
      } else {
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              $('#room-join-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            case 203:
              $('#room-join-alert').text('Erreur salon inexistant');
              break;
            case 401:
            case 403:
              location.href = `/index.php?action=login&join=${µ(idroom)}`;
              break;
            default:
              $('#room-join-alert').text('Erreur accès au salon :(');
          }
        }
      }
    });
  }
});