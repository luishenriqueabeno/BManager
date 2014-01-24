<?php
	require("conn.php");
	require("../lib/phpmailer/class.phpmailer.php");

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

		$mail = new PHPMailer();

		$mail->IsSMTP();
		$mail->Port = 587;
		$mail->Host = "smtp.gmail.com"; // Endereço do servidor SMTP
		//$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
		$mail->Username = 'luis.abeno@gmail.com'; // Usuário do servidor SMTP
		$mail->Password = 'luis089!@'; // Senha do servidor SMTP

		// Define o remetente
		$mail->From = "luis.abeno@gmail.com";
		$mail->FromName = "Luis Henrique";

		// Define os destinatário(s)		
		$mail->AddAddress($email);
		//$mail->AddAddress('ciclano@site.net');
		//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

		// Define os dados técnicos da Mensagem
		$mail->IsHTML(true);
		//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

		// Define a mensagem (Texto e Assunto)
		$mail->Subject  = "Senha recuperada";
		$mail->Body = "Esta é a sua nova senha: <b>HTML</b>! <br /> ". $newPass; 
		//$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n <img src="http://i2.wp.com/blog.thiagobelem.net/wp-includes/images/smilies/icon_smile.gif?w=625" alt=":)" class="wp-smiley" width="15" height="15"> ";

		// Define os anexos (opcional)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

		// Envia o e-mail
		$enviado = $mail->Send();

		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

		// Exibe uma mensagem de resultado
		if ($enviado) {
			echo 2;
		} else {
			echo "Não foi possível enviar o e-mail.<br /><br />";
			echo "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
		}
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