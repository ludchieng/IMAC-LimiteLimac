$('#initForm').submit((e) => {
    e.preventDefault();
  
    let pname = document.getElementById('pseudo').value;
    let pass = document.getElementById('passwd').value;
    
  
   
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
    
  });