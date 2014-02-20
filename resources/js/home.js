$(document).ready(function(){

	/****************************
	* Variaveis de inicialização *
	*****************************/

	//Local onde conteúdo será carregado
	var contentMainArea = $('#contentMainArea');

	//Exibe data e hora
	var data = new Date();

	var dia = data.getDate(); 
	var mes = data.getMonth();
	var ano4 = data.getFullYear();
	var hora = data.getHours();
	var min = data.getMinutes();

	//Formata antes de exibir
	var str_data = dia + '/' + (mes+1) + '/' + ano4;
	var str_hora = hora + ':' + min;

	//Exibe data e hora
	$('#dataHoraShow').html('<b>Hoje é dia ' + str_data + ' ' + str_hora + '</b>');


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

	//Minimiza area de noticias
	$('.toggleButton').on('click', function(){
		//Esconde conteudo do container de noticias
		$('.homeInfosTitle').css('display', 'none');
		$('.homeInfosText').css('display', 'none');

		//Reduz altura para que o container fique no canto inferior da página
		$('.homeInfos').css('height', '30px');

		//Adiciona classe para informar que o conteudo foi minimizado
		$(this).removeClass('totoggleButtonggle');
		$(this).addClass('toggle');
	});

	//Expande area de noticias
	$('.toggle').on('click', function(){
		alert("OK");
		//Exibe conteudo do container de noticias
		$('.homeInfosTitle').css('display', 'block');
		$('.homeInfosText').css('display', 'block');

		//Aumenta altura para exibir o container
		$('.homeInfos').css('height', '250px');

		//Remove classe usada para informar que o conteúdo foi minimizado
		$('.homeInfos').removeClass('toggle');
	});

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

	//Adiciona o modulo gerencial de usuários para alterar senha
	$("a[name=gerencialChangePass]").click(function () { 
		$('#contentMain').empty();
		$('#contentMain').load('modules/Gerencial/changePass.php');
	});

})