
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
		<link type="text/css" rel="stylesheet" href="modules/CashFlow/resources/css/visaoMensal.css">

		<!-- Scripts -->
		<script src = "modules/CashFlow/resources/js/visaoMensal.js" type = "text/javascript"></script>
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
				</select>

				<label for = "expenseBank"> Conta bancária </label>
				<select name = "expenseBank">
					<option value = ""> Selecione uma conta bancária </option>
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

				<label for = "incomeBank"> Conta bancária </label>
				<select name = "incomeBank">
					<option value = ""> Selecione uma conta bancária </option>
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
			<div class = "displayError">Corrija os campos destacados </div>
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
		
		<div class = "selectBank">
			
			<div id="menuBanksFilter">
				<ul>
					<li>
						<a href = "#"> Contas bancárias  </a>
						<ul id = "theBankList">
							
							<button id = "sendBanks"> OK </button>
						</ul>
					</li>
				</ul>
			</div>

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

			<div class = "loader"> <img src = "resources/images/loading.gif"> </div>
		
			<div class = "tableAxisXFix">
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
				<table id = "tableSaldo" >
					
				</table>
				<table id = "listIncomes" class = "tabelaEditavel">

				</table>
				<table id = "listExpenses" class = "tabelaEditavel">

				</table>
			</div>
		</div>	
	</body>
</html>