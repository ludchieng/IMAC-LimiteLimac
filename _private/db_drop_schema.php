<?php
require_once('_private/env.php');

if ($DB_HOST === '')
	die('Error: DB_HOST is empty in ./_private/env.php (default is "localhost")');

if ($DB_DATABASE === '')
	die('Error: DB_DATABASE is empty in ./_private/env.php');

if ($DB_USERNAME === '')
	die('Error: DB_USERNAME is empty in ./_private/env.php');


if (!isset($_POST['db_admin'], $_POST['db_password']))
  die('Error: Database admin username and password are required.');

// Connect to mysql server
$db = mysqli_connect($DB_HOST, $_POST['db_admin'], $_POST['db_password']);
if (!$db)
	die('Error: Could not connect to mysql');
if ($db->connect_error)
  die('Error: Could not connect to mysql: ' . $db->connect_error);
echo '<pre>' . 'Database connection opened.' . '</pre>';

// Query db to flush privilege
$sql = "FLUSH PRIVILEGES;";
if (TRUE === $db->query($sql)) {
  echo '<pre>' . "Flushed privileges successfully." . '</pre>';
} else {
  $db->close();
  die('Error: Could not flush privileges');
}

// Query db to delete user
$sql = "DROP USER IF EXISTS '{$DB_USERNAME}'@'{$DB_HOST}';";
if (TRUE === $db->query($sql)) {
  echo '<pre>' . "User '{$DB_USERNAME}' has been dropped successfully if he did exist." . '</pre>';
} else {
  $db->close();
  die('Error: Could not drop user: ' . $DB_USERNAME);
}

// Query db to delete schema
$sql = "DROP SCHEMA IF EXISTS {$DB_DATABASE};";
if (TRUE === $db->query($sql)) {
  echo '<pre>' . "Schema '{$DB_DATABASE}' has been dropped successfully if it did exist." . '</pre>';
} else {
  $db->close();
  die('Error: Could not drop schema: ' . $DB_DATABASE);
}


$db->close();
echo '<pre>' . 'Database connection closed.' . '</pre>';