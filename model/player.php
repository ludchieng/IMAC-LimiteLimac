<?php
require_once('../model/data_access.php');


function create_player(string $pname, string $pass): int
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
  return $pdo->lastInsertId();
}


function is_known_player(string $pname): bool
{
  try {
    get_player($pname, 'pname');
    return true;
  } catch (PDOException $e) {
    return false;
  }
}


function get_player(string $pname, string $attr)
{
  return get('player', $pname, $attr);
}


function set_player(string $pname, string $attr, $value): bool
{
  return set('player', $pname, $attr, $value);
}


function authenticate_player(string $pname, string $pass): string
{
  if (!password_verify($pass, get_player($pname, 'pass')))
    return FALSE;
  return get_player($pname, 'pname');
}


function is_valid_token(string $pname, string $token): bool
{
  return get_player($pname, 'token') == $token;
}


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

  $pst = $pdo->prepare($sql);
  $pst->execute();
  $pst->closeCursor();

  return $cards;
}


function get_player_cards(string $pname): array
{
  $sql = 'SELECT H.id_card, C.content
    FROM handcard H, card C
    WHERE H.pname = :pname
    AND H.id_card = C.id_card;
  ';
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':pname', $pname, PDO::PARAM_STR);
  $pst->execute();
  $data = $pst->fetchAll(PDO::FETCH_ASSOC);
  $pst->closeCursor();
  return $data;
}
