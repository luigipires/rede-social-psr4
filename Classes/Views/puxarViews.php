<?php
	namespace Classes\Views;

	class puxarViews{

		private static $header = 'paginas/template/header.php';
		private static $headerPainel = 'paginas/template/headerPainel.php';
		private static $login = 'paginas/template/login.php';
		private static $footer = 'paginas/template/footer.php';
		private static $footerPainel = 'paginas/template/engines/footerPainel.php';
		private static $modais = 'paginas/template/engines/modais.php';

		public static function renderizar($caminhoPagina,$data = null,$anotherData = null){
			$header = self::$header;
			$login = self::$login;
			$footer = self::$footer;

			include($header);
			include($login);
			include('paginas/'.$caminhoPagina.'.php');
			include($footer);
			die();
		}

		public static function renderizarPainel($caminhoPagina,$data = null,$anotherData = null){
			$headerPainel = self::$headerPainel;
			$footerPainel = self::$footerPainel;
			$modal = self::$modais;

			include($headerPainel);
			include($modal);
			include('paginas/'.$caminhoPagina.'.php');
			include($footerPainel);
			die();
		}

		public static function renderizarErro($pagina){
			$header = self::$header;
			$login = self::$login;
			$footer = self::$footer;

			include($header);
			include($login);
			include('paginas/erro/'.$pagina.'.php');
			include($footer);
			die();
		}

		public static function renderizarErroPainel($caminhoPagina,$data = null){
			$headerPainel = self::$headerPainel;
			$footerPainel = self::$footerPainel;

			include($headerPainel);
			include('paginas/erro/'.$caminhoPagina.'.php');
			include($footerPainel);
			die();
		}
	}
?>