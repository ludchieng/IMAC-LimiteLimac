<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/log.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_GET['idroom']))
    throw_error($r, 101, 'idroom');

  $id_room = $_GET['idroom'];
  
  if (!is_known_room($id_room))
    throw_error($r, 203, "Does the room {$id_room} exist?");

  $r['response'] = [];
  $r['response']['name'] = get_room($id_room, 'name');
  $r['response']['status'] = get_room($id_room, 'status');
  $r['response']['roundCountMax'] = get_room($id_room, 'roundCountMax');
  $r['response']['pingTimeOut'] = get_room($id_room, 'pingTimeOut');
  $r['response']['roundDuration'] = get_room($id_room, 'roundDuration');
  $r['response']['celebrationDuration'] = get_room($id_room, 'celebrationDuration');
  $r['response']['lastRoundStart'] = get_room($id_room, 'lastRoundStart');
  $r['response']['lastRoundEnd'] = get_room($id_room, 'lastRoundEnd');
  $r['response']['id_card'] = get_room($id_room, 'id_card');
  $r['response']['players'] = get_room_players_details($id_room);
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
