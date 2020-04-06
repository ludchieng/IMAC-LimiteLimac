<?php

$API_ERROR_MSG = [
  666 => 'Something wrong occured',
  100 => 'Missing param',
  101 => 'Missing param: idplayer',
  102 => 'Missing param: token',
  200 => 'Database error',
  201 => 'Database connection failed via PDO',
  202 => 'Database query failed',
  300 => 'Invalid input',
  301 => 'Invalid input: not a number',
  302 => 'Invalid input: not a string',
  400 => 'Unauthorized',
  401 => 'Unauthorized: token does not match',
  402 => 'Unauthorized: illegal game move'
];

define('API_ERROR_DO_ABORT', -100);
define('API_ERROR_DONT_ABORT', -101);

function push_error(array &$r, int $code, string $detail = null, int $option = API_ERROR_DO_ABORT): void
{
  global $API_ERROR_MSG;

  $error = [];
  $error['code'] = $code;
  $error['message'] = $API_ERROR_MSG[$code];

  if (!is_null($detail))
    $error['detail'] = $detail;

  if (!isset($r['errors']))
    $r['errors'] = [];
  $r['errors'][] = $error;

  if ($option === API_ERROR_DO_ABORT)
    abort($r);
}


function abort_if_errors(array &$r): void
{
  if (!isset($r['errors']))
    return;
  
  if (0 === count($r['errors']))
    return;
  
  abort($r);
}


function abort(array &$r): void
{
  die(json_encode($r, JSON_UNESCAPED_UNICODE));
}


function send_response(array &$r): void
{
  echo json_encode($r, JSON_UNESCAPED_UNICODE);
}
