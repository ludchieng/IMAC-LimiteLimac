$(document).ready(() => {

  jQuery.ajax({
      type: "GET",
      url: "api/users_online.php"
  }).done((r) => {
    if (r.success) {

      let users = r.response.online;
      let itv = setInterval(() => {

        let u = users.pop();
        
        if (u.pname != getCookie('pname')) {
          jQuery('#lezami ul').append(`
          <li class="fade-in">
              <div class="dot" style="background-color: #${u.color}"></div>
              <p>${u.pname}</p>
          </li>`);
        }

        if (users.length == 0) 
          clearInterval(itv);

      }, 50);
      
    } else {
      console.log("Erreur api users online");
    }

  });

});