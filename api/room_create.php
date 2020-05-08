<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/log.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");
    
    if (!isset($_POST['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);
    
    if (!isset($_POST['pass']) && !isset($_POST['token']))
    throw_error($r, 101, 'pass or token', API_ERROR_DONT_ABORT);
  
    if (!isset($_POST['name']))
      throw_error($r, 101, 'name', API_ERROR_DONT_ABORT);

    if (!isset($_POST['nbRounds']))
      throw_error($r, 101, 'nbRounds', API_ERROR_DONT_ABORT);

    if (!isset($_POST['roundDuration']))
      throw_error($r, 101, 'roundDuration', API_ERROR_DONT_ABORT);

    if (!isset($_POST['celebrationDuration']))
      throw_error($r, 101, 'celebrationDuration', API_ERROR_DONT_ABORT);

    if (!isset($_POST['packs']))
      throw_error($r, 101, 'packs', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $name = $_POST['name'];
  $nbRounds = $_POST['nbRounds'];
  $roundDuration = $_POST['roundDuration'];
  $celebrationDuration = $_POST['celebrationDuration'];
  $packs = $_POST['packs'];

  if (isset($_POST['pass'])) {
    if (!authenticate_player($pname, $_POST['pass']))
      throw_error($r, 403);

    $id = create_room($name, $nbRounds, $roundDuration, $celebrationDuration, $packs);
    $token = join_room($id, $pname);
  } else if (isset($_POST['token'])) {
    if (!is_valid_token($pname, $_POST['token']))
      throw_error($r, 401);
      
    $id = create_room($name, $nbRounds, $roundDuration, $celebrationDuration, $packs);
    $token = join_room($id, $pname, $_POST['token']);
  }

  $r['response'] = [];
  $r['response']['idroom'] = $id;
  $r['response']['share'] = "https://{$_SERVER['HTTP_HOST']}/join.php?idroom=" . $id;
  $r['response']['token'] = $token;
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
