var game;
var itv;

$(document).ready(() => {
  game = new Game(getCookie('pname'), getCookie('token'));
  game.apiPing();
  itv = setInterval(game.apiPing, 2000);

  $('#game-ready-btn').click((e) => {
    if (game.me.isReady == true) {
      game.playerDot.css('background-color', 'transparent');
    } else {
      game.playerDot.css('background-color', `#${µ(game.me.color)}`);
    }
    $(e.currentTarget).toggleClass('game-ready-btn-active');
    game.apiSetReady(!game.me.isReady);
  })

  $('#logo').click(() => {
    $.ajax({
      type: "POST", url: "api/room_quit.php",
      data: { pname: getCookie('pname'), token: getCookie('token') }
    }).done((r) => {
      location.href = 'index.php?action=welcome';
    });
  });

  $('#btn-quit').click(() => {
    $.ajax({
      type: "POST", url: "api/room_quit.php",
      data: { pname: getCookie('pname'), token: getCookie('token') }
    }).done((r) => {
      location.href = 'index.php?action=welcome';
    });
  });
});