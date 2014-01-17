<?php
	require("conn.php");

	$firstName = $_POST['firstName'];
	$lastName =  $_POST['lastName'];
	$email = $_POST['email'];
	$password1 =  md5($_POST['password1']);
	$product =  $_POST['product'];
	$gender = $_POST['gender'];
	$signupDate = date('d/m/Y');

	$query = "Insert Into users Values('', '$firstName', '$lastName', '$email', '$password1', $gender, $product, '$signupDate')";

	$sql = mysql_query($query);

	if($sql){
		echo "Usuário cadastrado com sucesso";
	} else {
		echo "Falha ao cadastrar usuário";
	}

?>