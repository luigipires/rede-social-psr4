<?php
	include('../config.php');

	$data['sucesso'] = true;
	$data['mensagem'] = '';

	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		sleep(2);

		if($email == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = 'O e-mail não foi inserido!';
		}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$data['sucesso'] = false;
			$data['mensagem'] = 'E-mail inválido!';
		}else if($senha == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = 'A senha não foi inserida!';
		}else{

			$sql = \MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE email = ?");
			$sql->execute(array($email));

			if($sql->rowCount() == 1){

				if(\Bcrypt::check($senha,$senhaUser) == true){
					$data = \UsersModel::dataUser($email);

					// $_SESSION['login'] = true;
					// $_SESSION['id'] = $data['id'];
					// $_SESSION['nome'] = $data['nome'];
					// $_SESSION['sobrenome'] = $data['sobrenome'];
					// $_SESSION['email'] = $data['email'];
					// $_SESSION['foto'] = $data['foto'];
					// $_SESSION['tipo_usuario'] = $data['tipo_usuario'];
					$data['sucesso'] = true;
					$data['mensagem'] = 'Deu certo!';
				}else{
					$data['sucesso'] = false;
					$data['mensagem'] = 'A senha está incorreta!';
				}
			}else{
				$data['sucesso'] = false;
				$data['mensagem'] = 'Não existe cadastro neste e-mail!';
			}
		}
	}

	/*if(isset($_POST['cadastro'])){
		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$tipo_usuario = 1;
		$pasta = 'usuarios';

		sleep(2);

		if($nome == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = 'O nome não foi inserido!';
		}else if($sobrenome == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = 'O sobrenome não foi inserido!';
		}else if($email == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = 'O e-mail não foi inserido!';
		}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$data['sucesso'] = false;
			$data['mensagem'] = 'E-mail inválido!';
		}else if(UsersModel::verifyUser($email) == false){
			$data['sucesso'] = false;
			$data['mensagem'] = 'Usuário já cadastrado!';
		}else if($senha == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = 'A senha não foi inserida!';
		}else if(!preg_match('/^(?=.*\d)(?=.*[A-Z])[0-9A-Za-z-_.!@#%?]{8,}$/',$senha)){
			$data['sucesso'] = false;
			$data['mensagem'] = 'Senha inválida!';
		}else{
			if($_FILES['foto']['name'] != ''){
				if(Metodos::validateImage($_FILES['foto']) == true){
					//verifica se existe cadastro ou não

					$foto = Metodos::uploadImage($_FILES['foto'],$pasta);
					$senha = Bcrypt::hash($senha);

					$sql = MySql::conexaobd()->prepare("INSERT INTO `usuarios` VALUES (null,?,?,?,?,?,?)");
					$sql->execute(array($nome,$sobrenome,$email,$senha,$foto,$tipo_usuario));

					$data['sucesso'] = true;
					$data['mensagem'] = 'Usuário cadastrado com sucesso!';
				}else{
					$foto = null;

					$data['sucesso'] = false;
					$data['mensagem'] = 'Imagem inválida!';
				}
			}else{
				$senha = Bcrypt::hash($senha);
				$foto = null;
				$sql = MySql::conexaobd()->prepare("INSERT INTO `usuarios` VALUES (null,?,?,?,?,?,?)");
				$sql->execute($nome,$sobrenome,$email,$senha,$foto,$tipo_usuario);
				
				$data['sucesso'] = true;
				$data['mensagem'] = 'Usuário cadastrado com sucesso!';
			}
		}
	}*/

	die(json_encode($data));
?>