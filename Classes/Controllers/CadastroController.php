<?php
	namespace Classes\Controllers;

	use Classes\Views\puxarViews;
	use Classes\Bcrypt;
	use Classes\Metodos;
	use Classes\MySql;

	use Classes\Models\UsersModel;

	class CadastroController{

		public function index(){

			$data['erro'] = null;

			if(isset($_POST['cadastro'])){
				if($_POST['nome'] == ''){
					$data['erro'] = 'Deu erro';
				}
			}

			puxarViews::renderizar('cadastro',['erro' => $data]);
		}
	}
?>