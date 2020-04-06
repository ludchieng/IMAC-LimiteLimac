<?php
require_once('api_response.php');
require_once('../_private/env.php');

function connect_db(string $dsn, string $user, string $pass): PDO
{
  return new PDO($dsn, $user, $pass, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ));
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


function get($table, $id, $attr)
{
  $sql = "SELECT P.{$attr} FROM {$table} P
      WHERE P.id_{$table} = :id_{$table}
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(":id_{$table}", $id, PDO::PARAM_INT);
  
  if (!$pst->execute())
    throw new PDOException($pst->errorInfo()[2]);

  if (!$data = $pst->fetch(PDO::FETCH_ASSOC))
    throw new PDOException('Cannot find element by the provided id');

  $pst->closeCursor();
  return $data[$attr];
}


function get_by($table, $identifier, $identifierValue, $attr)
{
  $sql = "SELECT P.{$attr} FROM {$table} P
      WHERE P.{$identifier} = :identifier
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(":identifier", $identifierValue);
  
  if (!$pst->execute())
    throw new PDOException($pst->errorInfo()[2]);

  $data = $pst->fetchAll(PDO::FETCH_ASSOC);
  if (count($data) > 1)
    throw new PDOException('Identifier value duplicates');

  if (count($data) === 0)
    throw new PDOException('Cannot find element by the provided identifier value');

  $pst->closeCursor();
  return $data[0][$attr];
}


function set($table, $id, $attr, $value): bool
{
  $sql = "UPDATE {$table} SET {$attr} = :value
    WHERE id_{$table} = :id;
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':value', $value);
  $pst->bindValue(':id', $id, PDO::PARAM_INT);
  $isSuccess = $pst->execute();
  $pst->closeCursor();
  return $isSuccess;
}