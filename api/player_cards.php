<?php
require_once('../model/api_response.php');
require_once('../model/player.php');

$r = create_response();

try {

  if ('GET' !== $_SERVER['REQUEST_METHOD'])
    throw_error($r, 501, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_GET['pname']))
    throw_error($r, 101, 'pname', API_ERROR_DONT_ABORT);

  if (!isset($_GET['token']))
    throw_error($r, 101, 'token', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $pname = $_GET['pname'];
  $token = $_GET['token'];

  if (!is_valid_token($pname, $token))
    throw_error($r, 401);
  
  $r['response'] = [];
  $cards = get_player_cards($pname);
  for ($i=0; $i < count($cards); $i++) { 
    $c = $cards[$i];
    $c['isSelected'] = in_array($c['id_card'], array_column(get_player_selected_cards($pname), 'id_card'));
    $r['response']['cards'][] = $c;
  }
  $r['response']['isGameMaster'] = '0' !== get_player($pname, 'isGameMaster');
} catch (PDOException $e) {
  throw_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  throw_error($r, 666);
}

send_response($r);
