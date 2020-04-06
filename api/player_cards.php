<?php
require_once('../model/api_response.php');
require_once('../model/party.php');
require_once('../model/player.php');
require_once('../model/data_access.php');

$r = [];

try {

  if (!isset($_GET['idplayer']))
    push_error($r, 101, 'for authenticating');

  if (!isset($_GET['token']))
    push_error($r, 102, 'for authenticating', API_ERROR_DONT_ABORT);

  if (!is_numeric($_GET['idplayer']))
    push_error($r, 301, 'concerning idplayer' , API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $id = $_GET['idplayer'];
  $token = $_GET['token'];

  if (!check_token($id, $token))
    push_error($r, 401);

  $r['response'] = get_player_cards($id);
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
