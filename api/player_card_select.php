<?php
require_once('../model/api_response.php');
require_once('../model/room.php');
require_once('../model/card.php');
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

  if (ROOM_STATUS_PLAYING_ROUND != $s = get_room($id_room, 'status'))
    throw_error($r, 402, "Round status is {$s}");

  if (!isset($_POST['idcard']))
    throw_error($r, 101, 'idcard', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_POST['pname'];
  $token = $_POST['token'];
  $id_card = $_POST['idcard'];

  if ($pname == get_round_game_master($id_room))
    throw_error($r, 402, 'Game master is not allowed to select a card');

  $handcards = array_column(get_player_cards($pname), 'id_card');
  if (!in_array($id_card, $handcards))
    throw_error($r, 402, "{$pname} does not have card {$id_card}");

  $blanksCount = get_card_blanks_count(get_room($id_room, 'id_card'));

  $selected = get_player_selected_cards($pname);
  if ($blanksCount > count($selected)) {
    set_player_isSelected_card($pname, $id_card);
  } else {
    set_player_isSelected_card($pname, $selected[0]['id_card'], false);
    set_player_isSelected_card($pname, $id_card);
  }

  if ($blanksCount === count(get_player_selected_cards($pname))) {
    set_player($pname, 'hasPlayed', 1);
  } else {
    set_player($pname, 'hasPlayed', 0);
  }

  if (!in_array($id_card, array_column(get_player_selected_cards($pname), 'id_card')))
    throw_error($r, 666, "Could not select {$id_card}");

} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
