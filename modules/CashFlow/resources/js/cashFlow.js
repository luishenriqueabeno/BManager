$(document).ready(function(){
	/***************************
	* Variaveis de inicialização 
	****************************/
	var userId = $('input[name=userId]').val();
	var expenseCategory = $('select[name=expenseCategory]');

	//Esconde dialog no carregamento
	$('#addExpenseForm').hide();
	$('#addCategoryForm').hide();

	//Mensagens
	$('.categoryMsgError').hide();
	$('.categoryMsgSuccess').hide();
	$('.expenseAddSuccess').hide();

	//Date picker
    $( "#data" ).datepicker({
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

	//Carrega categorias
	$.ajax({
		type: 'POST',
		url: 'modules/CashFlow/php/loadCategories.php',
		data:{
			userId: userId,
		},
		success: function (data){
			var json = $.parseJSON(data);

			for(var i = 0; i < json.length; i++){
				expenseCategory.append(
					"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
				)
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

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/addCategory.php',
			data:{
				userId: userId,
				categoryName: categoryName
			},
			success: function(data){
				if(data == 2){
					$('.categoryMsgError').show();
					$('.categoryMsgSuccess').hide();
				} else {
					expenseCategory.empty();
					$('.categoryMsgError').hide();
					$('.categoryMsgSuccess').show();

					var json = $.parseJSON(data);

					for(var i = 0; i < json.length; i++){
						expenseCategory.append(
							"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
						)
					}
				}
			}
		})
	});

	//Botão cancelar do formulário
	$('#btnCancelExpenseForm').on('click', function(){
		$( "#addExpenseForm" ).dialog( "destroy" );
	});

	//Botão cancelar do formulário
	$('#btnCancelCategoryForm').on('click', function(){
		$( "#addCategoryForm" ).dialog( "destroy" );
	});

});