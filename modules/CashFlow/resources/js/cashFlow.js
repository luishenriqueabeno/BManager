$(document).ready(function(){
	/***************************
	* Variaveis de inicialização 
	****************************/
	var userId = $('input[name=userId]').val();
	var expenseCategory = $('select[name=expenseCategory]');
	var incomeCategory = $('select[name=incomeCategory]');
	var showIncome = $('#showIncome');
	var incomeBox = $('.incomeBox');
	var showExpense = $('#showExpense');
	var expenseBox = $('.expenseBox');

	//Esconde dialog no carregamento
	$('#addExpenseForm').hide();
	$('#addIncomeForm').hide();	
	$('#addCategoryForm').hide();

	//Mensagens
	$('.categoryMsgError').hide();
	$('.categoryMsgSuccess').hide();
	$('.expenseAddSuccess').hide();
	$('.incomeAddSuccess').hide();

	//Date picker
    $( "#data" ).datepicker({
    	altFormat: "dd/mm/yyy",
    	dateFormat: "dd/mm/yy",
    	showOtherMonths: true,
      	selectOtherMonths: true,
      	changeMonth: true,
      	changeYear: true
    });

    //Date picker
    $( "#incomeDate" ).datepicker({
    	altFormat: "dd/mm/yyy",
    	dateFormat: "dd/mm/yy",
    	showOtherMonths: true,
      	selectOtherMonths: true,
      	changeMonth: true,
      	changeYear: true
    });

    /***************************
	* Inicio das funções 
	****************************/

	//Limpa tabela
	function clearTable(){
		showIncome.empty();
		showExpense.empty();
		incomeBox.removeClass('showIncome');
		incomeBox.addClass('incomeBox');
		expenseBox.addClass('expenseBox');
		expenseBox.removeClass('showExpense');
	}

	//Carrega categorias
	$.ajax({
		type: 'POST',
		url: 'modules/CashFlow/php/loadCategories.php',
		data:{
			userId: userId,
		},
		beforeSend: function() {
			$('#loading').html("Carregando...");
		},
		success: function (data){
			$('#loading').html("");
			var json = $.parseJSON(data);

			for(var i = 0; i < json.length; i++){
				if(json[i].categoryTypeId == 1){
					expenseCategory.append(
						"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
					);
				} else {
					incomeCategory.append(
						"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
					);
				}
			}
		}
	});

	//Adicionar despesas
	$('#addExpense').on('click', function(){

		//Exibe modal
		$( "#addExpenseForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Adiciona despesa no banco
	$('#btnAddExpense').on('click', function(){
		var expenseName = $('#txtExpenseName').val();
		var expenseValue = $('#txtExpenseValue').val();
		var data = $('#data').val();
		var category = $('select[name=expenseCategory]').find(":selected").val();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/addExpense.php',
			data:{
				userId: userId,
				expenseName: expenseName,
				expenseValue: expenseValue,
				data: data,
				category: category
			},
			success: function (data){
				if(data == 1){
					$('.expenseAddSuccess').show();
					clearTable();
				}
			}
		});
	});

	//Adicionar receita
	$('#addIncome').on('click', function(){

		//Exibe modal
		$( "#addIncomeForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Adiciona receita no banco
	$('#btnAddIncome').on('click', function(){
		var incomeName = $('#txtIncomeName').val();
		var incomeValue = $('#txtIncomeValue').val();
		var data = $('#incomeDate').val();
		var category = $('select[name=incomeCategory]').find(":selected").val();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/addIncome.php',
			data:{
				userId: userId,
				incomeName: incomeName,
				incomeValue: incomeValue,
				data: data,
				category: category
			},
			success: function (data){
				if(data == 1){
					$('.incomeAddSuccess').show();
					clearTable();
				}
			}
		});
	});

	//Criar uma categoria
	$('#addCategory').on('click', function(){

		//Exibe modal
		$( "#addCategoryForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});
	
	//Adiciona categoria no banco
	$('#btnAddCategory').on('click', function(){
		var categoryName = $('#txtCategoryName').val();
		var categoryTypeId = $('input[name=categoryType]:checked').val();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/addCategory.php',
			data:{
				userId: userId,
				categoryName: categoryName,
				categoryTypeId: categoryTypeId
			},
			success: function(data){
				if(data == 2){
					$('.categoryMsgError').show();
					$('.categoryMsgSuccess').hide();
				} else {
					expenseCategory.empty();
					incomeCategory.empty();
					$('.categoryMsgError').hide();
					$('.categoryMsgSuccess').show();

					var json = $.parseJSON(data);

					for(var i = 0; i < json.length; i++){
						if(json[i].categoryTypeId == 1){
							expenseCategory.append(
								"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
							);
						} else {
							incomeCategory.append(
								"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
							);
						}
					}
				}
			}
		})
	});

	//Exibe receitas ao clicar na tabela
	$('#openIncome').on('click', function(){
		
		//Verifica o total de receitas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/listIncomes.php',
			data: { userId: userId },
			success: function(data){
				var json = $.parseJSON(data);

				if(incomeBox.hasClass('incomeBox')){
					for(var i = 0; i < json.length; i++){
						showIncome.append(
							"<tr id = "+ json[i].id +">" + 
								"<td>" + json[i].incomeName + "</td>" +
								"<td>" + json[i].incomeValue + "</td>" +
							"</tr>"
						);					
					}

					incomeBox.removeClass('incomeBox');
					incomeBox.addClass('showIncome');
				} else {
					showIncome.empty();
					incomeBox.removeClass('showIncome');
					incomeBox.addClass('incomeBox');
				}
			}
		});
	});

	//Exibe despesas ao clicar na tabela
	$('#openExpense').on('click', function(){
		
		//Verifica o total de despesas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/listExpenses.php',
			data: { userId: userId },
			success: function(data){
				var json = $.parseJSON(data);

				if(expenseBox.hasClass('expenseBox')){
					for(var i = 0; i < json.length; i++){
						showExpense.append(
							"<tr id = "+ json[i].id +">" + 
								"<td>" + json[i].expenseName + "</td>" +
								"<td>" + json[i].expenseValue + "</td>" +
							"</tr>"
						);					
					}

					expenseBox.removeClass('expenseBox');
					expenseBox.addClass('showExpense');
				} else {
					showExpense.empty();
					expenseBox.removeClass('showExpense');
					expenseBox.addClass('expenseBox');
				}
			}
		});
	});

	//Botão cancelar do formulário
	$('#btnCancelExpenseForm').on('click', function(){
		$( "#addExpenseForm" ).dialog( "destroy" );
	});

	//Botão cancelar do formulário
	$('#btnCancelCategoryForm').on('click', function(){
		$( "#addCategoryForm" ).dialog( "destroy" );
	});

	//Botão cancelar do formulário
	$('#btnCancelIncomeForm').on('click', function(){
		$( "#addIncomeForm" ).dialog( "destroy" );
	});

});