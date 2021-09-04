<?php
	namespace Classes\Controllers;

	use Classes\Views\puxarViews;
	use Classes\Metodos;
	use Classes\MySql;

	use Classes\Models\UsersModel;

	class AmigosController{

		public function index(){
			if(!isset($_SESSION['login'])){
				Metodos::redirecionar(PATH);
			}

			$id = $_SESSION['id'];

			if(UsersModel::amigos($id) == false){
				$data = ['resposta' => ['dado' => 'Não há amigos para mostrar']];
			}else{
				$data = UsersModel::amigos($id);
			}

			puxarViews::renderizarPainel('painel/amigos',$data);
		}
	}
?>