<?php

header('Content-Type: application/json');
require_once('../model/room.php');
require_once('../model/player.php');
require_once('../model/data_access.php');

if (in_array('aag', ['no', 'false', 0, 'n'], true)) {
  echo 0;
} else {
  echo -1;
}