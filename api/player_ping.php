<?php
require_once('../model/api_response.php');
require_once('../model/session.php');
require_once('../model/room.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_GET['pname']))
    push_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_GET['token']))
    push_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_GET['pname'];
  $token = $_GET['token'];
  $toktok = get_player($pname, 'token');
  if (!is_valid_token($pname, $token))
    push_error($r, 401);

  
  $r['response'] = [];
  if ($r['response']['stillInGame'] = ping($pname)) {
    $id_room = get_player($pname, 'id_room');
    check_for_end_round($id_room);
    $r['response']['status'] = $status = get_room($id_room, 'status');
    $r['response']['blackCard'] = get_round_card($id_room);
    switch ($status) {
      case ROOM_STATUS_PLAYING_ROUND:
        $r['response']['remainingTime'] = get_round_remaining_time($id_room);
        $r['response']['players'] = get_room_players_details($id_room);
        break;

      case ROOM_STATUS_END_ROUND:
        $players = get_room_players_details($id_room);
        for ($i=0; $i < count($players); $i++) { 
          if (!$players[$i]['isGameMaster'])
            $players[$i]['selectedCard'] = get_player_selected_card($players[$i]['pname']);
          $r['response']['players'][] = $players[$i];
        }
        break;
    }
  }
  // TODO
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
