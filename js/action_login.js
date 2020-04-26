jQuery('#login').submit((e) => {
    e.preventDefault();
    login(true);
});

function login(requireHTTPS) {
    if (requireHTTPS && !isCertifiedConnection()) {
        jQuery('#form-fullscreen-info').html(`
            Sans HTTPS, votre mot de passe se balade dans la nature, continuer ? 
            <button id="login-force" class="form-fullscreen-info-btn">Oui</button>`
        );
        jQuery('#login-force').click((e) => {
            e.preventDefault();
            login(false);
        });
    } else {
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
                jQuery('#form-fullscreen-info').text("Pseudo inconnu :(");
            } else if (r.errors[0].code == 403) {
                jQuery('#form-fullscreen-info').text("Mauvais mot de passe :(");
            } else {
                jQuery('#form-fullscreen-info').text("Erreur à l'authentification :(");
            }
        });
    }
}