<?php
	namespace Classes\Controllers\Errors;
	
	use Classes\Views\puxarViews;

	class ErrorController{

		private $nomeArquivo = 404;

		public function index(){
			$pagina = $this->nomeArquivo;

			puxarViews::renderizarErro($pagina);
		}
	}
?>