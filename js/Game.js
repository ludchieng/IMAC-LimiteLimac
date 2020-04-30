function Game(pname, token) {
  this.pname = pname;
  this.token = token;
  this.isReady = false;
  this.isGameMaster;
  this.bCard;
  this.wCards = [];
  this.players = [];
  this.remainingTime;
  this.remainingTimeItv;

  this.count = 0;

  this.apiSetReady = (value) => {
    jQuery.ajax({
      type: "POST", url: "api/player_set_ready.php",
      data: { pname: this.pname, token: this.token, ready: value }
    }).done((r) => {
      if (!r.success) {
        throw r.errors[0].message;
      } else {
        if (r.response.isReady == 1) {
          jQuery("#game-ready-btn").addClass('game-ready-btn-active');
        } else {
          jQuery("#game-ready-btn").removeClass('game-ready-btn-active');
        }
        this.isReady = r.response.isReady;
      }
    });
  };

  this.apiToggleCard = (event) => {
    let dom = jQuery(event.currentTarget);
    dom.toggleClass('white-card-selected');
    let idCard = this.wCards[dom.data('number')].id_card;
    jQuery.ajax({
      type: "POST", url: "api/player_card_toggle.php",
      data: { pname: this.pname, token: this.token, idcard: idCard }
    }).done((r) => {
      if (!r.success) {
        throw r.errors[0].message;
      } else {
        jQuery('.white-card').removeClass('white-card-selected');
        for (let sc of r.response.selected) {
          jQuery(`.white-card[data-id="${sc.id_card}"]`).addClass('white-card-selected');
        }
      }
    });
  };

  this.apiSelectWinner = (event) => {
    //TODO
  };

  this.apiPing = () => {
    jQuery.ajax({
      type: "GET", url: "api/player_ping.php",
      data: { pname: getCookie('pname'), token: getCookie('token') }
    }).done((r) => {
      if (!r.success) {
        throw r.errors[0].message;
      } else {
        this.count++;
        if (r.response.stillInGame == 'false') {
          //TODO remove
          throw 'kicked from room';
          location.href = "index.php?action=welcome&message=disconnected";
        }
        this.update(r.response);
      }
    });
  };

  this.clock = (time) => {
    if (undefined == this.remainingTimeItv) {
      this.remainingTimeItv = setInterval(() => {
        this.remainingTime -= 0.199;
        this.domRefreshTime();
      }, 199);
    }
    this.remainingTime = time;
  };

  this.clockStop = () => {
    clearInterval(this.remainingTimeItv);
    this.remainingTimeItv = undefined;
    jQuery('#room-time-min').text('••');
    jQuery('#room-time-sec').text('••');
  };

  this.update = (r) => {
    console.log(r);
    me = r.players.find((e) => e.pname == this.pname);
    this.isGameMaster = me.isGameMaster;
    jQuery("#game").attr('data-status', r.status);
    jQuery("#game").attr('data-role', me.isGameMaster ? "gamemaster" : "player");
    this.domRefreshPlayers(r);
    switch (r.status) {
      case 'STANDBY':
        if (this.isReady = me.isReady == true) {
          jQuery("#game-ready-btn").addClass('game-ready-btn-active');
        } else {
          jQuery("#game-ready-btn").removeClass('game-ready-btn-active');
        }
        this.clockStop();
        break;
      case 'PLAYING_ROUND':
        jQuery('#end-round-panel').html('');
        this.domRefreshCards(r);
        this.clock(r.remainingTime);
        break;
      case 'END_ROUND':
        this.clockStop();
        this.domRefreshEndRoundPanel(r);
        break;
    }
  };

  this.domRefreshCards = (r) => {
    if (undefined == r.blackCard.id_card) {
      jQuery('#black-card-content').text('');
    } else if (undefined == this.bCard || this.bCard.id_card != r.blackCard.id_card) {
      jQuery('#black-card-content').text(r.blackCard.content);
    }
    this.bCard = r.blackCard;

    if (this.wCards.length != r.whiteCards.length) {
      this.wCards = r.whiteCards;
      jQuery('#white-cards-panel').html('');
      for (let i = 0; i < r.whiteCards.length; i++) {
        let wcR = r.whiteCards[i];
        jQuery('#white-cards-panel').append(`
          <div class="white-card${wcR.isSelected ? ' white-card-selected' : ''}" data-number="${i}" data-id="${wcR.id_card}">
              <img class="white-card-icon" src="img/imac-uni-darkblue.svg">
              <p class="white-card-content">${wcR.content}</p>
          </div>
        `);
      }
      jQuery('#white-cards-panel .white-card').click(this.apiToggleCard);
    }
  };

  this.domRefreshTime = () => {
    let t = this.remainingTime.toFixed(0);
    let min = (t / 60).toFixed(0);
    let sec = t % 60 > 9 ? t % 60 : "0" + t % 60;
    jQuery('#room-time-min').text(min);
    jQuery('#room-time-sec').text(sec);
  };

  this.domRefreshPlayers = (r) => {
    if (this.players.length !== r.players.length) {
      this.players = r.players;
      let ul = jQuery('#room-players ul');
      ul.text('');
      for (let p of r.players) {
        ul.append(`
          <li class="fade-in" data-pname="${p.pname}">
            <div class="room-players-dot"></div>
            <p>${p.pname}</p>
          </li>
        `);
        li = ul.find(`li[data-pname="${p.pname}"] .room-players-dot`);
        li.css('background-color', '#' + p.color);
        li.css('border-color', '#' + p.color);
      }
    }
    //li.css('border-width', '').css('background-color', 'transparent')
  };

  this.domRefreshEndRoundPanel = (r) => {
    jQuery('#end-round-panel').html('');
    let ps = r.players;
    for (let p of ps) {
      if (p.isGameMaster == false) {
        for (let sc of p.selected) {
          jQuery('#end-round-panel').append(`
            <div class="white-card" data-id="${sc.id_card}">
              <p class="white-card-content">${sc.content}</p>
              <svg viewBox="0 0 380 304" class="white-card-icon"><defs><style>.bg{fill:#${p.color};}</style></defs><g><g><g><path class="bg" d="M228,152,152,76l38-38L152,0,114,38,76,0,38,38,76,76,0,152l76,76L38,266l38,38,38-38,38,38,38-38-38-38ZM76,152l38-38,38,38-38,38Z"></path><polygon class="bg" points="228 0 190 38 304 152 190 266 228 304 380 152 228 0"></polygon></g></g></g></svg>
              <span class="white-card-footer">${p.pname}</span>
            </div>
          `);
        }
        jQuery('#end-round-panel .white-card').click(this.apiSelectWinner);
      }
    }
  };
}