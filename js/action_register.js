$('#register').submit((e) => {
  e.preventDefault();

  let pname = document.getElementById('pseudo').value;
  let pass = document.getElementById('passwd').value;
  let vpass = document.getElementById('vpasswd').value;

  if (pass !== vpass) {
    document.getElementById('register-info').innerText = 'Les mots de passe ne correspondent pas :(';
  } else {
    jQuery.ajax({
      type: "POST",
      url: "api/player_create.php",
      data: {
        pname: pname,
        pass: pass,
      }
    }).done( (r) => {
      if (r.success) {
        window.location.replace("index.php?action=registerGo");
      } else {
        document.getElementById('register-info').innerText = 'Ce pseudo est déjà pris :(';
      }
    });
  }
});