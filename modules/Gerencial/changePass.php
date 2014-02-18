
<?php 
	error_reporting(E_ERROR | E_PARSE);
	require("../../secure.php"); 
	require("../../php/conn.php"); 
	$userId = $_SESSION['userId'];
?>
<!doctype html>
<html lang = "pt">
	<head>
		<title> Cash Flow </title>

		<!-- Meta -->
		<meta charset = "utf-8">

		<!-- CSS -->
		<link type="text/css" rel="stylesheet" href="modules/Gerencial/resources/css/changePass.css">

		<!-- Scripts -->
		<script src = "modules/Gerencial/resources/js/changePass.js" type = "text/javascript"></script>

	</head>
	<body>
		<div class = "centerForm">
			<div class="containerTitle"> Alterar senha </div>
			<form method = "post" id = "formChangePass">
				<div class = "message"> </div>
				<label for "oldPass"> Senha atual </label> <span class = "senhaAtualMsg"> A senha atual deve ter no mínimo seis caracteres </span>
				<input type = "password" id = "actualPass">

				<label for "newPass"> Nova Senha </label>  <span class = "senhaNewMsg"> A nova senha deve ter no mínimo seis caracteres </span>
				<input type = "password" id = "newPass">

				<div class = "formChangePassSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnChangePass" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Alterar senha</span> </button>
					</div>
				</div>
			</form>		
		</div>
	</body>
</html>