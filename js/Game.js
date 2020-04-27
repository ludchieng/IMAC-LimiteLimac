function Game(pname, token) {
  this.pname = pname;
  this.token = token;
  this.isReady = false;
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
    let idCard = this.wCards[dom.data('number')].id_card;
    //TODO choose select / deselect
    jQuery.ajax({
      type: "POST", url: "api/player_card_select.php",
      data: { pname: this.pname, token: this.token, idcard: idCard }
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
    dom.toggleClass('white-card-selected');
  }

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
  }

  this.clockStop = () => {
    clearInterval(this.remainingTimeItv);
    this.remainingTimeItv = undefined;
    jQuery('#room-time-min').text('••');
    jQuery('#room-time-sec').text('••');
  }

  this.update = (r) => {
    console.log(r);
    jQuery("#game").attr('data-status', r.status);
    this.domRefreshPlayers(r);
    switch (r.status) {
      case 'STANDBY':
        this.clockStop();
        break;
      case 'PLAYING_ROUND':
        this.domRefreshCards(r);
        this.clock(r.remainingTime);
        break;
      case 'END_ROUND':
        this.clockStop();
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
          <div class="white-card" data-number="${i}">
              <img src="img/imac-uni-darkblue.svg">
              <p class="white-card-content">${wcR.content}</p>
          </div>
        `);
      }
      jQuery('.white-card').click(apiToggleCard);
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
    /*for (let i = 0; i < this.players.length; i++) {
      let pR = r.players[i];
      let pT = this.players[i];
    }*/
  };
}