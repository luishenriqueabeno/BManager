
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
		<link type="text/css" rel="stylesheet" href="modules/CashFlow/resources/css/visaoCategorias.css">

		<!-- Scripts -->
		<script src = "modules/CashFlow/resources/js/visaoCategorias.js" type = "text/javascript"></script>

	</head>
	<body>
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
	
		<div class = "selectYear">
			<input type = "hidden" value = "" id = "anoRetorno" name = "anoRetorno">
			<select id = "anoSelect">
				<option value = "2014"> 2014 </option>
			</select>
		</div>

		<div class = "cashFlowContainner">
			<div class = "cashContainerTitle"> Gerenciar categorias </div>
			<table id = "cashFlowTable">
				<tr id = "cashPanel">
					<th colspan = "13"> 
						<a href = "#" id = "addCategory"> Criar categoria </a> 
					</th>
				</tr>
				<tr>
					<th class = "tableTitle taskContainerTitle" colspan = "13">
						Categorias
					</th>
				</tr>
			</table>

			<div class = "loader"> <img src = "resources/images/loading.gif"> </div>
		
			<table id = "tableMonths" >
				<tr class = "months tableRow">
					<td> </td>
					<?php
						$year = date("Y");

						for($i = 1; $i <= 12; $i++ ){
							echo "<td>". date('M', strtotime("$year-$i")) ."</td>";
						}	
					?>
				</tr>	
			</table>
			<table id = "listCategories">

			<table>
		</div>	
	</body>
</html>