
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
		<link type="text/css" rel="stylesheet" href="modules/CashFlow/resources/css/style.css">

		<!-- Scripts -->
		<script src = "modules/CashFlow/resources/js/cashFlow.js" type = "text/javascript"></script>
		<!--<script src = "modules/CashFlow/resources/js/cashFlow.min.js" type = "text/javascript"></script>-->


	</head>
	<body>
			<!-- Add expense form -->
			<div id="addExpenseForm" title="Cadastrar despesa">
				<div class = "expenseAddSuccess"> Despesa cadastrada com sucesso! </div>
				<form method = "post" id = "formAddExpense">
					<label for = "expenseName"> Despesa </label>
					<input id = "txtExpenseName" type = "text" name = "txtExpenseName" >

					<label for = "expenseValue"> Valor </label>
 				    <input id = "txtExpenseValue" name = "txtExpenseValue" class = "cashValue" type = "text"> <div class = "formFix"> </div>

					<label for = "expenseCategory"> Categoria </label>
					<select name = "expenseCategory">
						<option value = ""> Selecione uma categoria </option>
					</select>
					<div class = "formAddExpenseSeparator">
						<div class="ui-dialog-buttonset">
							<button id= "btnAddExpense" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Adicionar</span> </button>
							<button id = "btnCancelExpenseForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
						</div>
					</div>
				</form>
			</div>

			<!-- Add income form -->
			<div id="addIncomeForm" title="Cadastrar receita">
				<div class = "incomeAddSuccess"> Receita cadastrada com sucesso! </div>
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

			<!-- Add Category form -->
			<div id="addCategoryForm" title="Criar uma categoria">
				<div class = "categoryMsgSuccess"> Categoria criada com sucesso! </div>
				<div class = "categoryMsgError"> Essa categoria já existe. </div>
				<form method = "post" id = "formAddCategory">
					<label for = "categoryName"> Categoria </label>
					<input id = "txtCategoryName" type = "text" name = "txtCategoryName" >

					<label for = "categoryType"> Escolha a natureza da categoria </label>
					<input type="radio" name="categoryType" value="1" checked>Despesa
					<input type="radio" name="categoryType" value="2">Receita

					<div class = "formAddCategorySeparator">
						<div class="ui-dialog-buttonset">
							<button id= "btnAddCategory" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Adicionar</span> </button>
							<button id = "btnCancelCategoryForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
						</div>
					</div>
				</form>
			</div>
		
		<div class = "selectYear">
			<input type = "hidden" value = "" id = "anoRetorno" name = "anoRetorno">
			<select id = "anoSelect">
				<option value = "2014"> 2014 </option>
			</select>
		</div>

		<div class = "cashFlowContainner">
			<div class = "cashContainerTitle"> Fluxo de caixa </div>
			<table id = "cashFlowTable">
				<tr id = "cashPanel">
					<th colspan = "13"> 
						<a href = "#" id = "addIncome"> Cadastrar Receita </a>
						<a href = "#" id = "addExpense"> Cadastrar Despesa </a> 
						<a href = "#" id = "addCategory"> Criar categoria </a> 
					</th>
				</tr>
				<tr>
					<th class = "tableTitle taskContainerTitle" colspan = "13">
						Visão mensal
					</th>
				</tr>
			</table>
			<table id = "tableMonths" >
				<tr class = "months">
					<td> </td>
					<?php
						$year = date("Y");

						for($i = 1; $i <= 12; $i++ ){
							echo "<td>". date('M', strtotime("$year-$i")) ."</td>";
						}	
					?>
				</tr>	
			</table>
			<table id = "listIncomes" class = "tabelaEditavel">

			<table>
			<table id = "listExpenses" class = "tabelaEditavel">

			<table>
		</div>	
	</body>
</html>