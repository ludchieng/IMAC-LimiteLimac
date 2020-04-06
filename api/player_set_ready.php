<?php
require_once('../model/api_response.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['idplayer']))
    push_error($r, 101, 'idplayer', API_ERROR_DONT_ABORT);

  if (!isset($_POST['token']))
    push_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  if (!is_numeric($_POST['idplayer']))
    push_error($r, 301, 'idplayer', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $id_player = $_POST['idplayer'];
  $token = $_POST['token'];

  if (!is_valid_token($id_player, $token))
    push_error($r, 401);

  set_player($id_player, 'isReady', true);

  $id_party = get_player($id_player, 'id_party');
  if (can_party_start($id_party))
    start_party($id_party);
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
