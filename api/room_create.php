<?php
require_once('../model/api_response.php');
require_once('../model/room.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['roomname']))
    push_error($r, 101, 'roomname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pname']))
    push_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']))
    push_error($r, 101, 'pass', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $roomname = $_POST['roomname'];
  $pname = $_POST['pname'];
  $pass = $_POST['pass'];

  if (!authenticate_player($pname, $pass))
    push_error($r, 401);

  $r['response'] = [];
  $r['response']['idroom'] = $id = create_room($roomname);
  $r['response']['share'] = "https://{$_SERVER['HTTP_HOST']}/join_room.php?idroom=" . $id;
  $r['response']['token'] = join_room($id, $pname);
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
