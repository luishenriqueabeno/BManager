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

	//Abre formulário para alterar foto
	$('.logoInner').on('click', function(){
		//Limpa formulário
		$('#formChangePhoto')[0].reset();

		//Limpa mensagens
		$('#formMessageSuccess').html('');
		$('#formMessageError').html('');

		//Limpa preview da imagem anterior
		$('#previewHolder').attr('src', '');

		//Esconde div com miniatura da imagem selecionada
		$('.imagePreview').hide();

		//Exibe modal
		$( "#userPhotoForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	})

	//Função para carrega miniatura da imagem
	function readURL(input) {
       if (input.files && input.files[0]) {
	       var reader = new FileReader();
	      	reader.onload = function(e) {
        		$('#previewHolder').attr('src', e.target.result);
	       	}

           reader.readAsDataURL(input.files[0]);
       }
   	}

   //Ao selecionar uma imagem é exibida uma miniatura
   $("#filePhoto").change(function() {
       readURL(this);
   });

   //Faz upload da imagem
   $('#btnChangePhoto').on('click', function(){
   		//Altera nome do botão para o usuário saber que esta sendo feito o upload da imagem
   		$(this).attr('value', 'Alterando...');

   		$('#formChangePhoto').on('submit', function(e) {
   			//Previne enviar a mesma imagem mais de uma vez
   			e.preventDefault();
   			e.stopImmediatePropagation();

   			//Dados do formulário
        	var formData = new FormData(this);

        	//Envia via Ajax
	   		$.ajax({
	   			url: 'php/userLogoUpload.php',
	   			data: formData,
	   			type:'POST',
	   			cache:false,
	            contentType: false,
	            processData: false,
	            success:function(data){
	            	//Exibe mensagem de sucesso
	               $('#formMessageSuccess').html(data);

	               //Volta texto do botão para o estado original
	               $('#btnChangePhoto').attr('value', 'Enviar');

	               //Ao finalizar requisição
	               $( document ).ajaxStop(function() {
	               		//Assim que a requisição for finalizada é feito um refresh na página para
	               		//exibir a nova imagem
						location.reload();
					});
	            },
	            error: function(data){
	            	//Exibe mensagem de erro
	                $('#formMessageError').html(data);

	                //Volta texto do botão para o estado original
	                $('#btnChangePhoto').attr('value', 'Enviar');
	            }
	   		});
	   	});
   });

	//Botão cancelar do formulário
	$('#btnChangePhotoCancel').on('click', function(){
		$( "#userPhotoForm" ).dialog( "destroy" );
	});

	//Minimiza area de noticias
	$('.toggleButton').on('click', function(){
		if($('#noticeAreaToggle').hasClass('arrowDown')){
			//Esconde conteudo do container de noticias
			$('.homeInfosTitle').css('display', 'none');
			$('.homeInfosText').css('display', 'none');

			//Reduz altura para que o container fique no canto inferior da página
			$('.homeInfos').css('height', '30px');

			//Alterna imagem da seta
			$(this).removeClass('arrowDown');
			$(this).addClass('arrowUp');
		} else {
			//Exibe conteudo do container de noticias
			$('.homeInfosTitle').css('display', 'block');
			$('.homeInfosText').css('display', 'block');

			//Restaura altura para o tamanho original
			$('.homeInfos').css('height', '250px');

			//Alterna imagem da seta
			$(this).removeClass('arrowUp');
			$(this).addClass('arrowDown');
		}
	});

	//Remove active do link home ao clicar em qualquer outro
	$('.navbar-nav').on('click', function(){
		$('#homeLink').removeClass('firstActive');
	})

	//Link para area de tarefas através da home
	$('#goToTasks').click(function(){
		$('#contentMain').empty();
		$('#contentMain').load('modules/MyTasks/index.php');
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

	//Adiciona o modulo gerencial de usuários para alterar senha
	$("a[name=gerencialChangePass]").click(function () { 
		$('#contentMain').empty();
		$('#contentMain').load('modules/Gerencial/changePass.php');
	});

	//Adiciona o modulo de arquivos
	$("a[name=myFiles]").click(function () { 
		$('#contentMain').empty();
		$('#contentMain').load('modules/MyFiles/index.php');
	});

})