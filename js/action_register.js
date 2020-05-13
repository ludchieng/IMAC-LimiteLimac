$('#register').submit((e) => {
  e.preventDefault();
  register(true);
});

function register(requireHTTPS = true) {
  if (requireHTTPS && !isCertifiedConnection()) {
    $('#form-fullscreen-alert').html(`
      Sans HTTPS, ton mot de passe se balade dans la nature, continuer ? 
      <button id="register-force" class="form-fullscreen-alert-btn">Of crous</button>`
    );
    $('#register-force').click((e) => {
      e.preventDefault();
      register(false);
    });
  } else {
    let pname = $('#pseudo').val();
    let pass = $('#passwd').val();
    let vpass = $('#vpasswd').val();

    if (pass !== vpass) {
      $('#form-fullscreen-alert').text('Les mots de passe ne correspondent pas :(');
    } else {
      $.ajax({
        type: "POST",
        url: "api/player_create.php",
        data: {
          pname: pname,
          pass: pass,
        }
      }).done((r) => {
        if (r.success) {
          setCookie('pname', pname, 4);
          setCookie('token', r.response.token, 4);
          setCookie('color', r.response.color, 24 * 7);
          if (undefined === getParam('join')) {
            goToHub();
          } else {
            goToRoom();
          }
        } else {
          for (let e of r.errors) {
            switch (e.code) {
              case 101:
                $('#form-fullscreen-alert').text("Renseigne le pseudo et le mot de passe");
                break;
              case 202:
                $('#form-fullscreen-alert').text('Ce pseudo est déjà pris :(');
                break;
              default:
                $('#form-fullscreen-alert').text("Quelque chose s'est mal passé :(");
            }
          }
        }
      });
    }
  }
};

function goToHub() {
  location.href = "/index.php?action=hub";
}

function goToRoom() {
  $.ajax({
    type: "POST",
    url: "api/room_join.php",
    data: {
      idroom: getParam('join'),
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
            $('#form-fullscreen-alert').text('Erreur salon inexistant');
            break;
          case 401:
          case 403:
            location.href = `/index.php?action=login&join=${µ(idroom)}`;
            break;
          default:
            $('#form-fullscreen-alert').text('Erreur accès au salon :(');
        }
      }
    }
  });
}