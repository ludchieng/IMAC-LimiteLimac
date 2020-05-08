<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/player.php');
require_once('../model/log.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (isset($_COOKIE['pname'])) {
    set_current_timestamp('player', $_COOKIE['pname'], 'lastActivity');
  }

  $sql = 'SELECT P.pname, P.color, P.winCount FROM player P
    WHERE P.lastActivity > CURRENT_TIMESTAMP() - 120
  ;';

  $r['response'] = [];
  $r['response']['online'] = get_multiple($sql);
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
