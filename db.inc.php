<?php
	$dbServer = 'localhost';
	$dbUser = 'postgres';
	$dbPassword = 'PASSWORD';
	$dbName = 'db';

	$dbObject = new PDO("pgsql:host=$dbServer;dbname=$dbName", $dbUser, $dbPassword);

	function dbQuery($sql, $prams) { // caches perpared statements
		global $dbObject;
		global $dbQueries;
		if(!isset($dbQueries[$sql])) {
			$dbQueries[$sql] = $dbObject->prepare($sql);
		}
		$dbQueries[$sql]->execute($prams);
		return $dbQueries[$sql];
	}

	function db($sql) {
		$prams = func_get_args();
		array_shift($prams);
		$query = dbQuery($sql, $prams);
		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	function db0($sql) {
		$prams = func_get_args();
		array_shift($prams);
		$query = dbQuery($sql, $prams);
	}

	function db1($sql) {
		$prams = func_get_args();
		array_shift($prams);
		$query = dbQuery($sql, $prams);
		return $query->fetchObject();
	}
?>
