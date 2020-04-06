<?php
require_once('../model/api_response.php');
require_once('../model/party.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_GET['idplayer']))
    push_error($r, 101, 'idplayer');

  if (!isset($_GET['token']))
    push_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  if (!is_numeric($_GET['idplayer']))
    push_error($r, 301, 'concerning idplayer', API_ERROR_DONT_ABORT);

  if (isset($_GET['amount']) && !is_numeric($_GET['amount']))
    push_error($r, 301, 'concerning amount', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $id = $_GET['idplayer'];
  $token = $_GET['token'];
  $amount = $_GET['amount'] ?? 1;

  if (!is_valid_token($id, $token))
    push_error($r, 401);

  $cards = get_player_cards($id);
  if (count($cards) >= PARTY_MAX_HAND_CARDS_COUNT)
    push_error($r, 402, 'Player\'s hand is full');

  $r['response'] = [];
  $r['response']['newCards'] = draw_card($id, $amount);
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
