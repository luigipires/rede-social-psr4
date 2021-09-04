<?php
	namespace Classes\Controllers;

	use Classes\Views\puxarViews;
	use Classes\Metodos;
	use Classes\MySql;

	class SobreController{

		public function index(){
			puxarViews::renderizar('inicio/sobre');
		}
	}
?>