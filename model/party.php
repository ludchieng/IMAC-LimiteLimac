<?php
require_once('../model/data_access.php');
require_once('../model/player.php');

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


function get_party($id, $attr)
{
  return get('party', $id, $attr);
}


function set_party($id, $attr, $value): bool
{
  return set('party', $id, $attr, $value);
}


function join_party(int $id_party, int $id_player): string
{
  // Generate token
  $token = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$', TOKEN_LENGTH * strlen($x))), 1, TOKEN_LENGTH);
  set_player($id_player, 'id_party', $id_party);
  set_player($id_player, 'token', $token);
  return $token;
}


function quit_party(int $id_player): void
{
  set_player($id_player, 'id_party', null);
}


function get_party_players($id): array
{
  $sql = 'SELECT P.id_player, P.name
    FROM player P
    WHERE P.id_party = :id
  ';
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute([':id' => $id]);
  $data = $pst->fetchAll(PDO::FETCH_ASSOC);
  $pst->closeCursor();
  return $data;
}


function are_players_ready(int $id_party): bool
{
  // Get players not ready count
  $sql = 'SELECT COUNT(*) as count FROM player P
    WHERE P.id_party = :id_party
    AND P.isReady = 0;
  ';
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':id_party', $id_party, PDO::PARAM_INT);
  $pst->execute();
  $data = $pst->fetch(PDO::FETCH_ASSOC);
  $pst->closeCursor();
  return $data['count'] == 0;
}


function can_party_start(int $id): bool
{
  if (!are_players_ready($id))
    return false;
  if (3 > count(get_party_players($id)))
    return false;

  return true;
}


function start_party(int $id): void
{
}


function has_party_started(int $id): bool
{
  // Check if party has a black card
  return get('party', $id, 'id_card') != 'null';
}
