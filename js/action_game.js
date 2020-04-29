var game;
var itv;

$(document).ready(() => {
  game = new Game(getCookie('pname'), getCookie('token'));
  game.apiPing();
  itv = setInterval(game.apiPing, 2000);
  
  jQuery('#game-ready-btn').click((e) => {
    jQuery(e.currentTarget).toggleClass('game-ready-btn-active');
    game.apiSetReady(!game.isReady);
  })
});