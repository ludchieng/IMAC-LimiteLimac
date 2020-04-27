<?php
/**
 * @package Session
 */
require_once('../model/player.php');
require_once('../model/room.php');

//TODO adapt value
define('SESSION_TIMEOUT_DURATION', 60); // seconds

function ping($pname): bool
{
  check_players_session();
  if (null === get_player($pname, 'id_room'))
    return false;
  
  set_player($pname, 'lastPing', date("Y-m-d H:i:s"));
  return true;
}


function check_players_session(): void
{
  foreach(get_timeout_players() as $tmoutp) {
    quit_room($tmoutp);
  }
}


function get_timeout_players(): array
{
  $now = date('Y-m-d H:i:s');
  $timeoutDuration = SESSION_TIMEOUT_DURATION;
  $sql = "SELECT P.pname FROM player P
    WHERE P.id_room IS NOT NULL
    AND P.lastPing IS NOT NULL
    AND TIMEDIFF('{$now}', P.lastPing)
     > {$timeoutDuration};
  ";
  return array_column(get_multiple($sql), 'pname');
}