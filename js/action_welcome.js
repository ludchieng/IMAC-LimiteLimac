// Modals
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
});

$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
});

jQuery('#btn-signout').click(() => {
  delCookie('pname');
  delCookie('token');
  location.href = 'index.php';
});


// Room create/join buttons
jQuery("#create-button").click(() => {
  jQuery("#room-create").css('display', "inline-block");
  jQuery("#room-create").addClass('fade-in');
  jQuery("#room-join").css('display', "none");
});

jQuery("#join-button").click(() => {
  jQuery("#room-join").css('display', "inline-block");
  jQuery("#room-join").addClass('fade-in');
  jQuery("#room-create").css('display', "none");
});


// Ajax create room
jQuery('#room-create').submit((e) => {
  e.preventDefault();

  let roomName = jQuery('#room-create input').val();
  if (roomName != "") {
    if (null == getCookie('pname')) {
      location.href = "index.php?action=login";
    }
    if (null == getCookie('token')) {
      location.href = "index.php?action=login";
    }
    jQuery.ajax({
      type: "POST",
      url: "api/room_create.php",
      data: {
        roomname: roomName,
        pname: getCookie('pname'),
        token: getCookie('token')
      }
    }).done((r) => {
      if (r.success) {
        setCookie('token', r.response.token, .5);
        location.href = "index.php?action=player";
      } else {
        jQuery('#room-create-info').text('Erreur creation du salon');
      }
    });
  }
});


// Ajax join room
jQuery('#room-join').submit((e) => {
  e.preventDefault();

  let idroom = jQuery('#room-join input').val();
  if (idroom != "") {
    if (null == getCookie('pname')) {
      location.href = "index.php?action=login";
    }
    if (null == getCookie('token')) {
      location.href = "index.php?action=login";
    }
    jQuery.ajax({
      type: "POST",
      url: "api/room_join.php",
      data: {
        idroom: idroom,
        pname: getCookie('pname'),
        token: getCookie('token')
      }
    }).done((r) => {
      if (r.success) {
        setCookie('token', r.response.token, .5);
        location.href = "index.php?action=player";
      } else if (r.errors[0].code == 203) {
        jQuery('#room-join-info').text('Erreur salon inexistant');
      } else if (r.errors[0].code == 401) {
        location.href = `index.php?action=login&join=${µ(idroom)}`;
      } else {
        jQuery('#room-join-info').text('Erreur accès du salon');
      }
    });
  }
});