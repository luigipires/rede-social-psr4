<?php
	session_start();

	date_default_timezone_set('America/Sao_Paulo');

	define('PATH','http://localhost/desenvolvimento20/redeSocial/');
	define('IMAGENS',__DIR__.'/assets/imagens/');

	//==================================================================
	//conexão com banco de dados
	
	define('HOST','localhost');
	define('DATABASE','redesocial');
	define('USER','root');
	define('PASSWORD','');
?>