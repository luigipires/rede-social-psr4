<?php
	namespace Classes\Controllers;

	use Classes\Views\puxarViews;
	use Classes\Metodos;
	use Classes\MySql;
	
	use Classes\Models\UsersModel;

	class ComunidadeController{

		public function index(){
			if(!isset($_SESSION['login'])){
				Metodos::redirecionar(PATH);
			}

			$id = $_SESSION['id'];

			$data = UsersModel::comunidade();

			self::solicitacao();
			self::aceitarSolicitacao();
			self::recusarSolicitacao();

			if(UsersModel::informacaoSolicitacoes($id) == true){
				$anotherData = UsersModel::informacaoSolicitacoes($id);
			}else{
				$anotherData = ['status' => 2,'usuario_1' => null,'usuario_2' => null];
			}

			puxarViews::renderizarPainel('painel/comunidade',$data,$anotherData);
		}

		private static function solicitacao(){
			if(isset($_GET['adicionar'])){
				$usuarioSolicitacao = (int)$_GET['adicionar'];
				$id = $_SESSION['id'];

				UsersModel::adicionarAmigo($id,$usuarioSolicitacao);
			}
		}

		private static function aceitarSolicitacao(){
			if(isset($_GET['aceitar'])){
				$usuarioSolicitacao = (int)$_GET['aceitar'];
				$id = $_SESSION['id'];

				UsersModel::aceitarAmigo($usuarioSolicitacao,$id);
			}
		}

		private static function recusarSolicitacao(){
			if(isset($_GET['recusar'])){
				$usuarioSolicitacao = (int)$_GET['recusar'];
				$id = $_SESSION['id'];

				UsersModel::recusarAmigo($usuarioSolicitacao,$id);
			}
		}
	}
?>