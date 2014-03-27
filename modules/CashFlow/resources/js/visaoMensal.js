$(document).ready(function(){

	/****************************
	* Variaveis de inicialização *
	*****************************/
	//Carrega campos
	var expenseCategory = $('select[name=expenseCategory]');
	var incomeCategory = $('select[name=incomeCategory]');
	var expenseBank = $('select[name=expenseBank]');
	var incomeBank = $('select[name=incomeBank]');
	var monthTableExpenses = $('#listExpenses');
	var monthTableIncomes = $('#listIncomes');

	//Esconde formulários e dialogs
	$('#addExpenseForm').hide();
	$('#addIncomeForm').hide();	
	$('#addCategoryForm').hide();
	$('.categoryMsgError').hide();
	$('.displayError').hide();
	$('.categoryMsgSuccess').hide();
	$('.expenseAddSuccess').hide();
	$('.incomeAddSuccess').hide();

	//Pega ano atual e troca no select
	$('#anoSelect').val(new Date().getFullYear()).attr('selected');

	//Armazena id do usuário logado
	var userId = $('input[name=userId]').val();

	//Carrega receitas, despesas na inicialização
	listaComAnoAtual();

	//Carrega categorias na inicialização
	loadCategories();

	//Carrega contas bancárias na inicialização
	loadBanks();

	//Carrega contas bancárias
	loadBanksFilter();

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

    //Mask moneys
	$("#txtIncomeValue").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
	$("#txtExpenseValue").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:".", precision:2});

  
   	/***************************
	*	 Inicio das funções 	*
	****************************/
	$( document ).ajaxStart(function() {
		//Exibe o loader até que a requisição seja concluída
		$('.loader').show();
	});
	$( document ).ajaxStop(function() {
		//Ao terminar uma requisição o loader é escondido
	  	$('.loader').hide();

	  	//Para cada campo que exceda a largura da coluna é feito um tratamento para substituir '_' por ' '
	  	//isso se deve ao fato do retorno não entender ' '
	  	$('.expenseTitle').each(function(){
	  		var titleExpense = $(this).attr('title').split('_').join(' ');
	  		$(this).attr('title', titleExpense);
	  	});

	  	$('.incomeTitle').each(function(){
	  		var titleIncome = $(this).attr('title').split('_').join(' ');
	  		$(this).attr('title', titleIncome);
	  	});

	  	$('.incomeTitleCat').each(function(){
	  		var incomeTitleCat = $(this).attr('title').split('_').join(' ');
	  		$(this).attr('title', incomeTitleCat);
	  	});

	  	$('.expenseTitleCat').each(function(){
	  		var expenseTitleCat = $(this).attr('title').split('_').join(' ');
	  		$(this).attr('title', expenseTitleCat);
	  	});
	});

	/********* Modals *********/

	//Adicionar despesas
	$('#addExpense').on('click', function(){

		//Limpa formulário de despesas
		$('#formAddExpense')[0].reset();

		//Esconde mensagens de sucesso e erro
		$('.expenseAddSuccess').hide();
		$('.displayError').hide();

		//Remove classe que destaca campos a serem corrigidos ou que estão ok
		$('#txtExpenseName').removeClass("redBorder");
		$('#txtExpenseName').removeClass("greenBorder");

		//Exibe modal
		$( "#addExpenseForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Adicionar receita
	$('#addIncome').on('click', function(){
		//Limpa formulário de receitas
		$('#formAddIncome')[0].reset();

		//Esconde mensagens de sucesso e erro
		$('.incomeAddSuccess').hide();
		$('.displayError').hide();

		//Remove classe que destaca campos a serem corrigidos ou que estão ok
		$('#txtIncomeName').removeClass("redBorder");
		$('#txtIncomeName').removeClass("greenBorder");

		//Exibe modal
		$( "#addIncomeForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Criar uma categoria
	$('#addCategory').on('click', function(){
		//Limpa formulário de categorias
		$('#formAddCategory')[0].reset();

		//Esconde mensagens de sucesso e erro
		$('.categoryMsgSuccess').hide();
		$('.categoryMsgError').hide();
		$('.displayError').hide();

		//Remove classe que destaca campos a serem corrigido
		$('#txtCategoryName').removeClass("redBorder");

		//Exibe modal
		$( "#addCategoryForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
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

	/********* Ações *********/

	//Recarrega as tabelas
	function reloadMonthTable(){
		//Pega ano selecionado
		var ano = $('#anoSelect').val();


		//Limpa tabela de despesas
		monthTableExpenses.empty();

		//Limpa tabela de receitas
		monthTableIncomes.empty();

		//Carrega despesas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadExpenses.php',
			data:{
				ano: ano,
				userId: userId,
			},
			success: function(data){
				//Adiciona retorno a tabela de despesas
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
				//Adiciona retorno a tabela de receitas
				$(monthTableIncomes).append(data);
			}
		});
	}

	//Lista itens a partir do ano atual
	function listaComAnoAtual(){
		//Variaveis de controle
		var banks = [];
		var i = 0;

		//Para cada conta bancária selecionada, guarda valores em um array
		$('#theBankList li input:checked').each(function(){
			banks[i] = $(this).val();

			i++;
		});

		//Limpa tabela de despesas
		monthTableExpenses.empty();

		//Limpa tabela de receitas
		monthTableIncomes.empty();

		//Pega ano selecionado	
		var ano = $('#anoSelect').val();

		//Carrega despesas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadExpenses.php',
			data:{
				ano: ano,
				userId: userId,
				banks: banks
			},
			success: function(data){
				//Adiciona retorno a tabela de despesas
				$(monthTableExpenses).append(data);
			}
		});

		//Carrega receitas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadIncomes.php',
			data:{
				ano: ano,
				userId: userId,
				banks: banks
			},
			success: function(data){
				//Adiciona retorno a tabela de receitas
				$(monthTableIncomes).append(data);
			}
		});

	}

	//Carrega dados ao selecionar o ano
	$('#anoSelect').change(function(){
		//Variaveis de controle
		var banks = [];
		var i = 0;

		//Para cada conta bancária selecionada, guarda valores em um array
		$('#theBankList li input:checked').each(function(){
			banks[i] = $(this).val();

			i++;
		});

		//Pega ano selecionado
		var ano = $('#anoSelect').val();

		//Limpa tabela de despesas
		monthTableExpenses.empty();

		//Limpa tabela de receitas
		monthTableIncomes.empty();

		//Carrega despesas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadExpenses.php',
			data:{
				ano: ano,
				userId: userId,
				banks: banks
			},
			success: function(data){
				//Adiciona retorno a tabela de despesas
				$(monthTableExpenses).append(data);
			}
		});

		//Carrega receitas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadIncomes.php',
			data:{
				ano: ano,
				userId: userId,
				banks: banks
			},
			success: function(data){
				//Adiciona retorno a tabela de receitas
				$(monthTableIncomes).append(data);
			}
		});

	});

	
	//Carrega categorias ao selecionar o ano
	$('#anoSelect').change(function(){
		//Pega ano selecionado
		var ano = $('#anoSelect').val();

		//Limpa combox com categorias de natureza despesa
		expenseCategory.empty();

		//Limpa combox com categorias de natureza receitas
		incomeCategory.empty();

		//Carrega categorias
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategories.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				var json = $.parseJSON(data);

				//Cria variavel para guardar options de despesas
				var optExpenses = "";
				var optIncomes = "";

				//Itero retorno
				for(var i = 0; i < json.length; i++){
					//Caso a categoria seja do tipo 'despesa', a mesma é adicionada no combo box de despesa
					if(json[i].categoryTypeId == 1){
						optExpenses += "<option value = " + json[i].id + ">" + json[i].categoryName + "</option>";
					} else {
						//Caso a categoria seja do tipo 'receita', a mesma é adicionada no combo box de receita
						optIncomes += "<option value = " + json[i].id + ">" + json[i].categoryName + "</option>";
					}
				}
				//Guarda no DOM todas as opções de categoria
				expenseCategory.append(optExpenses);
				incomeCategory.append(optIncomes);
			}
		});
	});

	//Carrega categorias no ano atual
	function loadCategories(){
		//Pega ano atual
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

				//Cria variavel para guardar options de despesas
				var optExpenses = "";
				var optIncomes = "";

				//Itero retorno
				for(var i = 0; i < json.length; i++){
					//Caso a categoria seja do tipo 'despesa', a mesma é adicionada no combo box de despesa
					if(json[i].categoryTypeId == 1){
						optExpenses += "<option value = " + json[i].id + ">" + json[i].categoryName + "</option>";
					} else {
						//Caso a categoria seja do tipo 'receita', a mesma é adicionada no combo box de receita
						optIncomes += "<option value = " + json[i].id + ">" + json[i].categoryName + "</option>";
					}
				}
				//Guarda no DOM todas as opções de categoria
				expenseCategory.append(optExpenses);
				incomeCategory.append(optIncomes);
			}
		});
	}

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

	//Valida campo com o nome da receita enquanto digita
	$('#txtIncomeName').keyup(function(){
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

	//Valida campo com o nome da receita ao perder foco
	$('#txtIncomeName').focusout(function(){
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
		var bank = $('select[name=expenseBank]').find(":selected").val();
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
		} else if(bank == ''){
			alert("Favor informe ao menos uma conta bancária");
			//Esconde mensagem de sucesso
			$('.expenseAddSuccess').hide();

			//Esconde mensagem de erro
			$('.displayError').hide();
		} else {
			//Adiciona despesa no banco
			$.ajax({
				type: 'POST',
				url: 'modules/CashFlow/php/addExpense.php',
				data:{
					userId: userId,
					expenseName: expenseName,
					expenseValue: expenseValue,
					ano: ano,
					category: category,
					bank: bank
				},
				success: function (data){
					if(data == 1){
						//Limpa formulário
						$('#formAddExpense')[0].reset();
						$('#txtExpenseName').removeClass("greenBorder");

						//Exibe mensagem de sucesso
						$('.expenseAddSuccess').show();

						//Esconde mensagem de erro
						$('.displayError').hide();

						//Recarrega tabelas
						reloadMonthTable();
					}
				}
			});
		}
	});

	//Adiciona receita no banco
	$('#btnAddIncome').on('click', function(){
		//Carrega dados dos campos
		var incomeName = $('#txtIncomeName').val();
		var ano = $('#anoSelect').val();
		var incomeValue = $('#txtIncomeValue').val();
		var bank = $('select[name=incomeBank]').find(":selected").val();
		var category = $('select[name=incomeCategory]').find(":selected").val();

		//Caso o nome da receita esteja em branco
		if(incomeName == ''){
			//Adiciona classe para destacar campo com problema
			$('#txtIncomeName').addClass("redBorder");

			//Esconde mensagem de sucesso
			$('.incomeAddSuccess').hide();

			//Exibe mensagem de erro
			$('.displayError').show();
		} else if(category == ''){
			alert("Favor informe ao menos uma categoria");
			//Esconde mensagem de sucesso
			$('.incomeAddSuccess').hide();

			//Esconde mensagem de erro
			$('.displayError').hide();
		} else if(bank == ''){
			alert("Favor informe ao menos uma conta bancária");
			//Esconde mensagem de sucesso
			$('.expenseAddSuccess').hide();

			//Esconde mensagem de erro
			$('.displayError').hide();
		} else {
			//Adiciona receitas
			$.ajax({
				type: 'POST',
				url: 'modules/CashFlow/php/addIncome.php',
				data:{
					userId: userId,
					incomeName: incomeName,
					incomeValue: incomeValue,
					ano: ano,
					category: category,
					bank: bank
				},
				success: function (data){
					//Limpa formulário
					$('#formAddIncome')[0].reset();
					$('#txtIncomeName').removeClass("greenBorder");

					if(data == 1){
						//Exibe mensagem de sucesso
						$('.incomeAddSuccess').show();

						//Esconde mensagem de erro
						$('.displayError').hide();

						//Recarrega tabelas
						reloadMonthTable();
					}
				}
			});	
		}
		
	});
	
	//Adiciona categoria no banco
	$('#btnAddCategory').on('click', function(){
		//Carrega dados dos campos
		var categoryName = $('#txtCategoryName').val();
		var categoryTypeId = $('input[name=categoryType]:checked').val();
		var ano = $('#anoSelect').val();

		//Caso o nome da categoria esteja em branco
		if(categoryName == ''){
			//Adiciona classe para destacar campo com problema
			$('#txtCategoryName').addClass("redBorder");

			//Esconde mensagem de sucesso
			$('.categoryMsgSuccess').hide();

			//Esconde mensagem de erro diversos
			$('.categoryMsgError').hide();

			//Exibe mensagem de eero
			$('.displayError').show();
		} else {
			//Adiciona categoria
			$.ajax({
				type: 'POST',
				url: 'modules/CashFlow/php/addCategory.php',
				data:{
					userId: userId,
					categoryName: categoryName,
					categoryTypeId: categoryTypeId,
					ano: ano
				},
				success: function(data){
					if(data == 2){
						//Exibe mensagem de erro
						$('.categoryMsgError').show();

						//Esconde mensagem de sucesso
						$('.categoryMsgSuccess').hide();

						//Esconde mensagens de erro diversas
						$('.displayError').hide();
					} else {
						//Limpa categorias de natureza despesa
						expenseCategory.empty();

						//Limpa categorias de natureza receitas
						incomeCategory.empty();

						//Esconde mensagem de erro
						$('.categoryMsgError').hide();

						//Exibe mensagem de sucesso
						$('.categoryMsgSuccess').show();

						//Esconde mensagens de erro diversas
						$('.displayError').hide();

						var json = $.parseJSON(data);

						//Cria variavel para guardar options de despesas
						var optExpenses = "";
						var optIncomes = "";

						//Iitera retorno
						for(var i = 0; i < json.length; i++){
							//Caso a categoria seja do tipo 'despesa', adiciono item ao combo box despesa
							if(json[i].categoryTypeId == 1){
								optExpenses += "<option value = " + json[i].id + ">" + json[i].categoryName + "</option>";
							} else {
								//Caso a categoria seja do tipo 'receita', adiciono item ao combo box receita
								optIncomes += "<option value = " + json[i].id + ">" + json[i].categoryName + "</option>";
							}
						}
						//Guarda no DOM todas as opções de categoria
						expenseCategory.append(optExpenses);
						incomeCategory.append(optIncomes);
					}
				}
			})
		}
		
	});

	//Edição dos dados diretamente na tabela	
	 $('#listIncomes, #listExpenses').on('click', 'td:not(.total, :first-child)', function(){ 
	 	//Variaveis de controle
		var banks = [];
		var i = 0;

		//Para cada conta bancária selecionada, guarda valores em um array
		$('#theBankList li input:checked').each(function(){
			banks[i] = $(this).val();

			i++;
		});

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
						ano: ano,
						banks: banks
					},
					type: 'POST',
					success: function(data){
						//Recarrego a tabelas
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

	//Carrega contas bancárias
	function loadBanks(){
		//Carrega contas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadBanks.php',
			data:{
				userId: userId
			},
			success: function (data){			
				var json = $.parseJSON(data);

				//Cria variavel para guardar options
				var optBanks = "";

				//Itero retorno
				for(var i = 0; i < json.length; i++){
					
					optBanks += "<option value = " + json[i].id + ">" + json[i].banco + "</option>";
					
				}
				//Guarda no DOM todas as opções
				expenseBank.append(optBanks);
				incomeBank.append(optBanks);
			}
		});
	}

	//Filtro conta bancária
	$(function(){
		$('#menuBanksFilter>ul>li').on({
			mouseenter:function(){
				$(this).siblings().children(":not(:first-child)").hide();
				$(this).children().show();
			},
		})
		$('#menuBanksFilter>ul').on({
			mouseleave:function(){
				$(this).children().children(":not(:first-child)").hide();
			},
		})
	});

	//Confirma filtro com as contas bancárias selecionadas
	$('#sendBanks').on("click", function(){
		listaComAnoAtual();
	})

	function loadBanksFilter(){
		//Envia ajax para carrega todas as contas bancárias cadastradas para o usuário
		$.ajax({
			url: 'modules/CashFlow/php/loadBanks.php',
			data: {
				userId: userId
			},
			type: 'POST',
			success: function(data){
				var json = $.parseJSON(data);

				//Itera resultado e adiciona contas bancárias ao DOM
				for(var i = 0; i < json.length; i++){

					//Cria div com as contas bancárias
					$('#theBankList').append(""+
						"<li> <input type = 'checkbox' value ="+ json[i].id +">"+ json[i].banco + "</li>"+
					"");
				}
			}
		})
	}

	//Calcula saldo
	function calculaSaldo(){
		//Variaveis de controle
		var banks = [];
		var i = 0;

		//Para cada conta bancária selecionada, guarda valores em um array
		$('#theBankList li input:checked').each(function(){
			banks[i] = $(this).val();

			i++;
		});

		//Pega ano selecionado
		var ano = $('#anoSelect').val();

		$.ajax({
			type: 'POST',
			data:{
				banks: banks,
				ano: ano,
				userId: userId
			},
			url: 'modules/CashFlow/php/calculaSaldo.php',
			success: function(data){
				alert(data);
			}
		})
	}
});