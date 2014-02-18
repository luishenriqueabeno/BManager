$(document).ready(function(){

	/****************************
	* Variaveis de inicialização *
	*****************************/
	//Carrega campos
	var expenseCategory = $('select[name=expenseCategory]');
	var monthTableExpenses = $('#listExpenses');

	//Esconde formulários e dialogs
	$('#addExpenseForm').hide();
	$('#deleteDialog').hide();
	$('.displayError').hide();
	$('.expenseAddSuccess').hide();

	//Armazena id do usuário logado
	var userId = $('input[name=userId]').val();

	//Carrega despesas na inicialização
	listaComAnoAtual();

	//Carrega categorias na inicialização
	loadCategories();

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
	*	 Inicio das funções 	*
	****************************/

	//Para qualquer requisição ajax é adicionado um loader na página
	$( document ).ajaxStart(function() {
		//Exibe o loader até que a requisição seja concluída
		$('.loader').show();
	});
	$( document ).ajaxStop(function() {
		//Ao terminar uma requisição o loader é escondido
	  	$('.loader').hide();
	});

	/********* Modals *********/

	//Adicionar despesas
	$('#addExpense').on('click', function(){
		//Limpa o formulário sempre que o usuário clicar para adicionar uma nova despesa
		$('#formAddExpense')[0].reset();

		//Esconde mensagens de sucesso e erro
		$('.expenseAddSuccess').hide();
		$('.displayError').hide();

		//Remove borda que identifica campos a serem corrigidos e campos ok
		$('#txtExpenseName').removeClass("redBorder");
		$('#txtExpenseName').removeClass("greenBorder");

		//Exibe modal
		$( "#addExpenseForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Botão cancelar do formulário
	$('#btnCancelExpenseForm').on('click', function(){
		$( "#addExpenseForm" ).dialog( "destroy" );
	});

	/********* Ações *********/

	//Função para atualizar tabela de despesas (refresh)
	function reloadMonthTable(){
		//Carrega ano selecionado
		var ano = $('#anoSelect').val();

		//Limpa tabela de despesas
		monthTableExpenses.empty();

		//Carrega todas as despesas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				//Adiciona retorno com as despesas na tabela
				$(monthTableExpenses).append(data);
			}
		});
	}

	//Função para listar as despesas com o ano atual
	function listaComAnoAtual(){
		//Limpa tabela de despesas
		monthTableExpenses.empty();

		//Seta a variavel ano como nulo
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
				//Adiciona retorno com as despesas na tabela
				$(monthTableExpenses).append(data);
			}
		});
	}

	//Função para carregar categorias na iniciliazação
	function loadCategories(){
		//Pega o ano atual
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

				//Itera retorno
				for(var i = 0; i < json.length; i++){
					//Adiciona as categorias do tipo 'despesa' no combobox para o ano atual
					if(json[i].categoryTypeId == 1){
						expenseCategory.append(
							"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
						);
					}
				}
			}
		});
	}

	//Seleciona despesa
	$('#listExpenses').on('click', 'tr:not(:last-child)', function () {
		if($(this).hasClass("highlighted")){
			//Caso o campo tenha a classe 'higlighted' a mesma é removida
			$(this).removeClass('highlighted');
		} else {
			//Caso o campo não tenha a classe 'highlighted' a mesma é adicionada
			$(this).addClass('highlighted');
		}
	});

	//Carrega despesas ao selecionar o ano
	$('#anoSelect').change(function(){
		//Define a variavel ano com o ano selecionado
		var ano = $('#anoSelect').val();

		//Limpa tabela de despesas
		monthTableExpenses.empty();

		//Carrega despesas para o ano selecionado
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				//Adiciona retorno com as despesas na tabela
				$(monthTableExpenses).append(data);
			}
		});
	});

	//Carrega categorias ao selecionar o ano
	$('#anoSelect').change(function(){
		//Define a variavel ano com o ano selecionado
		var ano = $('#anoSelect').val();

		//Limpa tabela de categorias
		expenseCategory.empty();

		//Carrega categorias para o ano selecionado
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategories.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				var json = $.parseJSON(data);

				//Adiciona retorno com as categorias no combobox
				for(var i = 0; i < json.length; i++){
					//Adiciono apenas as categorias que são do tipo 'despesa' no combobox
					if(json[i].categoryTypeId == 1){
						expenseCategory.append(
							"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
						);
					}
				}
			}
		});
	});

	//Valida campo com o nome da despesa enquanto digita
	$('#txtExpenseName').keyup(function(){
		if($(this).val() == ''){
			//Adiciona classe para destacar campo com problema
			$(this).removeClass("greenBorder");
			$(this).addClass("redBorder");
		} else {
			//Adiciona classe para destacar campo sem problema
			$(this).addClass("greenBorder");
			$(this).removeClass("redBorder");
		}
	});

	//Valida campo com o nome da despesa ao perder foco
	$('#txtExpenseName').focusout(function(){
		if($(this).val() == ''){
			//Adiciona classe para destacar campo com problema
			$(this).removeClass("greenBorder");
			$(this).addClass("redBorder");
		} else {
			//Adiciona classe para destacar campo sem problema
			$(this).addClass("greenBorder");
			$(this).removeClass("redBorder");
		}
	});
	
	//Adiciona despesa no banco
	$('#btnAddExpense').on('click', function(){
		//Carrega dados dos campos
		var expenseName = $('#txtExpenseName').val();
		var ano = $('#anoSelect').val();
		var expenseValue = $('#txtExpenseValue').val();
		var category = $('select[name=expenseCategory]').find(":selected").val();

		//Caso o nome da despesa esteja em branco
		if($('#txtExpenseName').hasClass('redBorder')){
			//Esconde mensagem de sucesso
			$('.expenseAddSuccess').hide();

			//Exibe mensagem de erro
			$('.displayError').show();
		} else if(category == ''){
			alert("Favor informe ao menos uma categoria");
			//Esconde mensagem de sucesso
			$('.expenseAddSuccess').hide();

			//Esconde mensagem de erro
			$('.displayError').hide();
		} else {
			//Adiciono despesa
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
					//Limpa formulário
					$('#formAddExpense')[0].reset();
					$('#txtExpenseName').removeClass("greenBorder");

					if(data == 1){
						//Exibe mensagem de sucesso
						$('.expenseAddSuccess').show();

						//Esconde mensagens de erro
						$('.displayError').hide();

						//Recarrega tabela de receitas
						reloadMonthTable();
					}
				}
			});
		}
	});

	//Edição dos dados diretamente na tabela	
	 $('#listExpenses').on('click', 'td:not(.total, :first-child)', function(){ 
	 	//Carrega conteúdo original do campo
		var conteudoOriginal = $(this).text(); 

		//Guarda o id do campo em uma variavel
		var rowId = $(this).parent().attr('id');

		//Verifica o nome do mês em que se esta editando
		var month = $(this).attr('class');

		//Verifica ano selecionado
		var ano = $('#anoSelect').val();

		//Muda estilo para edição
		$(this).addClass("celulaEmEdicao"); 

		//Altera campo para um input que recebe como valor o conteúdo original
		$(this).html("<input type='text' value='" + conteudoOriginal + "' />"); 

		//Foca no input
		$(this).children().first().focus(); 

		//Se o input "ouvir" um enter é feito um update na tabela
		$(this).children().first().keypress(function (e) { 
			//Caso haja um 'enter'
			if (e.which == 13) { 
				//O conteúdo digitado no campo é armazenado em uma variavel
				var novoConteudo = $(this).val(); 

				//O campo passa a ter como valor o novo conteudo
				$(this).parent().text(novoConteudo); 

				//A classe é removida e o campo volta para o estado original
				$(this).parent().removeClass("celulaEmEdicao"); 

				//Atualizo o valor no banco de dados
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
						//Recarrego a tabela de despesas
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

		//Array para guardar itens selecionados
		var checkSelected = [];

		//Verifica se tem algum item selecionado
		$('.highlighted').each(function(){
			
			//Guarda itens selecionados em um array
			checkSelected[i] = $(this).attr('id');

			i++;
		});

		//Caso haja algum item selecionado
		if(checkSelected.length > 0){
			$( "#deleteDialog" ).dialog({
				resizable: false,
				height:140,
				width:500,
				modal: true,
				buttons: {
					//Caso o usuário cliquem em 'Sim'
					"Sim": function() {
						var i = 0;

						//Array para armazenar itens selecionados
						var expenses = [];

						//Para cada item selecionado
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
								//Recarrega tabela de despesas
								reloadMonthTable();
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