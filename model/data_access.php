<?php
/**
 * Functions about accessing database to retrieve,
 * update or delete data.
 * 
 * @package DataAccess
 */

require_once('api_response.php');
require_once('../_private/env.php');


$DB_DATA_PK = [
  'player' => 'pname',
  'room' => 'id_room',
  'card' => 'id_card',
  'pack' => 'id_pack'
];

/**
 * Initiates a connection with a database.
 *
 * @param string $dsn data source name
 * @param string $user database user
 * @param string $pass database password
 * @return PDO
 */
function connect_db(string $dsn, string $user, string $pass): PDO
{
  return new PDO($dsn, $user, $pass, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ));
}

/**
 * Initiates a connection with the database
 * as admin.
 *
 * @return PDO
 */
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

/**
 * Initiates a connection with the database
 * as player.
 *
 * @return PDO
 */
function connect_db_player(): PDO
{
  // TODO Add user player in db
  return connect_db_admin();
}

/**
 * Returns the value of a given attribute for a
 * tuple identified by its primary key value in the
 * specified table.
 *
 * @param string $table table name
 * @param mixed $id primary key value
 * @param string $attr
 * @return mixed the value of a given attribute for a
 * tuple identified by its primary key value in the
 * specified table
 * @throws PDOException
 *  if database encounter error
 *  OR if the identifier value leads to no match
 */
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

/**
 * Returns the value of a given attribute for a
 * tuple identified by another attribute (called
 * identifier) in the specified table.
 *
 * @param string $table
 * @param string $identifier
 * @param mixed $identifierValue
 * @param string $attr
 * @return void
 * @throws PDOException
 *  if database encounter error
 *  OR if the identifier value leads to no match
 *  OR if the identifier value leads to multiple matches
 */
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

/**
 * Returns an associative array resulting from
 * an SQL select query with its parameters.
 *
 * @param string $sql
 * @param array $params
 * @return array an associative array resulting from
 * an SQL select query with its parameters
 */
function get_multiple(string $sql, array $params = []): array
{
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute($params);
  $data = $pst->fetchAll(PDO::FETCH_ASSOC);
  $pst->closeCursor();
  return $data;
}

/**
 * Updates in database the specified attribute
 * of a tuple identified by its primary key value
 * in the specified value
 *
 * @param string $table
 * @param mixed $id
 * @param string $attr
 * @param mixed $value
 * @return void
 */
function set(string $table, $id, string $attr, $value): void
{
  global $DB_DATA_PK;
  $sql = "UPDATE {$table} SET {$attr} = :value
    WHERE {$DB_DATA_PK[$table]} = :id;
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->bindValue(':value', $value);
  $pst->bindValue(':id', $id);
  $pst->execute();
  $pst->closeCursor();
}

/**
 * Updates in database the specified attribute
 * of several tuples thanks to an SQL update query
 * with its parameters.
 *
 * @param string $sql
 * @param array $params
 * @return void
 */
function set_multiple(string $sql, array $params = []): void
{
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute($params);
}


function del(string $table, $id): void
{
  global $DB_DATA_PK;
  $sql = "DELETE FROM {$table}
  WHERE {$DB_DATA_PK[$table]} = :id ;
  ";
  $pdo = connect_db_player();
  $pst = $pdo->prepare($sql);
  $pst->execute(['id' => $id]);
}


function set_current_timestamp(string $table, $id, string $attr): void
{
  global $DB_DATA_PK;
  $sql = "UPDATE {$table}
  SET {$attr} = current_timestamp()
  WHERE {$DB_DATA_PK[$table]} = {$id};
  ";
  connect_db_player()->query($sql);
}