<?php
require_once('../model/player.php');
require_once('../model/room.php');

define('SESSION_TIMEOUT', 10); // seconds

function ping($pname): void
{
  set_player($pname, 'lastPing', date("Y-m-d H:i:s"));
}


function check_players_session(): bool
{
  $sql = "SELECT P.pname FROM player P
    WHERE P.id_room IS NOT NULL
    AND TIMEDIFF({date('Y-m-d H:i:s')}, P.lastPing)
     > {SESSION_TIMEOUT};
  ";
  $timedOutPlayers = array_column(get_multiple($sql), 'pname');
  // TODO
  return false;
}