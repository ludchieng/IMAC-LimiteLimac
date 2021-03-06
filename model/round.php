<?php
/**
 * Functions concerning round.
 * 
 * @package Round
 */

require_once('../model/data_access.php');
require_once('../model/player.php');
require_once('../model/room.php');
require_once('../model/log.php');

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
  logs("START ROUND CALLED: #$id_room, gamemaster: $pnameGM");
  set_room($id_room, 'isStatusLocked', 1);
  del_players_selected_cards($id_room);
  set_room_handcards($id_room, 'isSelected', 0);
  set_room_players($id_room, 'hasPlayed', 0);
  set_room_players($id_room, 'hasWon', 0);
  set_room_players($id_room, 'isGameMaster', 0);
  logs("START ROUND: #$id_room, Reset done");
  log_room($id_room);
  $players = get_room_ready_players($id_room);
  if (get_player($pnameGM, 'isReady') != 1)
    pick_random_game_master($id_room);
  foreach ($players as $p) {
    $cardsCount = count(get_player_handcards($p));
    if (0 < $numberToDraw = ROOM_MAX_HAND_CARDS_COUNT - $cardsCount)
      draw_card($p, $numberToDraw);
    if ($p === $pnameGM) {
      set_player($p, 'isGameMaster', 1);
    } else {
      set_player($p, 'isGameMaster', 0);
    }
  }
  logs("START ROUND: #$id_room, Player init done");
  log_room($id_room);
  draw_black_card($id_room);
  set_current_timestamp('room', $id_room, 'lastRoundStart');
  set_room($id_room, 'roundCount', 1+get_room($id_room, 'roundCount'));
  set_room($id_room, 'isStatusLocked', 0);
  set_room($id_room, 'status', ROOM_STATUS_PLAYING_ROUND);
  logs("START ROUND: #$id_room, Final steps done");
  log_room($id_room);
  logs("START ROUND SUCCESS: #$id_room, Final steps done");
}


function can_round_start(int $id_room): bool
{
  logs("CAN ROUND START CALLED: #$id_room");
  if (get_room($id_room, 'isStatusLocked') == true)
    return false;
  if (get_room($id_room, 'status') == ROOM_STATUS_PLAYING_ROUND)
    return false;
  if (get_round_end_time($id_room) > 0)
    return false;
  if (is_room_roundcount_exceeded($id_room))
    return false;
  logs("CAN ROUND START: #$id_room, returned TRUE");
  return true;
}


function end_round($id_room): void
{
  logs("END ROUND: #$id_room");
  set_room($id_room, 'status', ROOM_STATUS_END_ROUND);
}

function round_celebration($id_room): void
{
  logs("ROUND CELEBRATION: #$id_room");
  set_room($id_room, 'isStatusLocked', 1);
  set_room($id_room, 'status', ROOM_STATUS_CELEBRATION);
  set_current_timestamp('room', $id_room, 'lastRoundEnd');
  set_room($id_room, 'isStatusLocked', 0);
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

function pick_random_game_master(int $id_room): void
{
  $players = get_room_ready_players($id_room);
  $r = rand(0, count($players) - 1);
  start_round($id_room, $players[$r]);
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
  $sql = "SELECT C.id_card, C.content
    FROM card C, `use` U
    WHERE C.id_pack = U.id_pack
    AND U.id_room = :id_room
    AND C.id_card LIKE 'B%'
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
  if (null != $data = get_multiple($sql, ['id_room' => $id_room]))
    return $data[0];
  return null;
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
  if (null != $gameMaster = get_multiple($sql, ['id_room' => $id_room]))
    return $gameMaster[0]['pname'];
  return null;
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


function get_round_winner(int $id_room): ?string
{
  $sql = "SELECT P.pname FROM player P
    WHERE P.hasWon <> 0
    AND id_room = :id_room;
  ";
  if (null != $winner = get_multiple($sql, ['id_room' => $id_room]))
    return $winner[0]['pname'];
  return null;
}


function get_round_remaining_time(int $id_room): ?int
{
  $rd = get_room($id_room, 'roundDuration');
  $sql  ="SELECT UNIX_TIMESTAMP(R.lastRoundStart)
  - UNIX_TIMESTAMP(current_timestamp()) + {$rd} as diff
  FROM room R WHERE id_room = :id_room;
  ";
  if (null != $diff = get_multiple($sql, ['id_room' => $id_room]))
    return $diff[0]['diff'];
  return null;
}


function get_round_end_time(int $id_room): ?int
{
  $rd = get_room($id_room, 'celebrationDuration');
  $sql  ="SELECT UNIX_TIMESTAMP(R.lastRoundEnd)
  - UNIX_TIMESTAMP(current_timestamp()) + {$rd} as diff
  FROM room R WHERE id_room = :id_room;
  ";
  if (null != $diff = get_multiple($sql, ['id_room' => $id_room]))
    return $diff[0]['diff'];
  return null;
}


function check_for_end_round(int $id_room): void
{
  if (get_room($id_room, 'status') === ROOM_STATUS_PLAYING_ROUND
      && (get_round_remaining_time($id_room) <= 0)
      && (get_room($id_room, 'isStatusLocked') == false)
  ) {
    if (is_null(get_room($id_room, 'lastRoundStart')))
      throw new Exception('lastRoundStart is null at check_for_end_round()');
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