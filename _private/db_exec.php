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


if (!isset($_POST['path'])) {
	die("Error: No sql file provided.");
}

$path = '_private/' . $_POST['path'];

$MAX_RUN_TIME = 8;

$deadline = time() + $MAX_RUN_TIME;

$db = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD);
if (!$db)
	die('Error: Could not connect to mysql');
if ($db->connect_error)
	die('Error: could not connect to mysql: ' . $db->connect_error);
echo '<pre>' . 'Database connection opened.' . '</pre>';

if (!$db->select_db($DB_DATABASE))
	die('Error: could not select: ' . $DB_DATABASE);

if (!$fp = fopen($path, 'r'))
	die('Error: could not read sql script: ' . $_POST['path']);

	$sql = '';
	while ($deadline > time() and ($line = fgets($fp, 1024000))) {
	if (substr($line, 0, 2) == '--' or trim($line) == '')
		continue;

	$sql .= $line;
	if (substr(trim($sql), -1) == ';') {
		if (!$db->query($sql))
			die('Error performing query \'<strong>' . $sql . '\': ' . $db->error . '</strong>');
		$sql = '';
	}
}

echo "<pre>Script at '{$path}' successfully executed.</pre>";

$db->close();
echo '<pre>' . 'Database connection closed.' . '</pre>';