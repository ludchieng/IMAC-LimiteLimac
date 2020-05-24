<?php
require_once('../model/api_response.php');
require_once('../model/session.php');
require_once('../model/room.php');
require_once('../model/player.php');
require_once('../model/log.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_GET['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_GET['token']))
    throw_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  if (null == $id_room = get_player($_GET['pname'], 'id_room'))
    throw_error($r, 404, 'player does not have any room');

  abort_if_errors($r);

  $pname = $_GET['pname'];

  logs("PING START: ${pname}, #".get_player($pname, 'id_room'));

  $token = $_GET['token'];
  $toktok = get_player($pname, 'token');
  if (!is_valid_token($pname, $token))
    throw_error($r, 401);
  
  $r['response'] = [];
  if ($r['response']['stillInGame'] = ping($pname)) {
    check_for_end_round($id_room);
    
    $r['response']['status'] = $status = get_room($id_room, 'status');
    $r['response']['roundCount'] = get_room($id_room, 'roundCount');
    $r['response']['roundCountMax'] = get_room($id_room, 'roundCountMax');

    switch ($status) {
      case ROOM_STATUS_STANDBY:
        $r['response']['players'] = get_room_players_details($id_room);
        $r['response']['share'] = "https://{$_SERVER['HTTP_HOST']}/join.php?idroom=" . $id_room;
        break;

      case ROOM_STATUS_PLAYING_ROUND:
        $r['response']['whiteCards'] = get_player_handcards($pname);
        $r['response']['blackCard'] = get_round_card($id_room);
        $r['response']['remainingTime'] = get_round_remaining_time($id_room);
        $r['response']['players'] = get_room_players_details($id_room);
        break;

      case ROOM_STATUS_END_ROUND:
        $players = get_room_players_details($id_room);
        for ($i=0; $i < count($players); $i++) { 
          if (!$players[$i]['isGameMaster']) {
            $players[$i]['selected'] = get_player_selected_hcards($players[$i]['pname']);
          }
          $r['response']['players'][] = $players[$i];
        }
        break;

      case ROOM_STATUS_CELEBRATION:
        $players = get_room_players_details($id_room);
        for ($i=0; $i < count($players); $i++) { 
          if (!$players[$i]['isGameMaster']) {
            $players[$i]['selected'] = get_player_selected_hcards($players[$i]['pname']);
          }
          $r['response']['players'][] = $players[$i];
        }
        $r['response']['winner'] = $winner = get_round_winner($id_room);

        check_for_end_room($id_room);
        
        if (can_round_start($id_room)) {
          start_round($id_room, $winner);
        }
        break;

      case ROOM_STATUS_END_ROOM:
        $r['response']['players'] = get_room_players_details($id_room);
    }
  }
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage() . ' | ' . $e->getTraceAsString());
} catch (Exception $e) {
  throw_error($r, 666, $e->getMessage() . ' | ' . $e->getTraceAsString());
}
log_room($id_room);
logs("PING SUCCESS: ${pname}, #".get_player($pname, 'id_room').", response: ".json_encode($r));
send_response($r);
