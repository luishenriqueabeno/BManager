<?php
	require('../../../php/conn.php');

	$email = $_POST['email'];

	$query = "Select email from users Where email = '$email'";
	$sql = mysql_query($query);

	$rows = mysql_num_rows($sql);

	if($rows > 0){
		echo true; 
	} else {
		echo false;
	}
?>