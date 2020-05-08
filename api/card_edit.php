<?php
require_once('../model/api_response.php');
require_once('../model/card.php');
require_once('../model/player.php');
require_once('../model/log.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']) && !isset($_POST['token']))
    throw_error($r, 101, 'pass or token', API_ERROR_DONT_ABORT);
  
  if (!isset($_POST['idcard']))
    throw_error($r, 101, 'idcard', API_ERROR_DONT_ABORT);

  if (!isset($_POST['content']))
    throw_error($r, 101, 'content', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $id_card = $_POST['idcard'];
  $content = $_POST['content'];

  if (isset($_POST['pass'])) {
    if (!authenticate_player($pname, $_POST['pass']))
      throw_error($r, 403);

  } else if (isset($_POST['token'])) {
    if (!is_valid_token($pname, $_POST['token']))
      throw_error($r, 401);
  }

  if (!owns_card($pname, $id_card))
    throw_error($r, 400, "{$pname} does not own card {$id_card}");

  set_card($id_card, 'content', $content);
  
  $r['response']['card']['id_card'] = $id_card;
  $r['response']['card']['content'] = get_card($id_card, 'content');
  $r['response']['card']['id_pack'] = get_card($id_card, 'id_pack');

} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
