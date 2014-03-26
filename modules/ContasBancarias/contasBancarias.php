<?php 
	error_reporting(E_ERROR | E_PARSE);
	require("../../secure.php"); 
?>
<!doctype html>
<html lang = "pt">
	<head>
		<title> Cash Flow </title>

		<!-- Meta -->
		<meta charset = "utf-8">

		<!-- CSS -->
		<link type="text/css" rel="stylesheet" href="modules/ContasBancarias/resources/css/contasBancarias.css">

		<!-- Scripts -->
		<script src = "modules/ContasBancarias/resources/js/contasBancarias.js" type = "text/javascript"></script>
	</head>
	<body>
		<!-- Formulário para adicionar conta bancária -->
		<div id="addBankForm" title="Cadastrar conta bancária">
			<div class = "msg"> </div>
			<form method = "post" id = "formAddBank">
				<label for = "bankName"> Banco </label>
				<input id = "txtBankName" type = "text" name = "txtBankName" >

				<label for = "agNumber"> Agência </label>
			    <input id = "txtAgNumber" name = "txtAgNumber" type = "text"> <div class = "formFix"> </div>

				<label for = "accNumber"> Conta </label>
			    <input id = "txtAccNumber" name = "txtAccNumber" type = "text"> <div class = "formFix"> </div>

			    <a href = "#" id = "addManagerContact"> Adicionar contato do gerente </a>

			    <div class = "formManagerContact">
				    <label for = "managerName"> Gerente da conta </label>
				    <input id = "txtManagerName" name = "txtManagerName" type = "text"> <div class = "formFix"> </div>

				    <label for = "managerTel"> Telefone do gerente </label>
				    <input id = "txtManagerTel" name = "txtManagerTel" type = "text"> <div class = "formFix"> </div>

				    <label for = "managerEmail"> E-mail do gerente </label>
				    <input id = "txtManagerEmail" name = "txtManagerEmail" type = "text"> <div class = "formFix"> </div>
			    </div>
				
				<div class = "formAddBankSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnAddBank" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Adicionar</span> </button>
						<button id = "btnCancelBankForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancelar</span></button>
					</div>
				</div>
			</form>
		</div>

		<div id = "bankContainer">
			<div class = "bankContainerTitle"> Contas Bancárias </div>	
			<div class = "bankList">
				<div class="table-responsive">
					<table class = "table" id = "bankPanel">
						<tr>
							<td>
								<div class = "bgBtnContainer">
									<a href = "#" id = "addBank"> </a>
								</div>
								<div class = "bgBtnContainer">
									<a href = "#" id = "removeBank"> </a>
								</div>
							</td>
						</tr>
					</table>

					<div class = "loader"> <img src = "resources/images/loading.gif"> </div>

					<table class = "table" id = "bankList">
						<tr>
							<td> Banco </td>
							<td> Conta </td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>