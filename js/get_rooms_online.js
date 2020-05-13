$(document).ready(() => {
  let ro = new RoomsOnline();
  ro.refresh();
  setInterval(ro.refresh, 5000);
});

function RoomsOnline() {
  this.data;

  this.refresh = () => {
    $.ajax({
      type: "GET",
      url: "api/rooms_online.php"
    }).done((r) => {
      if (r.success && this.mustBeRefreshed(r.response)) {
        $('#lezalons ul').empty();
        this.data = r.response.online;
        let rooms = this.data.slice();
        let itv = setInterval(() => {

          let r = rooms.pop();

          if (r === undefined) {
            clearInterval(itv);
          } else {
            $('#lezalons ul').append(`
            <li class="fade-in">
              <a onclick="goToRoom(${µ(r.id_room)})">
                ${µ(r.name)} <span class="txt-gold">#${µ(r.id_room)}</span>
              </a>
            </li>
          `);
          }

        }, 50);

      }
    });

  };

  this.mustBeRefreshed = (r) => {
    if (this.data == undefined)
      return true;

    if (r.online == undefined)
      return true;
      
    if (r.online.length != this.data.length)
      return true;

    let oldR = this.data.map((e) => e.id_room);
    let newR = r.online.map((e) => e.id_room);

    oldR = oldR.concat().sort();
    newR = newR.concat().sort();

    for (var i = 0; i < oldR.length; i++) {
      if (oldR[i] !== newR[i])
        return true;
    }
    return false;
  };
}

function goToRoom(idRoom) {
  $.ajax({
    type: "POST",
    url: "api/room_join.php",
    data: {
      idroom: idRoom,
      pname: getCookie('pname'),
      token: getCookie('token')
    }
  }).done((r) => {
    if (r.success) {
      setCookie('token', r.response.token, 4);
      location.href = "/index.php?action=play";
    } else {
      for (let e of r.errors) {
        switch (e.code) {
          case 101:
            $('#form-fullscreen-alert').text(`Paramètre manquant: ${µ(e.message)}`);
            break;
          case 203:
            $('#form-fullscreen-alert').text('Erreur salon inexistant');
            break;
          case 401:
          case 403:
            location.href = `/index.php?action=login&join=${µ(idroom)}`;
            break;
          default:
            $('#form-fullscreen-alert').text('Erreur accès au salon :(');
        }
      }
    }
  });
}