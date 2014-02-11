$(document).ready(function(){
	/***************************
	* Variaveis de inicialização 
	****************************/
	var userId = $('input[name=userId]').val();
	var expenseCategory = $('select[name=expenseCategory]');
	var incomeCategory = $('select[name=incomeCategory]');
	var monthTableCategory = $('#listCategories');
	
	listaComAnoAtual();

	//Esconde dialog no carregamento
	$('#addCategoryForm').hide();

	//Mensagens
	$('.categoryMsgError').hide();
	$('.displayError').hide();
	$('.categoryMsgSuccess').hide();


    /***************************
	* Inicio das funções 
	****************************/
	$( document ).ajaxStart(function() {
		$('.loader').show();
	});
	$( document ).ajaxStop(function() {
	  	$('.loader').hide();
	});

	function reloadMonthTable(){
		var ano = $('#anoSelect').val();
		monthTableExpenses.empty();
		monthTableIncomes.empty();
		monthTableSaldo.empty();

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

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadSaldo.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableSaldo).append(data);
			}
		});
	}

	function listaComAnoAtual(){
		monthTableCategory.empty();

		var ano = "";

		//Carrega categorias
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategories.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				//$(monthTableCategory).append(data);
			}
		});
	}

	//Carrega despesas ao selecionar o ano
	$('#anoSelect').change(function(){
		var ano = $('#anoSelect').val();
		monthTableCategory.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategories.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableCategory).append(data);
			}
		});
	});
	
	//Criar uma categoria
	$('#addCategory').on('click', function(){
		$('#formAddCategory')[0].reset();
		$('.categoryMsgSuccess').hide();
		$('.categoryMsgError').hide();
		$('.displayError').hide();
		$('#txtCategoryName').removeClass("redBorder");

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

		if(categoryName == ''){
			$('#txtCategoryName').addClass("redBorder");
			$('.categoryMsgSuccess').hide();
			$('.categoryMsgError').hide();
			$('.displayError').show();
		} else {
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
						$('.displayError').hide();
					} else {
						expenseCategory.empty();
						incomeCategory.empty();
						$('.categoryMsgError').hide();
						$('.categoryMsgSuccess').show();
						$('.displayError').hide();

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
		}
		
	});

	//Botão cancelar do formulário
	$('#btnCancelCategoryForm').on('click', function(){
		$( "#addCategoryForm" ).dialog( "destroy" );
	});
	
});