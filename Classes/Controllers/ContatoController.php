<?php
	namespace Classes\Controllers;

	use Classes\Views\puxarViews;
	use Classes\Metodos;
	use Classes\MySql;

	class ContatoController{

		public function index(){

			if(isset($_POST['contato'])){
				$nome = $_POST['nome-contato'];
				$email = $_POST['email-contato'];
				$mensagem = $_POST['mensagem-contato'];

				if($nome == ''){
					$data = ['type' => 'erro','mensagem' => 'O nome não foi inserido!'];

					puxarViews::renderizar('inicio/contato',$data);
				}else if($email == ''){
					$data = ['type' => 'erro','mensagem' => 'O e-mail não foi inserido!'];

					puxarViews::renderizar('inicio/contato',$data);
				}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$data = ['type' => 'erro','mensagem' => 'E-mail inválido!'];

					puxarViews::renderizar('inicio/contato',$data);
				}else if($mensagem == ''){
					$data = ['type' => 'erro','mensagem' => 'A mensagem não foi inserida!'];

					puxarViews::renderizar('inicio/contato',$data);
				}else{
					$data = ['type' => 'sucesso','mensagem' => 'Mensagem enviada com sucesso!'];

					puxarViews::renderizar('inicio/contato',$data);
				}
			}

			puxarViews::renderizar('inicio/contato');
		}
	}
?>