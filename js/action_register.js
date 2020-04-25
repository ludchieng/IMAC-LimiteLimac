jQuery('#register').submit((e) => {
  e.preventDefault();

  let pname = jQuery('#pseudo').val();
  let pass = jQuery('#passwd').val();
  let vpass = jQuery('#vpasswd').val();

  if (pass !== vpass) {
    jQuery('#register-info').text('Les mots de passe ne correspondent pas :(');
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
        jQuery('#register-info').text('Ce pseudo est déjà pris :(');
      } else {
        jQuery('#register-info').text("Quelque chose s'est mal passé :(");
      }
    });
  }
});