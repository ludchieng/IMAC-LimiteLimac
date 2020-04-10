<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_GET['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_GET['token']))
    throw_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  if (isset($_GET['amount']) && !is_numeric($_GET['amount']))
    throw_error($r, 301, 'amount', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_GET['pname'];
  $token = $_GET['token'];
  $amount = $_GET['amount'] ?? 1;

  if (!is_valid_token($pname, $token))
    throw_error($r, 401);
  $cards = get_player_cards($pname);
  if (count($cards) >= ROOM_MAX_HAND_CARDS_COUNT)
    throw_error($r, 402, 'Player\'s hand is full');

  $r['response'] = [];
  $r['response']['newCards'] = draw_card($pname, $amount);
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
