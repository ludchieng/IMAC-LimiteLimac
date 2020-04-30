<?php
/**
 * @package Session
 */
require_once('../model/player.php');
require_once('../model/room.php');

function ping($pname): bool
{
  check_players_session($pname);
  if (null === get_player($pname, 'id_room'))
    return false;
  
  set_player($pname, 'lastPing', date("Y-m-d H:i:s"));
  return true;
}


function check_players_session($pname): void
{
  foreach(get_timeout_players($pname) as $tmoutp) {
    quit_room($tmoutp);
  }
}


function get_timeout_players($pname): array
{
  $now = date('Y-m-d H:i:s');
  $id_room = get_player($pname, 'id_room');
  $timeoutDuration = get_room($id_room, 'pingTimeOut');
  $sql = "SELECT P.pname FROM player P
    WHERE P.id_room IS NOT NULL
    AND P.lastPing IS NOT NULL
    AND TIMEDIFF('{$now}', P.lastPing)
     > {$timeoutDuration};
  ";
  return array_column(get_multiple($sql), 'pname');
}