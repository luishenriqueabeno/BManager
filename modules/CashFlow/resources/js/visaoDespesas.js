$(document).ready(function(){
	/***************************
	* Variaveis de inicialização 
	****************************/
	var userId = $('input[name=userId]').val();
	var expenseCategory = $('select[name=expenseCategory]');
	var showExpense = $('#showExpense');
	var expenseBox = $('.expenseBox');
	var monthTableExpenses = $('#listExpenses');
	listaComAnoAtual();
	loadCategories();

	//Esconde dialog no carregamento
	$('#addExpenseForm').hide();
	$('#deleteDialog').hide();

	//Mensagens
	$('.displayError').hide();
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

    //Mask money
	$("#txtExpenseValue").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:".", precision:2});

	//Pega ano atual e troca no select
	$('#anoSelect').val(new Date().getFullYear()).attr('selected');


    /***************************
	* Inicio das funções 
	****************************/
	$( document ).ajaxStart(function() {
		$('.loader').show();
	});
	$( document ).ajaxStop(function() {
	  	$('.loader').hide();
	});

	//Seleciona despesa
	$('#listExpenses').on('click', 'tr:not(:last-child)', function () {
		if($(this).hasClass("highlighted")){
			$(this).removeClass('highlighted');
		} else {
			$(this).addClass('highlighted');
		}
	});

	function reloadMonthTable(){
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
	}

	function listaComAnoAtual(){
		monthTableExpenses.empty();

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
	
	//Adicionar despesas
	$('#addExpense').on('click', function(){
		$('#formAddExpense')[0].reset();
		$('.expenseAddSuccess').hide();
		$('.displayError').hide();
		$('#txtExpenseName').removeClass("redBorder");

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

		if(expenseName == ''){
			$('#txtExpenseName').addClass("redBorder");
			$('.expenseAddSuccess').hide();
			$('.displayError').show();
		} else {
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
						$('.displayError').hide();
						reloadMonthTable();
					}
				}
			});
		}
	});

	//Botão cancelar do formulário
	$('#btnCancelExpenseForm').on('click', function(){
		$( "#addExpenseForm" ).dialog( "destroy" );
	});

	//Carrega categorias ao selecionar o ano
	$('#anoSelect').change(function(){
		var ano = $('#anoSelect').val();
		expenseCategory.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategories.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				var json = $.parseJSON(data);

				for(var i = 0; i < json.length; i++){
					if(json[i].categoryTypeId == 1){
						expenseCategory.append(
							"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
						);
					}
				}
			}
		});
	});

	function loadCategories(){
		var ano = new Date().getFullYear();

		//Carrega categorias
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategories.php',
			data:{
				userId: userId,
				ano: ano
			},
			success: function (data){			
				var json = $.parseJSON(data);

				for(var i = 0; i < json.length; i++){
					if(json[i].categoryTypeId == 1){
						expenseCategory.append(
							"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
						);
					}
				}
			}
		});
	}

	//Edição dos dados diretamente na tabela
	
	 $('#listExpenses').on('click', 'td:not(.total, :first-child)', function(){ 
		var conteudoOriginal = $(this).text(); 
		var rowId = $(this).parent().attr('id');
		var month = $(this).attr('class');
		var ano = $('#anoSelect').val();

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
						ano: ano
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
	
	//Remove despesas selecionadas
	$('#removeExpense').on('click', function(){
		var i = 0;
		var checkSelected = [];

		//Verifica se tem algum item selecionado
		$('.highlighted').each(function(){
			
			//Guarda itens selecionados em um array
			checkSelected[i] = $(this).attr('id');

			i++;
		});

		if(checkSelected.length > 0){
			$( "#deleteDialog" ).dialog({
				resizable: false,
				height:140,
				width:500,
				modal: true,
				buttons: {
					"Sim": function() {
						var i = 0;
						var expenses = [];

						$('.highlighted').each(function(){
							
							//Remove da lista
							$(this).remove();
							
							//Guarda itens selecionados em um array
							expenses[i] = $(this).attr('id');

							i++;
						});

						//Remove do banco
						$.ajax({
							type: 'POST',
							url: 'modules/CashFlow/php/deletaDespesas.php',
							data: { expenses: expenses },
							success: function(data){

							}
						});

						$( this ).dialog( "close" );
					},
					Cancelar: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		} else {
			$( "#deleteDialogSelected" ).dialog({
				modal: true,
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}
	});
});