<?php
	require("conn.php");

	$email = $_POST['email'];

	$checkEmail = mysql_query ("Select email From users Where email = '$email'");
	$rowsEmail = mysql_num_rows($checkEmail);

	if($rowsEmail == 0){
		echo 1;
	} else {
		$newPass = geraSenha(6);	

		$newPassCripted = md5($newPass);

		$query = "Update users Set password = '$newPassCripted' Where email = '$email'";

		$sql = mysql_query($query);

		echo 2;
	}

	function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		$retorno = '';
		$caracteres = '';

		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;

		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
		$rand = mt_rand(1, $len);
		$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}
?>