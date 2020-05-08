jQuery('#login').submit((e) => {
    e.preventDefault();
    login(true);
});

function login(requireHTTPS) {
    if (requireHTTPS && !isCertifiedConnection()) {
        jQuery('#form-fullscreen-info').html(`
            Sans HTTPS, ton mot de passe se balade dans la nature, continuer ? 
            <button id="login-force" class="form-fullscreen-info-btn">Of crous</button>`
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
                setCookie('color', r.response.color, 24 * 7);
                location.href = "index.php?action=welcome";
            } else {
                for (let e of r.errors) {
                    switch (e.code) {
                        case 101:
                            jQuery('#form-fullscreen-info').text("Renseigne le pseudo et le mot de passe");
                            break;
                        case 203:
                            jQuery('#form-fullscreen-info').text("Pseudo inconnu :(");
                            break;
                        case 403:
                            jQuery('#form-fullscreen-info').text("Mauvais mot de passe :(");
                            break;
                        default:
                            jQuery('#form-fullscreen-info').text("Erreur à l'authentification :(");
                    }
                }
            }
        });
    }
}