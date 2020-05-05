<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/log.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['roomname']))
    throw_error($r, 101, 'roomname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']) && !isset($_POST['token']))
    throw_error($r, 101, 'pass or token', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $roomname = $_POST['roomname'];
  $pname = $_POST['pname'];

  if (isset($_POST['pass'])) {
    if (!authenticate_player($pname, $_POST['pass']))
      throw_error($r, 403);

    $id = create_room($roomname);
    $token = join_room($id, $pname);
  } else if (isset($_POST['token'])) {
    if (!is_valid_token($pname, $_POST['token']))
      throw_error($r, 401);
      
    $id = create_room($roomname);
    $token = join_room($id, $pname, $_POST['token']);
  }

  $r['response'] = [];
  $r['response']['idroom'] = $id;
  $r['response']['share'] = "https://{$_SERVER['HTTP_HOST']}/join_room.php?idroom=" . $id;
  $r['response']['token'] = $token;
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
