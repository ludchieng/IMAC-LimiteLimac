<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");


  $cards = get_multiple('SELECT C.id_card, C.content, C.pname, C.id_pack FROM card C;');

  $packs = get_multiple('SELECT P.id_pack, P.name, P.pname FROM pack P;');

  foreach ($packs as $p) {
    $res[$p['id_pack']] = $p;
    $res[$p['id_pack']]['cards'] = [];
  }

  foreach ($cards as $c) {
    $res[$c['id_pack']]['cards'][] = $c;
  }

  $r['response'] = [];
  $r['response']['data'] = $res;
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
