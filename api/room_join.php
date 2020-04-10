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

  if (!isset($_POST['pass']))
    throw_error($r, 101, 'pass', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $id_room = $_POST['idroom'];
  $pname = $_POST['pname'];
  $pass = $_POST['pass'];

  if (false == authenticate_player($pname, $pass))
    throw_error($r, 403);

  $r['response'] = [];
  $r['response']['token'] = join_room($id_room, $pname);
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
