<?php
	require("conn.php");

	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$checkUser = "Select id, email From users Where email = '$username' And password = '$password'";
	$checkUserSql = mysql_query($checkUser);
	$rows = mysql_num_rows($checkUserSql);

	$res = mysql_fetch_object($checkUserSql);

	$userId = $res->id;

	if($rows == 1){
		session_start();
		echo $_SESSION['login'] = "1";
		echo $_SESSION['username'] = $username;
		echo $_SESSION['userId'] = $userId;
		echo $_SESSION['userType'];
	} else {
		echo $_SESSION['login'] = 0;
	}
?>