<?php
require_once('../model/api_response.php');
require_once('../model/player.php');
require_once('../model/log.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']))
    throw_error($r, 101, 'pass', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $pass = $_POST['pass'];

  if (is_known_player($pname))
    throw_error($r, 202, "Player {$pname} already exists");
  
  create_player($pname, $pass);

  if (!is_known_player($pname))
    throw_error($r, 666, 'Could not create player');

  $r['response'] = [];

  $token = player_generate_token();
  set_player($pname, 'token', $token);

  if ($token != get_player($pname, 'token'))
    throw_error($r, 666, 'Could not set token');

  $r['response']['token'] = $token;
  $r['response']['color'] = get_player($pname, 'color');

} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
