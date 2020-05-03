<?php
require_once('../model/api_response.php');
require_once('../model/card.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['pass']) && !isset($_POST['token']))
    throw_error($r, 101, 'pass or token', API_ERROR_DONT_ABORT);

  if (!isset($_POST['content']))
    throw_error($r, 101, 'content', API_ERROR_DONT_ABORT);

  if (!isset($_POST['type']))
    throw_error($r, 101, 'type', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $content = $_POST['content'];
  $type = $_POST['type'];

  if (isset($_POST['pass'])) {
    if (!authenticate_player($pname, $_POST['pass']))
      throw_error($r, 403);

  } else if (isset($_POST['token'])) {
    if (!is_valid_token($pname, $_POST['token']))
      throw_error($r, 401);
  }
  
  $hasCreatedPack = false;
  if (NULL == get_player($pname, 'id_pack')) {
    $r['response']['pack'] = create_pack($pname);
    $hasCreatedPack = true;
  }
  
  $r['response']['card'] = create_card($pname, $content, $type);
  $r['response']['hasCreatedPack'] = $hasCreatedPack;

} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
