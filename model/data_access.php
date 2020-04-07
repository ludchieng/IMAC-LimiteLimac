<?php
require_once('api_response.php');
require_once('../_private/env.php');


$DB_DATA_PK = [
  'player' => 'pname',
  'room' => 'id_room',
  'card' => 'id_card',
];


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


function get(string $table, $id, string $attr)
{
  global $DB_DATA_PK;
  $sql = "SELECT {$attr} FROM {$table}
      WHERE {$DB_DATA_PK[$table]} = :id
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(":id", $id);

  if (!$pst->execute())
    throw new PDOException($pst->errorInfo()[2]);

  if (!$data = $pst->fetch(PDO::FETCH_ASSOC))
    throw new PDOException('Cannot find element by the provided id');

  $pst->closeCursor();
  return $data[$attr];
}


function get_by(string $table, string $identifier, $identifierValue, string $attr)
{
  $sql = "SELECT {$attr} FROM {$table}
      WHERE {$identifier} = :identifier
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


function set(string $table, $id, string $attr, $value): bool
{
  global $DB_DATA_PK;
  $sql = "UPDATE {$table} SET {$attr} = :value
    WHERE {$DB_DATA_PK[$table]} = :id;
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':value', $value);
  $pst->bindValue(':id', $id);
  $isSuccess = $pst->execute();
  $pst->closeCursor();
  return $isSuccess;
}
