<?php

header('Content-Type: application/json');
require_once('../model/room.php');
require_once('../model/player.php');
require_once('../model/data_access.php');

do {
$rWinner = array_column(get_room_players_details($_GET['idroom']), 'pname')[rand(0, 2)];
} while(get_player($rWinner, 'isGameMaster') != false);
echo json_encode(get_player_selected_hcards($rWinner)[0]);
