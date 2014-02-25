
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
		<link type="text/css" rel="stylesheet" href="modules/CashFlow/resources/css/visaoDespesas.min.css">

		<!-- Scripts -->
		<script src = "modules/CashFlow/resources/js/visaoDespesas.min.js" type = "text/javascript"></script>

	</head>
	<body>
		<!-- Add expense form -->
		<div id="addExpenseForm" title="Cadastrar despesa">
			<div class = "expenseAddSuccess"> Despesa cadastrada com sucesso! </div>
			<div class = "displayError">Corrija os campos destacados </div>
			<form method = "post" id = "formAddExpense">
				<label for = "expenseName"> Despesa </label>
				<input id = "txtExpenseName" type = "text" name = "txtExpenseName" >

				<label for = "expenseValue"> Valor </label>
				    <input id = "txtExpenseValue" name = "txtExpenseValue" class = "cashValue" type = "text"> <div class = "formFix"> </div>

				<label for = "expenseCategory"> Categoria </label>
				<select name = "expenseCategory">
					<option value = ""> Selecione uma categoria </option>
					<option value = "0"> Cadastrar sem categoria </option>
				</select>
				<div class = "formAddExpenseSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnAddExpense" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Adicionar</span> </button>
						<button id = "btnCancelExpenseForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
					</div>
				</div>
			</form>
		</div>

		<!-- Dialogs -->
		<div id="deleteDialog" title="Remover despesa(s)">
			<p>
				Esta(s) despesa(s) será(ão) excluida(s) permanetemente, tem certeza que deseja prosseguir?
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
			<div class = "cashContainerTitle"> Gerenciar despesas </div>
			<table id = "cashFlowTable">
				<tr id = "cashPanel">
					<th colspan = "13"> 
						<a href = "#" id = "addExpense"> </a> 
						<a href = "#" id = "removeExpense"> </a> 
					</th>
				</tr>
				<tr>
					<th class = "tableTitle taskContainerTitle" colspan = "13">
						Despesas
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
			<table id = "listExpenses" class = "tabelaEditavel">

			<table>
		</div>	
	</body>
</html>