<?php
require_once('../model/api_response.php');
require_once('../model/player.php');
require_once('../model/room.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['token']))
    throw_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  if (null == $id_room = get_player($_POST['pname'], 'id_room'))
    throw_error($r, 404, 'player does not have any room');

  if (ROOM_STATUS_STANDBY != $s = get_room($id_room, 'status'))
    throw_error($r, 402, "Round status is {$s}");

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $token = $_POST['token'];
  $ready = strtolower($_POST['ready'] ?? 'yes');


  if (!is_valid_token($pname, $token))
    throw_error($r, 401);

  if (in_array($ready, ['yes', 'true', 1, 'y'], true)) {
    set_player($pname, 'isReady', 1);
  } else if (in_array($ready, ['no', 'false', 0, 'n'], true)) {
    set_player($pname, 'isReady', 0);
  } else {
    throw_error($r, 300, 'ready: expected \'yes\' or \'no\'');
  }

  if (1 != get_player($pname, 'isReady'))
    throw_error($r, 666);
    
  if (can_room_start($id_room))
    start_room($id_room);

} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
