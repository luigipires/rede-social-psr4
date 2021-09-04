<?php
	include('../../../../../config.php');

	if(!isset($_SESSION['login'])){
		die('Você não está logado!');
	}

	use Classes\MySql;
	use Classes\Bcrypt;
	use Classes\Metodos;
	
	use Classes\Models\UsersModel;

	$data['sucesso'] = true;
	$data['mensagem'] = '';

	if(isset($_POST['post'])){
		$conteudo = $_POST['conteudo'];
		$imagens = [];
		$arquivos = [];
		$funcionamento = true;
		$pasta = 'postagens';

		sleep(2);

		if($conteudo == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = 'Campo vazio!';
		}else{

			if($_FILES['fotos']['name'][0] != ''){
				$quantidadeImagens = count($_FILES['fotos']['name']);
				
				//validação imagens
				for($i = 0; $i < $quantidadeImagens; $i++){ 
					$imagensEnviadas = [
						'type' => $_FILES['fotos']['type'][$i],
						'size' => $_FILES['fotos']['size'][$i]
					];

					if(Metodos::validateImage($imagensEnviadas) == false){
						$data['sucesso'] = false;
						$data['mensagem'] = 'Imagens inválidas ou com tamanho excedido!';

						$funcionamento = false;
						break;
					}
				}

				//verificação de arquivos com imagens
				if($_FILES['arquivos']['name'][0] != ''){
					$quantidadeArquivos = count($_FILES['arquivos']['name']);

					//validação arquivos
					for($i = 0; $i < $quantidadeArquivos; $i++){ 
						$arquivosEnviados = [
							'type' => $_FILES['arquivos']['type'][$i],
							'size' => $_FILES['arquivos']['size'][$i]
						];

						if(Metodos::validateFile($arquivosEnviados) == false){
							$data['sucesso'] = false;
							$data['mensagem'] = 'Arquivos inválidos ou com tamanho excedido!';

							$funcionamento = false;
							break;
						}
					}

					if($funcionamento == true){
						$dataName = date('Y_m_d_H_i_s');

						$pastaImagens = ucfirst($_SESSION['nome']).'_'.ucfirst($_SESSION['sobrenome']).'_'.$dataName;
						$pastaArquivos = ucfirst($_SESSION['nome']).'_'.ucfirst($_SESSION['sobrenome']).'_'.$dataName;

						for($i = 0; $i < $quantidadeImagens; $i++){ 
							$imagensEnviadas = [
								'tmp_name' => $_FILES['fotos']['tmp_name'][$i],
								'name' => $_FILES['fotos']['name'][$i]
							];

							$imagens[] = Metodos::uploadImage($imagensEnviadas,$pasta,$pastaImagens);
						}

						//guardar arquivos em um array
						for($i = 0; $i < $quantidadeArquivos; $i++){ 
							$arquivosEnviados = [
								'tmp_name' => $_FILES['arquivos']['tmp_name'][$i],
								'name' => $_FILES['arquivos']['name'][$i]
							];

							$arquivos[] = Metodos::uploadFile($arquivosEnviados,$pasta,$pastaArquivos);
						}

						$nomePasta = $pastaImagens;
						$dataCreate = date('Y-m-d H:i:s');
						$dataUpdate = '';
						$usuarioID = $_SESSION['id'];

						$sql = MySql::conexaobd()->prepare("INSERT INTO `postagens` VALUES (null,?,?,?,?,?)");
						$sql->execute(array($usuarioID,$conteudo,$nomePasta,$dataCreate,$dataUpdate));

						$ultimoID = MySql::conexaobd()->lastInsertId();

						foreach ($imagens as $key => $value){
							$cadastroImagens = MySql::conexaobd()->prepare("INSERT INTO `imagens_postagens` VALUES (null,?,?)");
							$cadastroImagens->execute(array($ultimoID,$value));
						}

						foreach ($arquivos as $key => $value){
							$cadastroArquivos = MySql::conexaobd()->prepare("INSERT INTO `arquivos_postagens` VALUES (null,?,?)");
							$cadastroArquivos->execute(array($ultimoID,$value));
						}

						$data['sucesso'] = true;
						$data['mensagem'] = 'Postagem criada!';
					}
				}else{
					//sem arquivos, mas com imagens
					if($funcionamento == true){
						$dataName = date('Y_m_d_H_i_s');
						
						$pastaImagens = ucfirst($_SESSION['nome']).'_'.ucfirst($_SESSION['sobrenome']).'_'.$dataName;

						for($i = 0; $i < $quantidadeImagens; $i++){ 
							$imagensEnviadas = [
								'tmp_name' => $_FILES['fotos']['tmp_name'][$i],
								'name' => $_FILES['fotos']['name'][$i]
							];

							$imagens[] = Metodos::uploadImage($imagensEnviadas,$pasta,$pastaImagens);
						}

						$nomePasta = $pastaImagens;
						$dataCreate = date('Y-m-d H:i:s');
						$dataUpdate = '';
						$usuarioID = $_SESSION['id'];

						$sql = MySql::conexaobd()->prepare("INSERT INTO `postagens` VALUES (null,?,?,?,?,?)");
						$sql->execute(array($usuarioID,$conteudo,$nomePasta,$dataCreate,$dataUpdate));

						$ultimoID = MySql::conexaobd()->lastInsertId();

						foreach ($imagens as $key => $value){
							$cadastroImagens = MySql::conexaobd()->prepare("INSERT INTO `imagens_postagens` VALUES (null,?,?)");
							$cadastroImagens->execute(array($ultimoID,$value));
						}

						$data['sucesso'] = true;
						$data['mensagem'] = 'Postagem criada!';
					}
				}
			}else if($_FILES['arquivos']['name'][0] != ''){
				//sem imagens, só arquivos
				$quantidadeArquivos = count($_FILES['arquivos']['name']);

				//validação arquivos
				for($i = 0; $i < $quantidadeArquivos; $i++){ 
					$arquivosEnviados = [
						'type' => $_FILES['arquivos']['type'][$i],
						'size' => $_FILES['arquivos']['size'][$i]
					];

					if(Metodos::validateFile($arquivosEnviados) == false){
						$data['sucesso'] = false;
						$data['mensagem'] = 'Arquivos inválidos ou com tamanho excedido!';

						$funcionamento = false;
						break;
					}
				}

				if($funcionamento == true){
					$dataName = date('Y_m_d_H_i_s');

					$pastaArquivos = ucfirst($_SESSION['nome']).'_'.ucfirst($_SESSION['sobrenome']).'_'.$dataName;

					//guardar arquivos em um array
					for($i = 0; $i < $quantidadeArquivos; $i++){ 
						$arquivosEnviados = [
							'tmp_name' => $_FILES['arquivos']['tmp_name'][$i],
							'name' => $_FILES['arquivos']['name'][$i]
						];

						$arquivos[] = Metodos::uploadFile($arquivosEnviados,$pasta,$pastaArquivos);
					}

					$nomePasta = $pastaArquivos;
					$dataCreate = date('Y-m-d H:i:s');
					$dataUpdate = '';
					$usuarioID = $_SESSION['id'];

					$sql = MySql::conexaobd()->prepare("INSERT INTO `postagens` VALUES (null,?,?,?,?,?)");
					$sql->execute(array($usuarioID,$conteudo,$nomePasta,$dataCreate,$dataUpdate));

					$ultimoID = MySql::conexaobd()->lastInsertId();

					foreach ($arquivos as $key => $value){
						$cadastroArquivos = MySql::conexaobd()->prepare("INSERT INTO `arquivos_postagens` VALUES (null,?,?)");
						$cadastroArquivos->execute(array($ultimoID,$value));
					}

					$data['sucesso'] = true;
					$data['mensagem'] = 'Postagem criada!';
				}
			}else{
				//sem imagens e arquivos
				$nomePasta = '';
				$dataCreate = date('Y-m-d H:i:s');
				$dataUpdate = '';
				$usuarioID = $_SESSION['id'];

				$sql = MySql::conexaobd()->prepare("INSERT INTO `postagens` VALUES (null,?,?,?,?,?)");
				$sql->execute(array($usuarioID,$conteudo,$nomePasta,$dataCreate,$dataUpdate));

				$data['sucesso'] = true;
				$data['mensagem'] = 'Postagem criada!';
			}
		}
	}

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

	die(json_encode($data));
?>