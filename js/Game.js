function Game(pname, token) {
  this.pname = pname;
  this.token = token;
  this.me;
  this.bCard;
  this.wCards = [];
  this.selectedCards = [];
  this.players = [];
  this.remainingTime;
  this.remainingTimeItv;
  this.roundCount;
  this.roundCountMax;

  this.count = 0;
  this.playerDot;
  this.info;

  this.updateCookie = () => {
    setCookie('pname', this.pname, 4);
    setCookie('token', this.token, 4);
  };

  this.apiSetReady = (value) => {
    $.ajax({
      type: "POST", url: "api/player_set_ready.php",
      data: { pname: this.pname, token: this.token, ready: value }
    }).done((r) => {
      if (!r.success) {
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              $('#game-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            case 401:
            case 403:
              $('#game-alert').text("Échec de l'authentification");
              break;
            default:
              $('#game-alert').text('Erreur :(');
          }
        }
      } else {
        if (r.response.isReady == 1) {
          $("#game-ready-btn").addClass('game-ready-btn-active');
        } else {
          $("#game-ready-btn").removeClass('game-ready-btn-active');
        }
        this.me.isReady = r.response.isReady;
      }
    });
  };

  this.apiToggleCard = (event) => {
    let dom = $(event.currentTarget);
    dom.toggleClass('white-card-selected');
    let idCard = this.wCards[dom.data('number')].id_card;
    $.ajax({
      type: "POST", url: "api/player_card_toggle.php",
      data: { pname: this.pname, token: this.token, idcard: idCard }
    }).done((r) => {
      if (!r.success) {
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              $('#game-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            case 401:
            case 403:
              $('#game-alert').text("Échec de l'authentification");
              break;
            default:
              $('#game-alert').text('Erreur :(');
          }
        }
      } else {
        $('.white-card').removeClass('white-card-selected');
        for (let sc of r.response.selected) {
          $(`.white-card[data-id="${µ(sc.id_card)}"]`).addClass('white-card-selected');
        }
      }
    });
  };

  this.apiSelectWinner = (event) => {
    let dom = $(event.currentTarget);
    $.ajax({
      type: "POST", url: "api/player_select_winner.php",
      data: { pname: this.pname, token: this.token, idcard: dom.data('id') }
    }).done((r) => {
      if (!r.success)
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              $('#game-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            case 401:
            case 403:
              $('#game-alert').text("Échec de l'authentification");
              break;
            default:
              $('#game-alert').text('Erreur :(');
          }
        }
    });
  };

  this.apiPing = (callback) => {
    $.ajax({
      type: "GET", url: "api/player_ping.php",
      data: { pname: getCookie('pname'), token: getCookie('token') }
    }).done((r) => {
      if (!r.success) {
        for (let e of r.errors) {
          switch (e.code) {
            case 101:
              $('#game-alert').text(`Paramètre manquant: ${µ(e.message)}`);
              break;
            case 401:
            case 403:
              $('#game-alert').text("Échec de l'authentification");
              break;
            default:
              $('#game-alert').text('Erreur :(');
          }
        }
      } else {
        this.count++;
        if (r.response.stillInGame == 'false') {
          location.href = "/index.php?action=hub&message=disconnected";
        }
        this.update(r.response);
        if (callback)
          callback(r);
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
    $('#room-time-min').text('••');
    $('#room-time-sec').text('••');
  };

  this.update = (r) => {
    this.me = r.players.find((e) => e.pname == this.pname);
    this.domRefreshRoundCount(r);
    $("#game").attr('data-status', r.status);
    $("#game").attr('data-role', this.me.isGameMaster ? "gamemaster" : "player");
    this.domRefreshPlayers(r);
    switch (r.status) {
      case 'STANDBY':
        //this.updateCookie();
        /*
        if (this.me.isReady == true) {
          $("#game-ready-btn").addClass('game-ready-btn-active');
        } else {
          $("#game-ready-btn").removeClass('game-ready-btn-active');
        }*/
        this.domRefreshInfo(`
          <strong>Invite d'autres gens avec ce lien:</strong> <br/>
          <span style="color: #ff226c">${µ(r.share)}</span>
        `);
        this.clockStop();
        break;
      case 'PLAYING_ROUND':
        this.domRefreshInfo('');
        $('#end-round-panel').html('');
        this.domRefreshCards(r);
        this.clock(r.remainingTime);
        break;
      case 'END_ROUND':
        this.wCards = [];
        this.clockStop();
        this.domRefreshEndRoundPanel(r);
        break;
      case 'CELEBRATION':
        this.domRefreshCelebrationPanel(r);
        //this.updateCookie();
        break;
    }
  };

  this.domRefreshInfo = (msg) => {
    if (this.info != msg) {
      $('#game-alert').html(msg)
      this.info = msg;
    }
  };

  this.domRefreshCards = (r) => {
    if (undefined == r.blackCard.id_card) {
      $('#black-card-content').text('');
    } else if (undefined == this.bCard || this.bCard.id_card != r.blackCard.id_card) {
      $('#black-card-content').text(r.blackCard.content);
    }
    this.bCard = r.blackCard;

    if (this.wCards.length != r.whiteCards.length) {
      this.wCards = r.whiteCards;
      $('#playing-round-cards-panel').html('');
      for (let i = 0; i < r.whiteCards.length; i++) {
        let wcR = r.whiteCards[i];
        $('#playing-round-cards-panel').append(`
          <div class="white-card${µ(wcR.isSelected ? ' white-card-selected' : '')}" data-number="${µ(i)}" data-id="${µ(wcR.id_card)}">
              <img class="white-card-icon" src="img/imac-uni-darkblue.svg">
              <p class="white-card-content">${µ(wcR.content)}</p>
          </div>
        `);
      }
      $('#playing-round-cards-panel .white-card').click(this.apiToggleCard);
    }
  };

  this.domRefreshTime = () => {
    let t = this.remainingTime.toFixed(0);
    let min = Math.abs(Math.trunc(t / 60));
    let sec = t % 60 > 9 ? t % 60 : "0" + Math.max(0, t % 60);
    $('#room-time-min').text(min);
    $('#room-time-sec').text(sec);
  };

  this.domRefreshRoundCount = (r) => {
    if (this.roundCount != r.roundCount) {
      $('#room-round-current').text(r.roundCount);
    }
    if (this.roundCountMax != r.roundCountMax) {
      $('#room-round-max').text(r.roundCountMax);
    }
  };

  this.domRefreshPlayers = (r) => {
    let ul = $('#room-players ul');
    if (this.mustPlayersBeRefreshed(r)) {
      this.players = r.players;
      ul.text('');
      for (let p of r.players) {
        ul.append(`
          <li class="fade-in" data-pname="${µ(p.pname)}">
            <div class="room-players-dot"></div>
            <p>${µ(p.pname)}</p>
          </li>
        `);
        let liDot = ul.find(`li[data-pname="${µ(p.pname)}"] .room-players-dot`);
        liDot.css('background-color', '#' + p.color);
        liDot.css('border-color', '#' + p.color);
        if (this.pname == p.pname)
          this.playerDot = liDot;
      }
    }
    for (let p of r.players) {
      let li = ul.find(`li[data-pname="${µ(p.pname)}"]`);
      let liDot = li.find('.room-players-dot');
      if (p.color != rgbToHex(liDot[0].style['border-color'])) {
        liDot.css('border-color', '#' + p.color);
      }
      if (p.isGameMaster == true) {
        li.addClass('room-players-gamemaster');
      } else {
        li.removeClass('room-players-gamemaster');
      }
      if (p.pname == this.pname) {
        li.addClass('room-players-me');
      } else {
        li.removeClass('room-players-me');
      }
      if (p.isReady == false) {
        li.addClass('room-players-not-ready');
      } else {
        li.removeClass('room-players-not-ready');
      }
      switch (r.status) {
        case 'STANDBY':
          if (p.isReady == true || p.isGameMaster == true) {
            liDot.css('background-color', `#${p.color}`);
          } else {
            liDot.css('background-color', 'transparent');
          }
          break;
        case 'PLAYING_ROUND':
          if (p.hasPlayed == true || p.isGameMaster == true) {
            liDot.css('background-color', `#${p.color}`);
          } else {
            liDot.css('background-color', 'transparent');
          }
          break;
        case 'END_ROUND':
          liDot.css('background-color', `#${p.color}`);
          break;
        case 'CELEBRATION':
          break;
      }
    }
  };

  this.domRefreshEndRoundPanel = (r) => {
    $('#end-round-panel').html('');
    let ps = r.players;
    for (let p of ps) {
      if (p.isGameMaster == false) {
        for (let sc of p.selected) {
          $('#end-round-panel').append(`
            <div class="white-card" data-id="${µ(sc.id_card)}">
              <p class="white-card-content">${µ(sc.content)}</p>
              <svg viewBox="0 0 380 304" class="white-card-icon"><defs><style>.col-${µ(p.pname)}{fill:#${µ(p.color)};}</style></defs><g><g><g><path class="col-${µ(p.pname)}" d="M228,152,152,76l38-38L152,0,114,38,76,0,38,38,76,76,0,152l76,76L38,266l38,38,38-38,38,38,38-38-38-38ZM76,152l38-38,38,38-38,38Z"></path><polygon class="col-${µ(p.pname)}" points="228 0 190 38 304 152 190 266 228 304 380 152 228 0"></polygon></g></g></g></svg>
              <span class="white-card-author">${µ(p.pname)}</span>
            </div>
          `);
        }
      }
    }
    if (this.me.isGameMaster) {
      $('#end-round-panel .white-card').click(this.apiSelectWinner);
    }
  };

  this.domRefreshCelebrationPanel = (r) => {
    $('#celebration-panel').html('');
    let ps = r.players;
    for (let p of ps) {
      if (p.pname == r.winner) {
        for (let sc of p.selected) {
          $('#celebration-panel').append(`
            <div class="white-card" data-id="${µ(sc.id_card)}">
              <p class="white-card-content">${µ(sc.content)}</p>
              <svg viewBox="0 0 380 304" class="white-card-icon"><defs><style>.col-${µ(p.pname)}{fill:#${µ(p.color)};}</style></defs><g><g><g><path class="col-${µ(p.pname)}" d="M228,152,152,76l38-38L152,0,114,38,76,0,38,38,76,76,0,152l76,76L38,266l38,38,38-38,38,38,38-38-38-38ZM76,152l38-38,38,38-38,38Z"></path><polygon class="col-${µ(p.pname)}" points="228 0 190 38 304 152 190 266 228 304 380 152 228 0"></polygon></g></g></g></svg>
              <span class="white-card-author">${µ(p.pname)}</span>
            </div>
          `);
        }
      }
    }
  };

  this.mustPlayersBeRefreshed = (r) => {
    if (!Array.isArray(this.players)
      || !Array.isArray(r.players)
      || this.players.length !== r.players.length
    ) {
      return true;
    }
    
    let oldP = this.players.map((e) => e.pname);
    let newP = r.players.map((e) => e.pname);
    
    oldP = oldP.concat().sort();
    newP = newP.concat().sort();

    for (var i = 0; i < oldP.length; i++) {
      if (oldP[i] !== newP[i])
        return true;
    }
    return false;
  };

  (() => {
    this.apiPing((r) => {
      this.me = r.response.players.find((e) => e.pname == this.pname);
      if (this.me.isReady == true) {
        $("#game-ready-btn").addClass('game-ready-btn-active');
      } else {
        $("#game-ready-btn").removeClass('game-ready-btn-active');
      }
    });
  })();
}