<?php

header('Content-Type: application/json');
require_once('../model/room.php');
require_once('../model/player.php');
require_once('../model/data_access.php');

$idr = $_GET['idroom'];

$r = [];
$r['name'] = get_room($idr, 'name');
$r['status'] = get_room($idr, 'status');
$r['remainingTime'] = get_round_remaining_time($idr);
$r['blackCard'] = get_round_card($idr);
$r['gamemaster'] = get_round_game_master($idr);
$r['selected'] = get_round_selected_cards($idr);
$r['competitors'] = get_round_competitors($idr);
$r['details'] = get_room_players_details($idr);

echo json_encode($r);
