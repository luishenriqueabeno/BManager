$(document).ready(function(){
	
	/****************************
	* Variaveis de inicialização *
	*****************************/
	//Carrega campos
	var expenseCategory = $('select[name=expenseCategory]');
	var incomeCategory = $('select[name=incomeCategory]');
	var monthTableCategoryExpenses = $('#listCategoriesExpenses');
	var monthTableCategoryIncomes = $('#listCategoriesIncomes');

	//Esconde formulários e dialogs
	$('#addCategoryForm').hide();
	$('#deleteDialog').hide();
	$('.categoryMsgError').hide();
	$('.displayError').hide();
	$('.categoryMsgSuccess').hide();

	//Armazena id do usuário logado
	var userId = $('input[name=userId]').val();

	//Carrega categorias na inicialização
	listaComAnoAtual();

	//Pega ano atual e troca no select
	$('#anoSelect').val(new Date().getFullYear()).attr('selected');


  	/***************************
	*	 Inicio das funções   	*
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

	//Criar uma categoria
	$('#addCategory').on('click', function(){
		//Limpa o formulário sempre que o usuário clicar para adicionar uma nova categoria
		$('#formAddCategory')[0].reset();

		//Esconde mensagens de sucesso
		$('.categoryMsgSuccess').hide();

		//Esconde mensagens de erro
		$('.categoryMsgError').hide();
		$('.displayError').hide();

		//Remove borda que identifica campos a serem corrigidos
		$('#txtCategoryName').removeClass("redBorder");

		//Exibe modal
		$( "#addCategoryForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Botão cancelar do formulário
	$('#btnCancelCategoryForm').on('click', function(){
		$( "#addCategoryForm" ).dialog( "destroy" );
	});

	/********* Ações *********/

	//Seleciona categoria
	$('#listCategoriesExpenses, #listCategoriesIncomes').on('click', 'tr:not(:last-child)', function () {
		if($(this).hasClass("highlighted")){
			//Caso o campo tenha a classe 'higlighted' a mesma é removida
			$(this).removeClass('highlighted');
		} else {
			//Caso o campo não tenha a classe 'highlighted' a mesma é adicionada
			$(this).addClass('highlighted');
		}
	});

	//Função para listar as categorias com o ano atual
	function listaComAnoAtual(){
		//Limpa tabela de despesas
		monthTableCategoryExpenses.empty();
		//Limpa tabela de receitas
		monthTableCategoryIncomes.empty();

		//Seta a variavel ano como nulo
		var ano = "";

		//Carrega categorias de natureza despesa
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				//Adiciona retorno com as despesas na tabela
				$(monthTableCategoryExpenses).append(data);
			}
		});

		//Carrega categorias de natureza receitas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				//Adiciona retorno com as receitas na tabela
				$(monthTableCategoryIncomes).append(data);
			}
		});
	}

	//Função para recarregar as categorias
	function reloadCategoriesTable(){
		//Limpa tabela de despesas
		monthTableCategoryExpenses.empty();
		//Limpa tabela de receitas
		monthTableCategoryIncomes.empty();

		//Seta a variavel ano como nulo
		var ano = $('#anoSelect').val();

		//Carrega categorias de natureza despesa
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				//Adiciona retorno com as despesas na tabela
				$(monthTableCategoryExpenses).append(data);
			}
		});

		//Carrega categorias de natureza receitas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				//Adiciona retorno com as receitas na tabela
				$(monthTableCategoryIncomes).append(data);
			}
		});
	}
	
	//Adiciona categoria no banco
	$('#btnAddCategory').on('click', function(){
		//Carrega valores dos campos
		var categoryName = $('#txtCategoryName').val();
		var categoryTypeId = $('input[name=categoryType]:checked').val();
		var ano = $('#anoSelect').val();

		//Caso a categoria esteja em branco
		if(categoryName == ''){
			//Adiciona classe para destacar campo com problema
			$('#txtCategoryName').addClass("redBorder");

			//Esconde mensagens de erro e sucesso
			$('.categoryMsgSuccess').hide();
			$('.categoryMsgError').hide();
			$('.displayError').show();
		} else {
			//Adiciona categorias
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
						$('.categoryMsgSuccess').hide();
						$('.displayError').hide();
					} else {
						//Limpa tabela de despesas
						monthTableCategoryExpenses.empty();

						//Limpa tabela de receitas
						monthTableCategoryIncomes.empty();

						//Exibe mensagem de sucesso e esconde mensagens de erro
						$('.categoryMsgError').hide();
						$('.categoryMsgSuccess').show();
						$('.displayError').hide();

						reloadCategoriesTable();
					}
				}
			})
		}
		
	});

	//Carrega receitas ao selecionar o ano
	$('#anoSelect').change(function(){
		//Armazena ano selecionado
		var ano = $('#anoSelect').val();

		//Limpa tabela de receitas
		monthTableCategoryIncomes.empty();

		//Carrega receitas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				//Monta tabela com receitas
				$(monthTableCategoryIncomes).append(data);
			}
		});
	});

	//Carrega despesas ao selecionar o ano
	$('#anoSelect').change(function(){
		//Armazena ano selecionado
		var ano = $('#anoSelect').val();

		//Limpa tabela de receitas
		monthTableCategoryExpenses.empty();

		//Carrega despesas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				//Monta tabela com despesas
				$(monthTableCategoryExpenses).append(data);
			}
		});
	});

	//Remove categorias selecionadas
	$('#removeCategory').on('click', function(){
		var i = 0;

		//Array para armazenas categorias selecionadas
		var checkSelected = [];

		var ano = $('#anoSelect').val();

		//Verifica se tem algum item selecionado
		$('.highlighted').each(function(){
			
			//Guarda itens selecionados em um array
			checkSelected[i] = $(this).attr('id');

			i++;
		});

		//Caso haja mais de um item selecionado
		if(checkSelected.length > 0){
			$( "#deleteDialog" ).dialog({
				resizable: false,
				height:140,
				width:500,
				modal: true,
				buttons: {
					//Se o usuário clicar em 'Sim'
					"Sim": function() {
						var i = 0;

						//Array para armazenar os ids das categorias selecionadas
						var categories = [];

						//Para cada categoria selecionada armazena o ID e o tipo em um array
						$('.highlighted').each(function(){
							
							//Remove da lista
							$(this).remove();
							
							//Guarda itens selecionados em um array
							categories[i] = $(this).attr('id');

							i++;
						});

						//Remove do banco
						$.ajax({
							type: 'POST',
							url: 'modules/CashFlow/php/deletaCategorias.php',
							data: { 
								categories: categories,
								userId: userId
							},
							success: function(data){
								reloadCategoriesTable();
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