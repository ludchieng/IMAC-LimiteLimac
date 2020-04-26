$(document).ready(() => {

  jQuery.ajax({
      type: "GET",
      url: "api/rooms_online.php"
  }).done((r) => {
    if (r.success) {

      let rooms = r.response.online;
      let itv = setInterval(() => {

        let r = rooms.pop();
        
        jQuery('#lezalons ul').append(`
          <li class="fade-in">
            ${r.name} <span class="txt-gold">#${r.id_room}</span>
          </li>
        `);

        if (rooms.length == 0) 
          clearInterval(itv);

      }, 50);
      
    } else {
      console.log("Erreur api rooms online");
    }

  });

});