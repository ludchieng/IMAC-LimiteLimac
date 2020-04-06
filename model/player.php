<?php
require_once('../model/data_access.php');

function create_player(string $name, string $pass): int
{
  $sql = "INSERT INTO player (name, pass)
    VALUES (:name, :pass);
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':name', $name, PDO::PARAM_STR);
  $pst->bindValue(':pass', password_hash($pass, PASSWORD_DEFAULT), PDO::PARAM_STR);
  $pst->execute();
  $pst->closeCursor();
  return $pdo->lastInsertId();
}


function get_player($id, $attr)
{
  return get('player', $id, $attr);
}


function get_player_by_name($name, $attr)
{
  return get_by('player', 'name', $name, $attr);
}


function set_player($id, $attr, $value): bool
{
  return set('player', $id, $attr, $value);
}


function authenticate_player(string $name, string $pass): int
{
  if (!password_verify($pass, get_player_by_name($name, 'pass')))
    return FALSE;
  return get_player_by_name($name, 'id_player');
}


function is_valid_token(int $id_player, string $token): bool
{
  return get_player($id_player, 'token') == $token;
}


function draw_card(int $id, int $amount = 1): array
{
  // Get random cards from a set of drawable cards for a given in-game player
  $sql = "SELECT C.id_card, C.content FROM card C
  WHERE C.id_card LIKE 'W%'
  AND C.id_card NOT IN (
    SELECT Po.id_card FROM posseder Po, player Pl, party Pa
    WHERE Po.id_player = Pl.id_player
    AND Pl.id_party = Pa.id_party
    AND Pa.id_party = :id
  )
  ORDER BY RAND()
  LIMIT :amount;
  ";

  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':id', $id, PDO::PARAM_INT);
  $pst->bindValue(':amount', $amount, PDO::PARAM_INT);
  $pst->execute();
  $cards = $pst->fetchAll(PDO::FETCH_ASSOC);

  $sql = "INSERT INTO posseder (id_player, id_card, isSelected) VALUES";
  foreach ($cards as $c) {
    $sql .= " ('{$id}', '{$c['id_card']}', 0),";
  }
  $sql = substr($sql, 0, -1);
  $sql .= ';';

  $pst = $pdo->prepare($sql);
  $pst->execute();
  $pst->closeCursor();

  return $cards;
}


function get_player_cards(int $id): array
{
  $sql = 'SELECT P.id_card, C.content
    FROM posseder P, card C
    WHERE P.id_player = :id
    AND P.id_card = C.id_card;
  ';
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute([':id' => $id]);
  $data = $pst->fetchAll(PDO::FETCH_ASSOC);
  $pst->closeCursor();
  return $data;
}
