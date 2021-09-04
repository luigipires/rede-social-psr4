<?php
	namespace Classes\Controllers\Errors;
	
	use Classes\Views\puxarViews;

	class ErrorController{

		private $nomeArquivo = 404;
		private $nomeArquivoPainel = '404Painel';

		public function index(){
			$pagina = $this->nomeArquivo;
			$paginaPainel = $this->nomeArquivoPainel;

			if(isset($_SESSION['login'])){
				puxarViews::renderizarErroPainel($paginaPainel);
			}

			puxarViews::renderizarErro($pagina);
		}
	}
?>