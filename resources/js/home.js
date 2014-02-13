$(document).ready(function(){

	/****************************
	* Variaveis de inicialização *
	*****************************/

	//Local onde conteúdo será carregado
	var contentMainArea = $('#contentMainArea');


	/***************************
	*	 Inicio das funções 	*
	****************************/

	//Adiciona estilo para item ativo do menu
	$('.navbar-nav li').on('click', function(){
		$('.navbar-nav li').each(function(){
			$(this).removeClass('active');	
		});		
		$(this).addClass('active');
	})

	//Adiciona o modulo de tarefas a página
	$("a[name=modulesTasks]").click(function () { 
		$('#contentMain').empty();
		$('#contentMain').load('modules/MyTasks/index.php');
	});

	//Adiciona o modulo de fluxo de caixa na página para exibir a visão mensal
	$("a[name=modulesCashFlowMonth]").click(function () { 
		$('#contentMain').empty();
		$('#contentMain').load('modules/CashFlow/visaoMensal.php');
	});

	//Apresenta despesas do modulo de fluxo de caixa
	$("a[name=modulesCashFlowExpenses]").click(function () { 
		$('#contentMain').empty();
		$('#contentMain').load('modules/CashFlow/visaoDespesas.php');
	});

	//Apresenta receitas do modulo de fluxo de caixa
	$("a[name=modulesCashFlowIncomes]").click(function () { 
		$('#contentMain').empty();
		$('#contentMain').load('modules/CashFlow/visaoReceitas.php');
	});

	//Apresenta categorias do modulo de fluxo de caixa
	$("a[name=modulesCashFlowCategories]").click(function () { 
		$('#contentMain').empty();
		$('#contentMain').load('modules/CashFlow/visaoCategorias.php');
	});

	//Adiciona o modulo gerencial de usuários
	$("a[name=gerencialUsuarios]").click(function () { 
		$('#contentMain').empty();
		$('#contentMain').load('modules/Gerencial/usuarios.php');
	});

})