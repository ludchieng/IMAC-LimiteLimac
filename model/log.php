<?php
/**
 * @package Log
 */

function log_($file, $msg): void
{
  $filename = "..log/${file}.log";
  if (!file_exists('../log'))
    mkdir('../log');
  $timestamp = date('Y-m-d H:i:s.') . str_pad((microtime(true) *1000) % 1000,3,"0",STR_PAD_LEFT);
  file_put_contents("../log/${file}.log", '['. $timestamp .']: '.$msg."\n", FILE_APPEND);
}

function logs($msg)
{
  //log_('1', $msg);
}

function log_room($id_room)
{
  //$sql = 'SELECT * FROM room R WHERE id_room = '.$id_room;
  //log_('1', json_encode(get_multiple($sql)));
}