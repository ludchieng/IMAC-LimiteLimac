<?php
/**
 * Functions about handling client request on API.
 * 
 * @package APIResponse
 */

$API_ERROR_MSG = [
  666 => 'Something wrong occured',
  100 => 'Param error',
  101 => 'Param: missing',
  200 => 'Database error',
  201 => 'Database query failed via PDO',
  202 => 'Database: duplicate entry',
  300 => 'Invalid input',
  301 => 'Invalid input: not a number',
  302 => 'Invalid input: not a string',
  400 => 'Unauthorized',
  401 => 'Unauthorized: token does not match',
  402 => 'Unauthorized: illegal game move',
  403 => 'Unauthorized: password does not match',
  404 => 'Unauthorized: illegal state',
  500 => 'Wrong HTTP method',
  501 => 'Wrong HTTP method: GET required',
  502 => 'Wrong HTTP method: POST required',
  503 => 'Wrong HTTP method: PUT required',
];

define('API_ERROR_DO_ABORT', -100);
define('API_ERROR_DONT_ABORT', -101);


function create_response(): array
{
  $r = [];
  $r['success'] = true;
  return $r;
}


function throw_error(array &$r, int $code, string $detail = null, int $option = API_ERROR_DO_ABORT): void
{
  global $API_ERROR_MSG;

  $r['success'] = false;
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
  header('Content-Type: application/json');
  die(json_encode($r, JSON_UNESCAPED_UNICODE));
}


function send_response(array &$r): void
{
  header('Content-Type: application/json');
  echo json_encode($r, JSON_UNESCAPED_UNICODE);
}
