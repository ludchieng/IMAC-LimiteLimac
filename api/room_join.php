<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['idroom']))
    throw_error($r, 101, 'idroom', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']) && !isset($_POST['token']))
    throw_error($r, 101, 'pass or token', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $id_room = $_POST['idroom'];
  $pname = $_POST['pname'];

  if (!is_known_room($id_room))
    throw_error($r, 203, "Does the room {$id_room} exist?");

  if (isset($_POST['pass'])) {
    if (!authenticate_player($pname, $_POST['pass']))
      throw_error($r, 403);

    $token = join_room($id_room, $pname);
  } else if (isset($_POST['token'])) {
    if (!is_valid_token($pname, $_POST['token']))
      throw_error($r, 401);

    $token = join_room($id_room, $pname, $_POST['token']);
  }

  $r['response'] = [];

  if ($id_room != get_player($pname, 'id_room'))
    throw_error($r, 666);

  $r['response']['token'] = $token;
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
