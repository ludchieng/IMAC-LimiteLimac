<?php
require_once('api_response.php');

function check_token(int $id, string $token): bool
{
  $sql = 'SELECT P.token FROM player P WHERE P.id_player = :id';
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute([':id' => $id]);
  $data = $pst->fetch(PDO::FETCH_ASSOC);
  $pst->closeCursor();
  return $data['token'] == $token;
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