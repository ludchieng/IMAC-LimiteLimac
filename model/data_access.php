<?php
require_once('api_response.php');
require_once('../_private/env.php');

function connect_db(string $dsn, string $user, string $pass): PDO
{
  return new PDO($dsn, $user, $pass);
}


function connect_db_admin(): PDO
{
  global $DB_CONNECTION, $DB_DATABASE, $DB_CHARSET;
  global $DB_HOST, $DB_USERNAME, $DB_PASSWORD;

  $dsn = $DB_CONNECTION;
  $dsn .= ':dbname=' . $DB_DATABASE;
  $dsn .= ';host=' . $DB_HOST;
  $dsn .= ';charset=' . $DB_CHARSET;
  return connect_db($dsn, $DB_USERNAME, $DB_PASSWORD);
}


function connect_db_player(): PDO
{
  // TODO Add user player in db
  return connect_db_admin();
}
