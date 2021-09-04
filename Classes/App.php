<?php
	namespace Classes;

	class App{

		private $controller;

		private function setApp(){
			$path = 'Classes\Controllers\\';
			// $url = !empty($_GET['url']) ?? '';
			$url = @$_GET['url'];
			$url = explode('/',$url);

			if($url[0] == ''){
				$path.='Home';
			}else{
				if(preg_match('/([-]{1,})/', $url[0])){
					$url = preg_replace('/([-]{1,})/', '', $url[0]);
				}else{
					$url = $url[0];
				}

				$path.=ucfirst(strtolower($url));
			}

			$path.='Controller';

			if(file_exists($path.'.php')){
				$this->controller = new $path();
			}else{
				$path = 'Classes\Controllers\Errors\ErrorController';

				$this->controller = new $path();
			}
		}

		public function run(){
			$this->setApp();
			$this->controller->index();
		}
	}
?>