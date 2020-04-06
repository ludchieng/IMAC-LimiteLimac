<?php
require_once('../model/data_access.php');

define('PARTY_MAX_HAND_CARDS_COUNT', 7);
define('TOKEN_LENGTH', 24);

function create_party(string $name): int
{
  $sql = "INSERT INTO party (name)
    VALUES (:name);
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute([':name' => $name]);
  $pst->closeCursor();
  return $pdo->lastInsertId();
}


function join_party(int $id_party, int $id_player): string
{
  // Generate token
  $token = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$', ceil(TOKEN_LENGTH / strlen($x)))), 1, TOKEN_LENGTH);

  $sql = "UPDATE player SET id_party = :id_party,
    token = :token WHERE id_player = :id_player;
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':id_party', $id_party, PDO::PARAM_INT);
  $pst->bindValue(':id_player', $id_player, PDO::PARAM_INT);
  $pst->bindValue(':token', $token, PDO::PARAM_STR);
  $pst->execute();
  $pst->closeCursor();
  return $token;
}


function quit_party(int $id_player): void
{
  $sql = "UPDATE player SET id_party = null
    WHERE id_player = :id_player;
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':id_player', $id_player, PDO::PARAM_INT);
  $pst->execute();
  $pst->closeCursor();
}


function has_party_started(int $id): bool
{
  $sql = 'SELECT P.id_card FROM party P
    WHERE P.id_party= :id
  ';
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute([':id' => $id]);
  $data = $pst->fetch(PDO::FETCH_ASSOC);
  $pst->closeCursor();
  return $data['id_card'] != 'null';
}
