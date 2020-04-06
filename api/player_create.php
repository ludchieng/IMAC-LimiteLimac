<?php
require_once('../model/api_response.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['name']))
    push_error($r, 101, 'name', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']))
    push_error($r, 101, 'pass', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $name = $_POST['name'];
  $pass = $_POST['pass'];

  $r['response'] = [];
  $r['response']['newPlayerId'] = create_player($name, $pass);
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
