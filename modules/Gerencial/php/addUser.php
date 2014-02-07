<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$firstName = $_POST['firstName'];
	$lastName =  $_POST['lastName'];
	$email = $_POST['email'];
	$password1 =  md5($_POST['password1']);
	$gender = $_POST['gender'];
	$signupDate = date('d/m/Y');
	$modulesPermission = $_POST['modulesPermission'];

	$rows = count($modulesPermission);

	for($i = 0; $i < $rows; $i++){
		$permissions .= $modulesPermission[$i].',';
	}

	$permissions = substr_replace($permissions, '', -1);

	$getProduct = mysql_query("Select productId, email From users Where id = $userId ");
	$resProduct = mysql_fetch_object($getProduct);

	$query = "Insert Into users Values('', '$firstName', '$lastName', '$email', '$password1', $gender, $resProduct->productId, '$signupDate', '$permissions', '$resProduct->email')";

	$sql = mysql_query($query);

	if($sql){
		echo "Usuário cadastrado com sucesso";
	} else {
		echo "Falha ao cadastrar usuário";
	}

?>