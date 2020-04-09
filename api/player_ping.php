<?php
require_once('../model/api_response.php');
require_once('../model/session.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_GET['pname']))
    push_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_GET['token']))
    push_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_GET['pname'];
  $token = $_GET['token'];
  $toktok = get_player($pname, 'token');
  if (!is_valid_token($pname, $token))
    push_error($r, 401);

  
  $r['response'] = [];
  if ($r['response']['stillInGame'] = ping($pname)) {
    $id_room = get_player($pname, 'id_room');
    check_for_end_round($id_room);
    $r['response']['remainingTime'] = get_round_remaining_time($id_room);
  }
  // TODO
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
