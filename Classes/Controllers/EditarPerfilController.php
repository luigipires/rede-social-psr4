<?php
	namespace Classes\Controllers;

	use Classes\Views\puxarViews;
	use Classes\Metodos;
	use Classes\Bcrypt;
	use Classes\MySql;

	use Classes\Models\UsersModel;

	class EditarPerfilController{

		public function index(){

			if(!isset($_SESSION['login'])){
				Metodos::redirecionar(PATH);
			}

			$id = $_SESSION['id'];
			$url = explode('/',$_GET['url']);

			//pega parâmetro para ver qual perfil está sendo acessado
			if($url[1] == $id){
				//mandando informações do usuário para a view
				$nomePasta = ucfirst($_SESSION['nome']).'_'.ucfirst($_SESSION['sobrenome']);

				$data = array('nome_pasta' => $nomePasta);
			}else{
				//redireciona já que o usuário não pode alterar um perfil que não é dele
				Metodos::redirecionar(PATH);
			}

			self::excluirFotoUsuario();

			if(isset($_POST['editar-perfil'])){
				$nome = $_POST['nome-usuario'];
				$sobrenome = $_POST['sobrenome-usuario'];
				$email = $_POST['email-usuario'];
				$senha = $_POST['senha-usuario'];
				$pasta = 'usuarios';

				if($nome == ''){
					$newData = ['type' => 'erro','mensagem' => 'O nome está vazio!'];

					$data = array_merge($data,$newData);
				}else if($sobrenome == ''){
					$newData = ['type' => 'erro','mensagem' => 'O sobrenome está vazio!'];

					$data = array_merge($data,$newData);
				}else if($email == ''){
					$newData = ['type' => 'erro','mensagem' => 'O e-mail está vazio!'];

					$data = array_merge($data,$newData);
				}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$newData = ['type' => 'erro','mensagem' => 'E-mail inválido!'];

					$data = array_merge($data,$newData);
				}else{
					//está registrando nova senha
					if($senha != ''){
						$senhaUser = UsersModel::getUserID($id);
						$senhaUser = $senhaUser['senha'];

						if(!preg_match('/^(?=.*\d)(?=.*[A-Z])[0-9A-Za-z-_.!@#%?]{8,}$/',$senha)){
							//se a senha não bate com as exigências

							$newData = ['type' => 'erro','mensagem' => 'Senha inválida!'];

							$data = array_merge($data,$newData);
						}else if(Bcrypt::check($senha,$senhaUser) == true){
							//se a senha acaba sendo a mesma que a atual

							$newData = ['type' => 'erro','mensagem' => 'A senha é a mesma que a atual!'];

							$data = array_merge($data,$newData);
						}else{
							//se ele está atualizando a foto também

							if($_FILES['foto-usuario']['name'] != ''){
								if(Metodos::validateImage($_FILES['foto-usuario']) == true){
									//nome da pasta
									$pastaUsuario = ucfirst($nome).'_'.ucfirst($sobrenome);

									//deletando foto atual
									$folder = $pasta.'/'.$pastaUsuario;

									Metodos::deleteFile($folder,$_SESSION['foto']);

									//upando foto e encriptando senha
									$foto = Metodos::uploadImage($_FILES['foto-usuario'],$pasta,$pastaUsuario);
									$senha = Bcrypt::hash($senha);
									$dataUpdate = date('Y-m-d H:i:s');

									//atualiza a sessão
									$_SESSION['nome'] = $nome;
									$_SESSION['sobrenome'] = $sobrenome;
									$_SESSION['email'] = $email;
									$_SESSION['foto'] = $foto;

									//atualizando registro
									$sql = MySql::conexaobd()->prepare("UPDATE `usuarios` SET nome = ?, sobrenome = ?, email = ?, senha = ?, foto = ?, data_update = ? WHERE id = ?");
									$sql->execute(array($nome,$sobrenome,$email,$senha,$foto,$dataUpdate,$id));

									//feedback
									$newData = ['type' => 'sucesso','mensagem' => 'Usuário atualizado com sucesso!'];

									$data = array_merge($data,$newData);
								}else{
									$newData = ['type' => 'erro','mensagem' => 'Imagem inválida!'];

									$data = array_merge($data,$newData);
								}
							}else{
								//encriptando senha
								$senha = Bcrypt::hash($senha);
								$dataUpdate = date('Y-m-d H:i:s');

								//atualizando registro
								$sql = MySql::conexaobd()->prepare("UPDATE `usuarios` SET nome = ?, sobrenome = ?, email = ?, senha = ?, data_update = ? WHERE id = ?");
								$sql->execute(array($nome,$sobrenome,$email,$senha,$dataUpdate,$id));

								//atualiza a sessão
								$_SESSION['nome'] = $nome;
								$_SESSION['sobrenome'] = $sobrenome;
								$_SESSION['email'] = $email;
								
								//feedback
								$newData = ['type' => 'sucesso','mensagem' => 'Usuário atualizado com sucesso!'];

								$data = array_merge($data,$newData);
							}
						}
					}else{
						if($_FILES['foto-usuario']['name'] != ''){
							if(Metodos::validateImage($_FILES['foto-usuario']) == true){
								//nome da pasta
								$pastaUsuario = ucfirst($_SESSION['nome']).'_'.ucfirst($_SESSION['sobrenome']);;

								//deletando foto atual
								$folder = $pasta.'/'.$pastaUsuario;

								Metodos::deleteFile($folder,$_SESSION['foto']);

								$dataUpdate = date('Y-m-d H:i:s');

								//upando foto
								$foto = Metodos::uploadImage($_FILES['foto-usuario'],$pasta,$pastaUsuario);

								//atualizando registro
								$sql = MySql::conexaobd()->prepare("UPDATE `usuarios` SET nome = ?, sobrenome = ?, email = ?, foto = ?, data_update = ? WHERE id = ?");
								$sql->execute(array($nome,$sobrenome,$email,$foto,$dataUpdate,$id));

								//atualiza a sessão
								$_SESSION['nome'] = $nome;
								$_SESSION['sobrenome'] = $sobrenome;
								$_SESSION['email'] = $email;
								$_SESSION['foto'] = $foto;

								//feedback
								$newData = ['type' => 'sucesso','mensagem' => 'Usuário atualizado com sucesso!'];

								$data = array_merge($data,$newData);
							}else{
								$newData = ['type' => 'erro','mensagem' => 'Imagem inválida!'];

								$data = array_merge($data,$newData);
							}
						}else{
							$dataUpdate = date('Y-m-d H:i:s');

							//atualizando registro
							$sql = MySql::conexaobd()->prepare("UPDATE `usuarios` SET nome = ?, sobrenome = ?, email = ?, data_update = ? WHERE id = ?");
							$sql->execute(array($nome,$sobrenome,$email,$dataUpdate,$id));

							//atualiza a sessão
							$_SESSION['nome'] = $nome;
							$_SESSION['sobrenome'] = $sobrenome;
							$_SESSION['email'] = $email;
							
							//feedback
							$newData = ['type' => 'sucesso','mensagem' => 'Usuário atualizado com sucesso!'];

							$data = array_merge($data,$newData);
						}
					}
				}
			}

			puxarViews::renderizarPainel('painel/editar-perfil',$data);
		}

		//exclui foto de perfil
		private static function excluirFotoUsuario(){
			if(isset($_GET['excluir-imagem'])){
				$id = $_SESSION['id'];

				//monta o nome da pasta onde está a foto
				$nomePasta = ucfirst($_SESSION['nome']).'_'.ucfirst($_SESSION['sobrenome']);
				$pasta = 'usuarios/'.$nomePasta;

				//deleta a imagem
				Metodos::deleteFile($pasta,$_SESSION['foto']);

				$_SESSION['foto'] = 0;

				//atualiza banco de dados
				$sql = MySql::conexaobd()->prepare("UPDATE `usuarios` SET foto = ? WHERE id = ?");
				$sql->execute(array(0,$id));
			}
		}
	}
?>