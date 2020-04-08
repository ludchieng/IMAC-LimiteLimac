<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Room</title>
  <?php require('includes/head.php') ?>
</head>
<body>
  
  <form>
    <label for="pname">Player name</label></br>
    <input id="pname" type="text" placeholder="name"></br>
    <label for="pass">Password</label></br>
    <input id="pass" type="password" placeholder="password"></br>
    <button id="send">Ogueh</button>
  </form>

</body>

<script>
$('#send').click((e) => {
  e.preventDefault();

  // Retrieve data from client
  let pname = $('#pname').value;
  let pass = $('#pass').value;

  let usp = new URLSearchParams(window.location.search)
  if (! usp.has('idroom')) {
    throw 'Cannot find idroom';
  }

  let idroom = Number(usp.get('idroom'));
  if (idroom === 'NaN') {
    throw 'Invalid idroom';
  }

  // Construct url and params
  let url = 'api/room_join.php';
  let params = 'idroom=' + idroom;
  params += '&pname=' + pname;
  params += '&pass=' + pass;

  // Instanciate xhr
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    // When we get the response
    if (xhr.readystate === 4) {
      // xhr is 'ok'
      if (xhr.status === 200) {
        // HTTP code is 200 -> OK
        handleResponse();
      }
    }
  };

  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // HTTP Protocol information
  xhr.send(params);

  function handleResponse() {
    // Get response from xhr object
    let response = xhr.response;

    // Temporary instructions
    alert (response);
  }
});
</script>

</html>