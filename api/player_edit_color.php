<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/player.php');
require_once('../model/log.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['color']))
    throw_error($r, 101, 'color', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']) && !isset($_POST['token']))
    throw_error($r, 101, 'pass or token', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $color = $_POST['color'];

  if (isset($_POST['pass'])) {
    if (!authenticate_player($pname, $_POST['pass']))
      throw_error($r, 403);

  } else if (isset($_POST['token'])) {
    if (!is_valid_token($pname, $_POST['token']))
      throw_error($r, 401);
  }

  set_player($pname, 'color', $color);

  if ($color != get_player($pname, 'color'))
    throw_error($r, 666);
  
  $r['response'] = [];
  $r['response']['color'] = $color;

} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
