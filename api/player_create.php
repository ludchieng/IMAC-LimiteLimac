<?php
require_once('../model/api_response.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['pname']))
    push_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']))
    push_error($r, 101, 'pass', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $pass = $_POST['pass'];

  if (is_known_player($pname))
    push_error($r, 202, "Player '{$pname}' already exists");
  
  create_player($pname, $pass);
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
