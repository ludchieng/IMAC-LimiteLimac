$('#join button').hide();

$(document).ready(() => {
  $('#join button').hide();
  let idroom = getParam('idroom');


  $.ajax({
    type: "GET",
    url: "api/room_details.php",
    data: {
      idroom: idroom
    }
  }).done((r) => {
    if (!r.success) {
      for (let e of r.errors) {
        switch (e.code) {
          case 203:
            $('#form-fullscreen-alert').html("Le salon n'existe plus :( <br/>Redirection...");
            break;
        }
      }
      window.setTimeout(() => {
        location.href = "/index.php?action=hub"
      }, 3000);
    } else {
      $('#join button').show();
      $('#room-details').text(r.response.name)
    }
  });

  $('#join').submit((e) => {
    e.preventDefault();

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
              $('#form-fullscreen-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            case 203:
              $('#form-fullscreen-alert').text('Erreur salon inexistant <br/>Redirection...');
              break;
            case 401:
            case 403:
              location.href = `/index.php?action=login&join=${µ(idroom)}`;
              break;
            default:
              $('#form-fullscreen-alert').html('Erreur accès au salon :( <br/>Redirection...');
          }
        }
        delCookie('pname')
        window.setTimeout(() => {
          location.href = "/index.php?action=login"
        }, 3000);
      }
    });

  })
});