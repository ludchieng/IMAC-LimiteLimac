<?php
require_once('../model/api_response.php');
require_once('../model/card.php');
require_once('../model/player.php');
require_once('../model/log.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  abort_if_errors($r);

  $packs = get_multiple('SELECT P.id_pack, P.name FROM pack P;');

  $r['response'] = [];
  $r['response']['packs'] = $packs;

} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
