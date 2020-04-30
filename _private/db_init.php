<?php
require_once('_private/env.php');

if (!isset($_POST['path']))
	die("Error: No sql file provided.");

if (!isset($_POST['db_admin'], $_POST['db_password']))
	die('Error: Database admin username and password are required.');

// Create schema
require_once('_private/db_create_schema.php');

// Execute sql script
require_once('_private/db_exec.php');
