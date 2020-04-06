<?php
require_once('_private/env.php');

if (!isset($_GET['path']))
	die("Error: No sql file provided.");

if (!isset($_GET['db_admin'], $_GET['db_password']))
	die('Error: Database admin username and password are required.');

// Create schema
require_once('_private/db_create_schema.php');

// Execute sql script
require_once('_private/db_exec.php');
