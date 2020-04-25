jQuery('#login').submit((e) => {
    e.preventDefault();

    let pname = jQuery('#pseudo').val();
    let pass = jQuery('#passwd').val();

    jQuery.ajax({
        type: "POST",
        url: "api/player_login.php",
        data: {
            pname: pname,
            pass: pass,
        }
    }).done((r) => {
        if (r.success) {
            setCookie('pname', pname, 4);
            setCookie('token', r.response.token, 4);
            location.href = "index.php?action=welcome";
        } else if (r.errors[0].code == 203) {
            jQuery('#register-info').text("Pseudo inconnu :(");
        } else if (r.errors[0].code == 403) {
            jQuery('#register-info').text("Mauvais mot de passe :(");
        } else {
            jQuery('#register-info').text("Erreur à l'authentification :(");
        }
    });
});