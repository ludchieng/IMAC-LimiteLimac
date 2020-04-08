<?php
require_once('../model/data_access.php');
require_once('../model/player.php');


function start_round(int $id_room, string $pname): array
{
  $players = get_room_players($id_room);
  foreach ($players as $p) {
    set_player($p, 'isGameMaster', $p['pname'] === $pname);
  }
  // TODO make function get array
  return [];
}


function has_round_started(int $id_room): bool
{
  // Check if room has a black card
  return get('room', $id_room, 'id_card') != 'null';
}
