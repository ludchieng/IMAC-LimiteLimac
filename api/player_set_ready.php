<?php
require_once('../model/api_response.php');
require_once('../model/player.php');
require_once('../model/room.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['pname']))
    push_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['token']))
    push_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $token = $_POST['token'];
  $ready = strtolower($_POST['ready'] ?? 'yes');


  if (!is_valid_token($pname, $token))
    push_error($r, 401);

  if (in_array($ready, ['yes', 'true', 1, 'y'], true)) {
    set_player($pname, 'isReady', 1);
  } else if (in_array($ready, ['no', 'false', 0, 'n'], true)) {
    set_player($pname, 'isReady', 0);
  } else {
    push_error($r, 300, 'ready: expected \'yes\' or \'no\'');
  }

  $id_room = get_player($pname, 'id_room');
  if (can_room_start($id_room))
    start_room($id_room);

} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
