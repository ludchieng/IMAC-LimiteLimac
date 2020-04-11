<?php
require_once('_private/env.php');

if ($DB_HOST === '')
	die('Error: DB_HOST is empty in ./_private/env.php (default is "localhost")');

if ($DB_DATABASE === '')
	die('Error: DB_DATABASE is empty in ./_private/env.php');

if ($DB_USERNAME === '')
	die('Error: DB_USERNAME is empty in ./_private/env.php');

if ($DB_PASSWORD === '')
	die('Error: DB_PASSWORD is required in ./_private/env.php');


if (!isset($_GET['db_admin'], $_GET['db_password']))
	die('Error: Database admin username and password are required.');

// Connect to mysql server
$db = mysqli_connect($DB_HOST, $_GET['db_admin'], $_GET['db_password']);
if (!$db)
	die('Error: could not connect to mysql.');
if ($db->connect_error)
	die('Error: could not connect to mysql: ' . $db->connect_error);
echo '<pre>' . 'Database connection opened.' . '</pre>';

// Query db to create schema
$sql = "CREATE SCHEMA {$DB_DATABASE} CHARACTER SET {$DB_CHARSET} COLLATE {$DB_COLLATION};";
if (TRUE === $db->query($sql)) {
	echo '<pre>' . "Schema '{$DB_DATABASE}' has been created successfully." . '</pre>';
} else {
	$db->close();
	die('Error: Could not create schema: ' . $DB_DATABASE);
}

// Query db to create user
$sql = "CREATE USER '{$DB_USERNAME}'@'{$DB_HOST}' IDENTIFIED BY '{$DB_PASSWORD}';";
if (TRUE === $db->query($sql)) {
	echo '<pre>' . "User '{$DB_USERNAME}' has been created successfully." . '</pre>';
} else {
	$db->close();
	die('Error: Could not create user: ' . $DB_USERNAME);
}

// Query db to grant user
$sql = "GRANT ALL PRIVILEGES ON {$DB_DATABASE}.* TO '{$DB_USERNAME}'@'{$DB_HOST}';";
if (TRUE === $db->query($sql)) {
	echo '<pre>' . "User '{$DB_USERNAME}' has been granted successfully." . '</pre>';
} else {
	$db->close();
	die('Error: Could not grant user: ' . $DB_USERNAME);
}

// Query db to flush privilege
$sql = "FLUSH PRIVILEGES;";
if (TRUE === $db->query($sql)) {
	echo '<pre>' . "Flushed privileges successfully." . '</pre>';
} else {
	$db->close();
	die('Error: Could not flush privileges');
}


$db->close();
echo '<pre>' . 'Database connection closed.' . '</pre>';
