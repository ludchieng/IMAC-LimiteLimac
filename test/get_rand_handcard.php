<?php

header('Content-Type: application/json');
require_once('../model/room.php');
require_once('../model/player.php');
require_once('../model/data_access.php');

echo json_encode(get_player_cards($_GET['pname'])[rand(0, 6)]);