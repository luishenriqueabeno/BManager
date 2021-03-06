<?php
	require ("conn.php");
	
	//Suprime warnings
	error_reporting(E_ERROR | E_PARSE);
	
	//Nome do arquivo
	$fileName = $_FILES["filePhoto"]["name"]; 

	//Tamanho do arquivo
	$fileSize = $_FILES['filePhoto']['size'];

	//Verifica se o arquivo é maior que 2MB (2097152 bytes)
	if($fileSize > 2097152){
		$message = "<b style = 'color:red'>O arquivo é muito grande, o tamanho máximo é de 2MB</b>";
	} else {
	
		//Garente que não haverá uma imagem com o mesmo nome
		$newImageName = 'image_' . date('Y-m-d') . '_' . uniqid() . '_' . $fileName ;
	

		//Id do usuário
		$userId = $_POST['userValuePhotoName'];

		//Pega id do usuário master
		$getMaster = mysql_query("Select userMaster From users Where id = ". $userId. "");
		$resMaster = mysql_fetch_object($getMaster);

		$fileTmpLoc = $_FILES["filePhoto"]["tmp_name"];

		//Local + Nome do arquivo
		$pathAndName = "../resources/images/uploads/". $newImageName;

		//Verifica se o usuário já fez o upload de alguma photo
		//isso servirá para remover a imagem antiga e atualizar o path com a nova
		$checkPhoto = mysql_query("	Select
										id
									From
										userlogo
									Where
										userId = ". $userId ."
								");

		$rowsCheckPhoto = mysql_num_rows($checkPhoto);

		if($rowsCheckPhoto >= 1){

			//Remove imagem antiga
			removeOldFiles($userId, $fileTmpLoc);

			//Foi encontrada photo, faz update do nome imagem
			$updatePhoto = mysql_query ("Update userlogo Set logoName = '". $newImageName ."' Where userId = ". $userId ."");

			//Move arquivo para a pasta
			$moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);

			//Verifica se o arquivo foi movido corretamente
			if ($moveResult == true) {
				$message = "Foto alterada com sucesso.";
			} else {
				$message = "Falha ao alterar foto.";
			}
			
		} else {
			//Não foi encontrada photo, insert
			$insertPhoto = mysql_query ("Insert Into userlogo Values ('', '". $newImageName ."', ". $userId .", '". $resMaster->userMaster."') ");		

			//Move arquivo para a pasta
			$moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);

			//Verifica se o arquivo foi movido corretamente
			if ($moveResult == true) {
				$message = "Foto alterada com sucesso.";
			} else {
				$message = "Falha ao alterar foto.";
			}
		}
	}

	//Função para mover arquivos antigos
	function removeOldFiles($userId, $fileTmpLoc){
		//Verifica nome da imagem atual
		$getName = mysql_query("Select logoName From userlogo Where userId = ". $userId);
		
		//Pega nome do arquivo atual para o usuário especificado
		$resName = mysql_fetch_object($getName);

	
		//Remove imagem antiga
		unlink("../resources/images/uploads/". $resName->logoName);

		
	}

	//Mensagem de retorno
	echo $message;
?>