<?php
require_once('../model/data_access.php');
require_once('../model/player.php');
require_once('../model/round.php');

define('ROOM_MAX_HAND_CARDS_COUNT', 7);
define('TOKEN_LENGTH', 24);


function create_room(string $name): int
{
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


function get_room(int $id_room, string $attr)
{
  return get('room', $id_room, $attr);
}


function set_room(int $id_room, string $attr, $value): bool
{
  return set('room', $id_room, $attr, $value);
}


function join_room(int $id_room, string $pname): string
{
  // Generate token
  $token = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$', TOKEN_LENGTH * strlen($x))), 1, TOKEN_LENGTH);
  set_player($pname, 'id_room', $id_room);
  set_player($pname, 'token', $token);
  return $token;
}


function quit_room(string $pname): void
{
  set_player($pname, 'id_room', null);
}


function get_room_players(int $id_room): array
{
  $sql = 'SELECT P.pname FROM player P
    WHERE P.id_room = :id_room
  ';
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':id_room', $id_room, PDO::PARAM_INT);
  $pst->execute();
  $data = $pst->fetchAll(PDO::FETCH_ASSOC);
  $pst->closeCursor();
  $res = [];
  foreach ($data as $row)
    $res[] = $row['pname'];
  return $res;
}


function are_players_ready(int $id_room): bool
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


function can_room_start(int $id_room): bool
{
  if (!are_players_ready($id_room))
    return false;
  if (count(get_room_players($id_room)) < 3)
    return false;

  return true;
}


function start_room(int $id_room): array
{
  $players = get_room_players($id_room);
  $r = rand(0, count($players) - 1);
  start_round($id_room, $players[$r]);
  // Get random cards from a set of drawable cards for a given in-game player
  /*$sql = "SELECT C.id_card, C.content
    FROM card C WHERE C.id_card LIKE 'B%';
  ";

  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute();
  $cards = $pst->fetchAll(PDO::FETCH_ASSOC);*/
  return [];
}