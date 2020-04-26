<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  $sql = 'SELECT R.id_room, R.name FROM room R;';

  $r['response'] = [];
  $r['response']['online'] = get_multiple($sql);
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
