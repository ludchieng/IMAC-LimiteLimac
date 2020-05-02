document.addEventListener('DOMContentLoaded', () => {

  jQuery.ajax({
    type: "GET",
    url: "api/rooms_online.php"
  }).done((r) => {
    if (r.success) {

      let rooms = r.response.online;
      let itv = setInterval(() => {

        let r = rooms.pop();

        if (r === undefined) {
          clearInterval(itv);
        } else {
          jQuery('#lezalons ul').append(`
          <li class="fade-in">
            ${µ(r.name)}</span>
          </li>
        `);
        }

      }, 50);

    } else {
      console.log("Erreur api rooms online");
    }

  });

});