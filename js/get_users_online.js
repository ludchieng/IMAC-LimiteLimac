$(document).ready(() => {
  let uo = new UsersOnline();
  uo.refresh();
  setInterval(uo.refresh, 5000);
});

function UsersOnline() {
  this.data;

  this.refresh = () => {
    $.ajax({
      type: "GET",
      url: "api/users_online.php"
    }).done((r) => {
      if (r.success && this.mustBeRefreshed(r.response)) {
        $('#lezami ul').empty();
        this.data = r.response.online;
        let users = this.data.slice();
        let itv = setInterval(() => {

          let u = users.pop();

          if (u === undefined) {
            clearInterval(itv);
          } else {
            $('#lezami ul').append(`
              <li class="fade-in">
                  <div class="dot" style="background-color: #${µ(u.color)}"></div>
                  <p>${µ(u.pname)}</p>
              </li>`);
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

    let oldU = this.data.map((e) => e.pname);
    let newU = r.online.map((e) => e.pname);

    oldU = oldU.concat().sort();
    newU = newU.concat().sort();

    for (var i = 0; i < oldU.length; i++) {
      if (oldU[i] !== newU[i])
        return true;
    }
    return false;
  };
};