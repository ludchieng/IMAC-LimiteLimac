<?php
/**
 * Functions concerning round.
 * 
 * @package Round
 */

require_once('../model/data_access.php');
require_once('../model/player.php');
require_once('../model/room.php');

/**
 * Initiates a new round in the specified room
 * by reseting players cards, assigning game master,
 * giving cards to the competitors and picking the
 * room card.
 *
 * @param integer $id_room
 * @param string $pnameGM Game master's player name
 * @return void
 */
function start_round(int $id_room, string $pnameGM): void
{
  set_room($id_room, 'status', ROOM_STATUS_PLAYING_ROUND);
  del_players_selected_cards($id_room);
  $players = get_room_players($id_room);
  foreach ($players as $p) {
    if ($p === $pnameGM) {
      set_player($p, 'isGameMaster', 1);
    } else {
      set_player($p, 'isGameMaster', 0);
      draw_card($p, ROOM_MAX_HAND_CARDS_COUNT);
    }
  }
  draw_black_card($id_room);
  // Update room attribute 'lastRoundStart'
  $sql = "UPDATE room
  SET lastRoundStart = current_timestamp()
  WHERE id_room = {$id_room};
  ";
  $pdo = connect_db_player()->query($sql);
}


function end_round($id_room): void
{
  set_room($id_room, 'status', ROOM_STATUS_END_ROUND);
  // TODO
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
  return null !== get_round_card($id_room);
}

/**
 * Pick a random black card for the current round of the
 * specified room.
 *
 * @param integer $id_room
 * @return array the card's attributes
 */
function draw_black_card(int $id_room): array
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
    return draw_black_card($id_room);
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
function get_round_card(int $id_room): ?array
{
  $sql = 'SELECT C.id_card, C.content
    FROM card C, room R
    WHERE C.id_card = R.id_card
    AND R.id_room = :id_room
  ';
  return get_multiple($sql, ['id_room' => $id_room])[0];
}


function get_round_selected_cards(int $id_room): array
{
  $sql = 'SELECT H.pname, C.id_card, C.content
    FROM card C, handcard H
    WHERE C.id_card = H.id_card
    AND H.id_room = :id_room
    AND H.isSelected <> 0;
  ';
  return get_multiple($sql, ['id_room' => $id_room]);
}

/**
 * Returns the game master player name of the current round
 * in the specified room.
 *
 * @param integer $id_room
 * @return string|null the game master player name of the current round
 * in the specified room
 */
function get_round_game_master(int $id_room): ?string
{
  $sql = "SELECT P.pname FROM player P
    WHERE P.id_room = :id_room
    AND P.isGameMaster <> 0
  ";
  $gameMaster = get_multiple($sql, ['id_room' => $id_room])[0];
  return $gameMaster['pname'];
}

/**
 * Returns an array of competitors for
 * the specified room. Competitors are players
 * that are not the game master of the current round.
 *
 * @param integer $id_room
 * @return array an array of competitors for
 * the specified room. Competitors are players
 * that are not the game master of the current round
 */
function get_round_competitors(int $id_room): array
{
  $sql = 'SELECT P.pname FROM player P
    WHERE P.id_room = :id_room
    AND P.isGameMaster = 0;
  ';
  $data = get_multiple($sql, ['id_room' => $id_room]);
  return array_column($data, 'pname');
}


function get_round_remaining_time(int $id_room): ?int
{
  $rd = get_room($id_room, 'roundDuration');
  $sql  ="SELECT UNIX_TIMESTAMP(R.lastRoundStart)
  - UNIX_TIMESTAMP(current_timestamp()) + {$rd} as diff
  FROM room R WHERE id_room = :id_room;
  ";
  $diff = get_multiple($sql, ['id_room' => $id_room])[0]['diff'];
  return $diff;
}


function check_for_end_round(int $id_room): void
{
  if (get_room($id_room, 'status') === ROOM_STATUS_PLAYING_ROUND
      && (get_round_remaining_time($id_room) <= 0
        || have_players_all_played($id_room)
      )
  ) {
    end_round($id_room);
  }
}


function have_players_all_played($id_room): bool
{
  $sql = 'SELECT P.pname FROM player P
    WHERE P.id_room = :id_room
    AND P.hasPlayed = 0;
  ';
  $remaining = get_multiple($sql, ['id_room' => $id_room]);
  return count($remaining) === 0;
}