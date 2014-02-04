$(document).ready(function(){
	/***************************
	* Variaveis de inicialização 
	****************************/
	var userId = $('input[name=userId]').val();
	var expenseCategory = $('select[name=expenseCategory]');
	var incomeCategory = $('select[name=incomeCategory]');
	var showExpense = $('#showExpense');
	var expenseBox = $('.expenseBox');
	var monthTableExpenses = $('#listExpenses');
	var monthTableIncomes = $('#listIncomes');
	listaComAnoAtual();

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

    //Mask money
   	// Configuração para campos de Real.
	$("#txtIncomeValue").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
	$("#txtExpenseValue").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:".", precision:2});


    /***************************
	* Inicio das funções 
	****************************/

	function reloadMonthTable(){
		var ano = $('#anoSelect').val();
		monthTableExpenses.empty();
		monthTableIncomes.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableExpenses).append(data);
			}
		});

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableIncomes).append(data);
			}
		});
	}

	function listaComAnoAtual(){
		monthTableExpenses.empty();
		monthTableIncomes.empty();

		var ano = "";

		//Carrega despesas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableExpenses).append(data);
			}
		});

		//Carrega receitas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableIncomes).append(data);
			}
		});
	}

	//Carrega despesas ao selecionar o ano
	$('#anoSelect').change(function(){
		var ano = $('#anoSelect').val();
		monthTableExpenses.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableExpenses).append(data);
			}
		});
	});
	
	//Carrega receitas ao selecionar o ano
	$('#anoSelect').change(function(){
		var ano = $('#anoSelect').val();
		monthTableIncomes.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableIncomes).append(data);
			}
		});
	});
	

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
		var ano = $('#anoSelect').val();
		var expenseValue = $('#txtExpenseValue').val();
		var category = $('select[name=expenseCategory]').find(":selected").val();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/addExpense.php',
			data:{
				userId: userId,
				expenseName: expenseName,
				expenseValue: expenseValue,
				ano: ano,
				category: category
			},
			success: function (data){
				if(data == 1){
					$('.expenseAddSuccess').show();
					reloadMonthTable();
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
		var ano = $('#anoSelect').val();
		var incomeValue = $('#txtIncomeValue').val();
		var category = $('select[name=incomeCategory]').find(":selected").val();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/addIncome.php',
			data:{
				userId: userId,
				incomeName: incomeName,
				incomeValue: incomeValue,
				ano: ano,
				category: category
			},
			success: function (data){
				if(data == 1){
					$('.incomeAddSuccess').show();
					reloadMonthTable();
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


	//Edição dos dados diretamente na tabela
	
	 $('#listIncomes, #listExpenses, #tableSaldo').on('click', 'td:not(.total, :first-child)', function(){ 
		var conteudoOriginal = $(this).text(); 
		var rowId = $(this).parent().attr('id');
		var month = $(this).attr('class');

		//Muda estilo para edição
		$(this).addClass("celulaEmEdicao"); 

		//Altera campo para um input que recebe como valor o conteúdo original
		$(this).html("<input type='text' value='" + conteudoOriginal + "' />"); 

		//Foca no input
		$(this).children().first().focus(); 

		//Se o input "ouvir" um enter é feito um update na tabela
		$(this).children().first().keypress(function (e) { 
			if (e.which == 13) { 
				var novoConteudo = $(this).val(); 
				$(this).parent().text(novoConteudo); 
				$(this).parent().removeClass("celulaEmEdicao"); 

				$.ajax({
					url: 'modules/CashFlow/php/updateTableField.php',
					data: { 
						novoConteudo: novoConteudo,
						rowId: rowId,
						month: month,
						userId: userId,
					},
					type: 'POST',
					success: function(data){
						reloadMonthTable();
					}
				})
			} 
		}); 

		//Volta campo para o estado original
		$(this).children().first().blur(function(){ 
			$(this).parent().text(conteudoOriginal); 
			$(this).parent().removeClass("celulaEmEdicao"); 
		});
	});
	
});