<?php
require_once('../model/api_response.php');
require_once('../model/party.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['idparty']))
    push_error($r, 101, 'idparty', API_ERROR_DONT_ABORT);

  if (!isset($_POST['playername']))
    push_error($r, 101, 'playername', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']))
    push_error($r, 101, 'pass', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $id_party = $_POST['idparty'];
  $playername = $_POST['playername'];
  $pass = $_POST['pass'];

  if (FALSE == $id_player = authenticate_player($playername, $pass))
    push_error($r, 403);

  $r['response'] = [];
  $r['response']['token'] = join_party($id_party, $id_player);
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
