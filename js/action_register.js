jQuery('#register').submit((e) => {
  e.preventDefault();
  register(true);
});

function register(requireHTTPS = true) {
  if (requireHTTPS && !isCertifiedConnection()) {
    jQuery('#form-fullscreen-info').html(`
      Sans HTTPS, ton mot de passe se balade dans la nature, continuer ? 
      <button id="register-force" class="form-fullscreen-info-btn">Of crous</button>`
    );
    jQuery('#register-force').click((e) => {
      e.preventDefault();
      register(false);
    });
  } else {
    let pname = jQuery('#pseudo').val();
    let pass = jQuery('#passwd').val();
    let vpass = jQuery('#vpasswd').val();

    if (pass !== vpass) {
      jQuery('#form-fullscreen-info').text('Les mots de passe ne correspondent pas :(');
    } else {
      jQuery.ajax({
        type: "POST",
        url: "api/player_create.php",
        data: {
          pname: pname,
          pass: pass,
        }
      }).done((r) => {
        if (r.success) {
          location.href = "index.php?action=registerGo";
        } else if (r.errors[0].code == 202) {
          jQuery('#form-fullscreen-info').text('Ce pseudo est déjà pris :(');
        } else {
          jQuery('#form-fullscreen-info').text("Quelque chose s'est mal passé :(");
        }
      });
    }
  }
};