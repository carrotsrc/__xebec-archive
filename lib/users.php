<?php

/* session data */
function user_session_get_id()
{
	if(session_status() == PHP_SESSION_DISABLED)
		return 0;

	if(!isset($_SESSION['uid']))
		return 0;

	return $_SESSION['uid'];
}

function user_session_set_id($id)
{
	if($id == null)
		unset($_SESSION['uid']);
	else
		$_SESSION['uid'] = $id;
}

/* hashing and stalts */
function user_generate_salt()
{
	$salt =  md5(microtime());
	$salt .=  md5($salt);
	return $salt;
}

function user_hash_password($password, $salt)
{
	$hash = $password.$salt;

	for($i = 0; $i < 7000; $i++) {
		$hasher = hash_init('sha256');
		hash_update($hasher, $hash);
		$hash = hash_final($hasher);
	}

	return $hash;
}


/* database */
function user_db_get_hash($username, $db)
{
	$r = db_query("SELECT `hash` FROM `users` where `username`='$username'", $db);
	if(!$r)
		return null;

	return $r[0]['hash'];
}

function user_db_get_details($username, $db)
{
	return db_query("SELECT * FROM `users` where `username`='$username'", $db);
}

function user_db_exists($username, $db)
{
	if(!$r = db_query("SELECT * FROM `users` WHERE `username`='$username'", $db))
		return false;

	return true;
}

/* routines */
function user_routine_add($username, $email, $password, $db)
{
	if(user_db_exists($username, $db))
		return false;

	$salt = user_generate_salt();
	$hash = user_hash_password($password, $salt);
	if(!db_query("INSERT INTO `users` (`username`, `hash`, `salt`, `email`) VALUES ('$username', '$hash', '$salt', '$email')", $db))
		return false;

	return db_last_id($db);
}

function user_routine_remove($ref)
{
	$sql = "DELETE FROM `users` WHERE ";
	if(is_numeric($ref))
		$sql .= "`id`=";
	else
		$sql .= "`username`=";

	$sql .= "'$ref'";

	return db_query($sql, $db);
}

function user_routine_check_password($username, $password, $db)
{
	$r = user_db_get_details($username, $db);
	if(!$r)
		return false;

	$r = $r[0];
	$hash = user_hash_password($password, $r['salt']);
	if($hash == $r['hash'])
		return true;

	return false;
}
?>
