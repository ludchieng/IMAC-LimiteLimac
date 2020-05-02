document.addEventListener('DOMContentLoaded', () => {

  jQuery.ajax({
      type: "GET",
      url: "api/users_online.php"
  }).done((r) => {
    if (r.success) {

      let users = r.response.online;
      let itv = setInterval(() => {
        
        let u = users.pop();

        if (u === undefined) {
          clearInterval(itv);
        } else {
          if (u.pname != getCookie('pname')) {
            jQuery('#lezami ul').append(`
            <li class="fade-in">
                <div class="dot" style="background-color: #${µ(u.color)}"></div>
                <p>${µ(u.pname)}</p>
            </li>`);
          }
        }

      }, 50);
      
    } else {
      console.log("Erreur api users online");
    }

  });

});