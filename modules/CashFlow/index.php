<?php 
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
		<script src = "modules/CashFlow/resources/js/CashFlow.js" type = "text/javascript"></script>

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

				<label for = "expenseDate"> Data </label>
				<input type="text" class = "expenseDate" id="data"> <div class = "formFix"> </div>

				<label for = "expenseCategory"> Categoria </label>
				<select name = "expenseCategory">
					<option value = ""> Selecione uma categoria </option>
					<?php
						$getCategories = mysql_query("Select * From cashflowcategories Where userId = $userId");
						$resCategories = mysql_fetch_object($getCategories);

						while($resCategories = mysql_fetch_object($getCategories)){
							echo "<option value = ". $resCategories->id .">". $resCategories->categoryName ."</option>";
						}
					?>
				</select>
	
				<div class = "formAddExpenseSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnAddExpense" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Adicionar</span> </button>
						<button id = "btnCancelExpenseForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
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

				<div class = "formAddCategorySeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnAddCategory" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Adicionar</span> </button>
						<button id = "btnCancelCategoryForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
					</div>
				</div>
			</form>
		</div>



		<table>
			<tr>
				<th> 
					<a href = "#" id = ""> Cadastrar Receita </a>
					<a href = "#" id = "addExpense"> Cadastrar Despesa </a> 
					<a href = "#" id = "addCategory"> Criar uma categoria </a> 
				</th>
			</tr>
			<tr>
				<th>
					<?php
						$year = Date('Y');

						for($i = 1; $i <= 12; $i++){
							echo date('F', strtotime("$year-$i"));
						}
					?>
				</th>
			</tr>
			<tr>
				<td> </td>
			</tr>
		</table>
	</body>
</html>