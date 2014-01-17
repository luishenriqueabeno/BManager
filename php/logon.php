<?php
	require("conn.php");

	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$checkUser = "Select email From users Where email = '$username' And password = '$password'";
	$checkUserSql = mysql_query($checkUser);
	$rows = mysql_num_rows($checkUserSql);

	if($rows == 1){
		session_start();
		$_SESSION['login'] = "1";
		$_SESSION['username'] = $username;
		echo $_SESSION['login'];
	} else {
		echo $_SESSION['login'] = 0;
	}
?>