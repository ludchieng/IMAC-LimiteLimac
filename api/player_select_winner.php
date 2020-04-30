<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_POST['token']))
    throw_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  if (null == $id_room = get_player($_POST['pname'], 'id_room'))
    throw_error($r, 404, 'player does not have any room');

  if (ROOM_STATUS_END_ROUND != $s = get_room($id_room, 'status'))
    throw_error($r, 402, "Round status is {$s}");

  if (!isset($_POST['idcard']))
    throw_error($r, 101, 'idcard', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $token = $_POST['token'];
  $id_card = $_POST['idcard'];

  if ($pname != get_round_game_master($id_room))
    throw_error($r, 402, 'Only the game master is allowed to select the winner');

  $cards = get_round_selected_cards($id_room);
  if (!in_array($id_card, array_column($cards, 'id_card')))
    throw_error($r, 402, "Competitors selected cards does not include card ${id_card}");

  $idx = array_search($id_card, array_column($cards, 'id_card'));
  $winner = $cards[$idx]['pname'];
  set_player($winner, 'hasWon', 1);
  $rPts = get_player($winner, 'roomPoints');
  set_player($winner, 'roomPoints', $rPts+1);

  round_celebration($id_room);

  $r['response']['winner'] = $winner;

} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
