<?php
require_once('../model/api_response.php');
require_once('../model/party.php');

$r = create_response();

try {

  if ('POST' !== $_SERVER['REQUEST_METHOD'])
    push_error($r, 502, "had {$_SERVER['REQUEST_METHOD']}");

  if (!isset($_POST['name']))
    push_error($r, 101, 'name', API_ERROR_DONT_ABORT);

  abort_if_errors($r);

  $name = $_POST['name'];

  $r['response'] = [];
  $r['response']['newPartyId'] = create_party($name);
} catch (PDOException $e) {
  push_error($r, 201, $e->getMessage());
} catch (Exception $e) {
  push_error($r, 666);
}

send_response($r);
