<?php
/**
 * Functions concerning rooms.
 * 
 * @package Room
 */

require_once('../model/data_access.php');
require_once('../model/player.php');
require_once('../model/round.php');

define('ROOM_MAX_HAND_CARDS_COUNT', 7);
define('TOKEN_LENGTH', 7);

define('ROOM_STATUS_STANDBY', 'STANDBY');
define('ROOM_STATUS_PLAYING_ROUND', 'PLAYING_ROUND');
define('ROOM_STATUS_END_ROUND', 'END_ROUND');

/**
 * Inserts a new room in database.
 *
 * @param string $name
 * @return integer id of the created room
 */
function create_room(string $name): int
{
  // Check for obsolete rooms
  purge_empty_rooms();
  
  $sql = "INSERT INTO room (name)
    VALUES (:name);
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':name', $name, PDO::PARAM_STR);
  $pst->execute();
  $pst->closeCursor();
  return $pdo->lastInsertId();
}

/**
 * Returns the value of a given attribute for
 * the specified room.
 *
 * @param integer $id_room
 * @param string $attr
 * @return mixed the value of a given attribute for
 * the specified room 
 */
function get_room(int $id_room, string $attr)
{
  return get('room', $id_room, $attr);
}

/**
 * Updates the value of a given attribute for
 * the specified room.
 *
 * @param integer $id_room
 * @param string $attr
 * @param mixed $value
 * @return void
 */
function set_room(int $id_room, string $attr, $value): void
{
  set('room', $id_room, $attr, $value);
}

/**
 * Returns an array of players for
 * the specified room.
 *
 * @param integer $id_room
 * @return array an array of players for
 * the specified room
 */
function get_room_players(int $id_room): array
{
  $sql = 'SELECT P.pname FROM player P
    WHERE P.id_room = :id_room
  ';
  $data = get_multiple($sql, ['id_room' => $id_room]);
  return array_column($data, 'pname');
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
function get_room_competitors(int $id_room): array
{
  $sql = 'SELECT P.pname FROM player P
    WHERE P.id_room = :id_room
    AND P.isGameMaster = 0;
  ';
  $data = get_multiple($sql, ['id_room' => $id_room]);
  return array_column($data, 'pname');
}

/**
 * Returns true when the players of the specified room
 * have all their ready status set to true.
 *
 * @param integer $id_room
 * @return boolean true when the players of the specified room
 * have all their ready status set to true
 */
function are_room_players_ready(int $id_room): bool
{
  // Get players not ready count
  $sql = 'SELECT COUNT(*) as count FROM player P
    WHERE P.id_room = :id_room
    AND P.isReady = 0;
  ';
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':id_room', $id_room, PDO::PARAM_INT);
  $pst->execute();
  $data = $pst->fetch(PDO::FETCH_ASSOC);
  $pst->closeCursor();
  return $data['count'] == 0;
}

/**
 * Returns true if the specified room
 * has enough players to start the next
 * round and if they are all ready.
 *
 * @param integer $id_room
 * @return boolean true if the room has enough players to
 * start the next round and if they are all ready
 */
function can_room_start(int $id_room): bool
{
  if (get_room($id_room, 'status') !== ROOM_STATUS_STANDBY)
    return false;
  if (!are_room_players_ready($id_room))
    return false;
  if (count(get_room_players($id_room)) < 3)
    return false;

  return true;
}

/**
 * Initiates the first round of the specified
 * room by chosing a random game master.
 *
 * @param integer $id_room
 * @return void
 */
function start_room(int $id_room): void
{
  // Pick random player as game master
  $players = get_room_players($id_room);
  $r = rand(0, count($players) - 1);
  start_round($id_room, $players[$r]);
}

/**
 * Saves the given black card of the specified 
 * room to its room cards history
 *
 * @param integer $id_room
 * @param string $id_card
 * @return void
 */
function add_room_card_to_history(int $id_room, string $id_card): void
{
  $sql = " INSERT INTO had (id_room, id_card)
    VALUES ('{$id_room}', '{$id_card}');
  ";
  $pdo = connect_db_player();
   $pdo->query($sql);
}

/**
 * Drop the black cards history content of
 * the specified room
 *
 * @param integer $id_room
 * @return void
 */
function purge_room_cards_history(int $id_room): void
{
  $sql = "DELETE FROM had
  WHERE id_room = :id_room ;
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute(['id_room' => $id_room]);
}


function purge_empty_rooms(): void
{
  $sql = "DELETE FROM room
    WHERE (
      SELECT R.id_room FROM room R
    ) NOT IN (
      SELECT P.id_room FROM player P
      WHERE id_room IS NOT NULL
      GROUP BY id_room
    );
  ";
  connect_db_player()->query($sql);
}