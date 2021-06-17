<?php
	namespace Classes\Views;

	class puxarViews{

		private static $data = [];

		public static function setData($data){
			self::$data = $data;
		}

		public static function renderizar($pagina,$controller = [],$header = 'paginas/template/header.php',$login = 'paginas/template/login.php',$footer = 'paginas/template/footer.php'){
			include($header);
			include($login);
			include('paginas/'.$pagina.'.php');
			include($footer);
			die();
		}

		public static function renderizarErro($pagina,$header = 'paginas/template/header.php',$login = 'paginas/template/login.php',$footer = 'paginas/template/footer.php'){
			include($header);
			include($login);
			include('paginas/erro/'.$pagina.'.php');
			include($footer);
			die();
		}
	}
?>