
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
		<link type="text/css" rel="stylesheet" href="modules/CashFlow/resources/css/visaoReceitas.css">

		<!-- Scripts -->
		<script src = "modules/CashFlow/resources/js/visaoReceitas.js" type = "text/javascript"></script>

	</head>
	<body>
		<!-- Add income form -->
		<div id="addIncomeForm" title="Cadastrar receita">
			<div class = "incomeAddSuccess"> Receita cadastrada com sucesso! </div>
			<div class = "displayError">Corrija os campos destacados </div>
			<form method = "post" id = "formAddIncome">
				<label for = "incomeName"> Receita </label>
				<input id = "txtIncomeName" type = "text" name = "txtIncomeName" >

				<label for = "incomeValue"> Valor </label>
			        <input id = "txtIncomeValue" name = "txtIncomeValue" class = "cashValue" type = "text" > <div class = "formFix"> </div>

				<label for = "incomeCategory"> Categoria </label>
				<select name = "incomeCategory">
					<option value = ""> Selecione uma categoria </option>
				</select>
				<div class = "formAddIncomeSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnAddIncome" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Adicionar</span> </button>
						<button id = "btnCancelIncomeForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
					</div>
				</div>
			</form>
		</div>

		<!-- Dialogs -->
		<div id="deleteDialog" title="Remover receita(s)">
			<p>
				Esta(s) receita(s) será(ão) excluida(s) permanetemente, tem certeza que deseja prosseguir?
			</p>
		</div>

		<div class = "selectYear">
			<input type = "hidden" value = "" id = "anoRetorno" name = "anoRetorno">
			<select id = "anoSelect">
				<option value = "2013"> 2013 </option>
				<option value = "2014"> 2014 </option>
				<option value = "2015"> 2015 </option>
			</select>
		</div>

		<div class = "cashFlowContainner">
			<div class = "cashContainerTitle"> Gerenciar receitas </div>
			<table id = "cashFlowTable">
				<tr id = "cashPanel">
					<th colspan = "13"> 
						<a href = "#" id = "addIncome"> </a> 
						<a href = "#" id = "removeIncome"> </a>
					</th>
				</tr>
				<tr>
					<th class = "tableTitle taskContainerTitle" colspan = "13">
						Receitas
					</th>
				</tr>
			</table>

			<div class = "loader"> <img src = "resources/images/loading.gif"> </div>
		
			<table id = "tableMonths" >
				<tr class = "months tableRow">
					<td> </td>
					<td> Jan </td>
					<td> Fev </td>
					<td> Mar </td>
					<td> Abr </td>
					<td> Mai </td>
					<td> Jun </td>
					<td> Jul </td>
					<td> Ago </td>
					<td> Set </td>
					<td> Out </td>
					<td> Nov </td>
					<td> Dez</td>
				</tr>	
			</table>			
			<table id = "listIncomes" class = "tabelaEditavel">

			<table>
		</div>	
	</body>
</html>