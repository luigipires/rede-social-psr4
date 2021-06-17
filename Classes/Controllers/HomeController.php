<?php
	namespace Classes\Controllers;

	use Classes\Views\puxarViews;
	use Classes\Bcrypt;
	use Classes\Metodos;
	use Classes\Models\UsersModel;

	class HomeController{

		public function index(){
			if(isset($_SESSION['login'])){
				puxarViews::renderizar('home');
			}else{
				puxarViews::renderizar('initial');
			}
		}
	}
?>