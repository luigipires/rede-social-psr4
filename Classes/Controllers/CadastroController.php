<?php
	namespace Classes\Controllers;

	use Classes\Views\puxarViews;
	use Classes\Bcrypt;
	use Classes\Metodos;
	use Classes\MySql;

	use Classes\Models\UsersModel;

	class CadastroController{

		public function index(){

			$data = null;

			if(isset($_POST['cadastro'])){
				$nome = $_POST['nome'];
				$sobrenome = $_POST['sobrenome'];
				$email = $_POST['email-cadastro'];
				$senha = $_POST['senha-cadastro'];
				$tipo_usuario = 1;
				$pasta = 'usuarios';

				if($nome == ''){
					$data = ['type' => 'erro','mensagem' => 'O nome não foi inserido!'];
				}else if($sobrenome == ''){
					$data = ['type' => 'erro','mensagem' => 'O sobrenome não foi inserido!'];
				}else if($email == ''){
					$data = ['type' => 'erro','mensagem' => 'O e-mail não foi inserido!'];
				}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$data = ['type' => 'erro','mensagem' => 'E-mail inválido!'];
				}else if(UsersModel::verifyUser($email) == false){
					$data = ['type' => 'erro','mensagem' => 'Usuário já cadastrado!'];
				}else if($senha == ''){
					$data = ['type' => 'erro','mensagem' => 'A senha não foi inserida!'];
				}else if(!preg_match('/^(?=.*\d)(?=.*[A-Z])[0-9A-Za-z-_.!@#%?]{8,}$/',$senha)){
					$data = ['type' => 'erro','mensagem' => 'Senha inválida!'];
				}else{
					if($_FILES['foto']['name'] != ''){
						if(Metodos::validateImage($_FILES['foto']) == true){
							$pastaUsuario = $nome.'_'.$sobrenome;

							$foto = Metodos::uploadImage($_FILES['foto'],$pasta,$pastaUsuario);
							$senha = Bcrypt::hash($senha);
							$dataCreate = date('Y-m-d H:i:s');
							$dataUpdate = '00/00/0000 00:00:00';
							$dataPostagem = '00/00/0000 00:00:00';

							//inserindo no banco de dados
							$sql = MySql::conexaobd()->prepare("INSERT INTO `usuarios` VALUES (null,?,?,?,?,?,?,?,?,?)");
							$sql->execute(array($nome,$sobrenome,$email,$senha,$foto,$dataCreate,$dataUpdate,$dataPostagem,$tipo_usuario));

							$data = ['type' => 'sucesso','mensagem' => 'Usuário cadastrado com sucesso!'];
						}else{
							$data = ['type' => 'erro','mensagem' => 'Imagem inválida!'];
						}
					}else{
						$senha = Bcrypt::hash($senha);
						$foto = 0;
						$dataCreate = date('Y-m-d H:i:s');
						$dataUpdate = '00/00/0000 00:00:00';
						$dataPostagem = '00/00/0000 00:00:00';

						//inserindo no banco de dados
						$sql = MySql::conexaobd()->prepare("INSERT INTO `usuarios` VALUES (null,?,?,?,?,?,?,?,?,?)");
						$sql->execute(array($nome,$sobrenome,$email,$senha,$foto,$dataCreate,$dataUpdate,$dataPostagem,$tipo_usuario));
						
						$data = ['type' => 'sucesso','mensagem' => 'Usuário cadastrado com sucesso!'];
					}
				}
			}

			puxarViews::renderizar('inicio/cadastro',$data);
		}
	}
?>