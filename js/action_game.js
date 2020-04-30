var game;
var itv;

$(document).ready(() => {
  game = new Game(getCookie('pname'), getCookie('token'));
  game.apiPing();
  itv = setInterval(game.apiPing, 2000);
  
  jQuery('#game-ready-btn').click((e) => {
    if (game.me.isReady == true) {
      game.playerDot.css('background-color', 'transparent');
    } else {
      game.playerDot.css('background-color', `#${game.me.color}`);
    }
    jQuery(e.currentTarget).toggleClass('game-ready-btn-active');
    game.apiSetReady(!game.me.isReady);
  })
});