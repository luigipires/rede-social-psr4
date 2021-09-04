<?php
	include('../../../../../config.php');

	use Classes\MySql;
	use Classes\Bcrypt;
	use Classes\Metodos;
	
	use Classes\Models\UsersModel;

	$data['login'] = false;
	$data['mensagem'] = '';

	if(isset($_POST['login'])){
		$email = $_POST['email-login'];
		$senha = $_POST['senha-login'];

		sleep(2);

		if($email == ''){
			$data['login'] = false;
			$data['mensagem'] = 'O e-mail não foi inserido!';
		}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$data['login'] = false;
			$data['mensagem'] = 'E-mail inválido!';
		}else if($senha == ''){
			$data['login'] = false;
			$data['mensagem'] = 'A senha não foi inserida!';
		}else{

			$sql = MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE email = ?");
			$sql->execute(array($email));

			if($sql->rowCount() == 1){

				$senhaUser = $sql->fetch()['senha'];

				if(Bcrypt::check($senha,$senhaUser) == true){
					$data['login'] = true;

					$dado = UsersModel::dataUser($email);

					$_SESSION['login'] = true;
					$_SESSION['id'] = $dado['id'];
					$_SESSION['nome'] = $dado['nome'];
					$_SESSION['sobrenome'] = $dado['sobrenome'];
					$_SESSION['email'] = $dado['email'];
					$_SESSION['foto'] = $dado['foto'];
					$_SESSION['tipo_usuario'] = $dado['tipo_usuario'];
				}else{
					$data['login'] = false;
					$data['mensagem'] = 'A senha está incorreta!';
				}
			}else{
				$data['login'] = false;
				$data['mensagem'] = 'Não existe cadastro neste e-mail!';
			}
		}
	}

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

	die(json_encode($data));
?>