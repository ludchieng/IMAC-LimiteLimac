<?php
require_once('../model/data_access.php');

/**
 * Inserts a new player in database.
 *
 * @param string $pname player name
 * @param string $pass password
 * @return void 
 */
function create_player(string $pname, string $pass): void
{
  $sql = "INSERT INTO player (pname, pass)
    VALUES (:pname, :pass);
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':pname', $pname, PDO::PARAM_STR);
  $pst->bindValue(':pass', password_hash($pass, PASSWORD_DEFAULT), PDO::PARAM_STR);
  $pst->execute();
  $pst->closeCursor();
}

/**
 * Returns true if the given player name matches
 * with a known player in database
 *
 * @param string $pname player name
 * @return boolean true if the given player name matches
 * with a known player in database
 */
function is_known_player(string $pname): bool
{
  try {
    get_player($pname, 'pname');
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

/**
 * Returns the value of a given attribute for
 * the specified player.
 *
 * @param string $pname player name
 * @param string $attr
 * @return void value of a given attribute for
 * the specified player
 */
function get_player(string $pname, string $attr)
{
  return get('player', $pname, $attr);
}

/**
 * Updates the value of a given attribute for
 * the specified room.
 *
 * @param string $pname player name
 * @param string $attr
 * @param mixed $value 
 * @return void
 */
function set_player(string $pname, string $attr, $value): void
{
  set('player', $pname, $attr, $value);
}

/**
 * Returns true if the given input matches with
 * the password for the specified player.
 *
 * @param string $pname player name
 * @param string $pass input password
 * @return boolean if the given input matches with
 * the password for the specified player
 */
function authenticate_player(string $pname, string $pass): bool
{
  return password_verify($pass, get_player($pname, 'pass'));
}

/**
 * Returns true if the given input matches with
 * the token for the specified player.
 *
 * @param string $pname player name
 * @param string $token
 * @return boolean true if the given input matches with
 * the token for the specified player
 */
function is_valid_token(string $pname, string $token): bool
{
  return get_player($pname, 'token') == $token;
}

/**
 * Pick a specific number of random white cards
 * for the given player.
 *
 * @param string $pname player name
 * @param integer $amount number of cards
 * @return array the drawn cards' attributes
 */
function draw_card(string $pname, int $amount = 1): array
{
  $id_room = get_player($pname, 'id_room');
  // Get random cards from a set of drawable cards for a given in-game player
  $sql = "SELECT C.id_card, C.content FROM card C
  WHERE C.id_card LIKE 'W%'
  AND C.id_card NOT IN (
    SELECT H.id_card FROM handcard H
    WHERE H.id_room = :id_room
  )
  ORDER BY RAND()
  LIMIT :amount;
  ";

  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':id_room', $id_room, PDO::PARAM_INT);
  $pst->bindValue(':amount', $amount, PDO::PARAM_INT);
  $pst->execute();
  $cards = $pst->fetchAll(PDO::FETCH_ASSOC);

  $sql = "INSERT INTO handcard (id_room, id_card, pname) VALUES";
  foreach ($cards as $c) {
    $sql .= " ('{$id_room}', '{$c['id_card']}', '{$pname}'),";
  }
  $sql = substr($sql, 0, -1);
  $sql .= ';';

  $pst = $pdo->query($sql);
  $pst->closeCursor();

  return $cards;
}

/**
 * Returns the cards' attributes of the
 * specified player.
 *
 * @param string $pname player name
 * @return array the cards' attributes of the
 * specified player
 */
function get_player_cards(string $pname): array
{
  $sql = 'SELECT H.id_card, C.content
    FROM handcard H, card C
    WHERE H.pname = :pname
    AND H.id_card = C.id_card;
  ';
  $data = get_multiple($sql, ['pname' => $pname]);
  return $data;
}

/**
 * Drop the white cards of a given player
 *
 * @param string $pname player name
 * @return void
 */
function purge_player_cards(string $pname): void
{
  $sql = "DELETE FROM handcard
  WHERE pname = :pname ;
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute(['pname' => $pname]);
}