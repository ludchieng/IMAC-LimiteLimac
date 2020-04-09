<?php
require_once('../model/data_access.php');
require_once('../model/player.php');
require_once('../model/room.php');

/**
 * Initiates a new round in the specified room
 * by reseting players cards, assigning game master
 * and giving cards to the competitors.
 *
 * @param integer $id_room
 * @param string $pnameGM Game master's player name
 * @return void
 */
function start_round(int $id_room, string $pnameGM): void
{
  $players = get_room_players($id_room);
  foreach ($players as $p) {
    purge_player_cards($p['pname']);
    if ($p['pname'] === $pnameGM) {
      set_player($p, 'isGameMaster', true);
    } else {
      set_player($p, 'isGameMaster', false);
      draw_card($p['pname'], ROOM_MAX_HAND_CARDS_COUNT);
    }
  }
  draw_room_card($id_room);
}

/**
 * Returns true if the round has started in the
 * specified room.
 *
 * @param integer $id_room
 * @return boolean true if the round has started
 */
function has_round_started(int $id_room): bool
{
  return null !== get_room_card($id_room);
}

/**
 * Pick a random black card for the current round of the
 * specified room.
 *
 * @param integer $id_room
 * @return array the card's attributes
 */
function draw_room_card(int $id_room): array
{
  $sql = "SELECT C.id_card, C.content FROM card C
    WHERE C.id_card LIKE 'B%'
    AND C.id_card NOT IN (
    SELECT H.id_card FROM had H
    WHERE H.id_room = :id_room
  )
  ORDER BY RAND()
  LIMIT 1;
  ";
  $blackCard = get_multiple($sql, ['id_room' => $id_room])[0];
  set('room', $id_room, 'id_card', $blackCard['id_card']);

  if (count($blackCard) === 0) {
    // There is no more black cards
    purge_room_cards_history($id_room);
    // Retry after purge
    return draw_room_card($id_room);
  }
  add_room_card_to_history($id_room, $blackCard['id_card']);
  return $blackCard;
}

/**
 * Returns the current black card's attributes of the being played
 * round in the specified room or null if there is no round being
 * played yet.
 *
 * @param integer $id_room
 * @return array|null the current black card's attributes of the being
 * played round in the specified room or null if there is no round being
 * played yet
 */
function get_room_card(int $id_room): ?array
{
  return get_room($id_room, 'id_card');
}

/**
 * Returns the game master player name of the current round
 * in the specified room.
 *
 * @param integer $id_room
 * @return string the game master player name of the current round
 * in the specified room
 */
function get_game_master(int $id_room): string
{
  $sql = "SELECT P.pname FROM player P
    WHERE P.id_room = :id_room
    AND P.isGameMaster <> 0
  ";
  $gameMaster = get_multiple($sql, ['id_room' => $id_room])[0];
  return $gameMaster['pname'];
}