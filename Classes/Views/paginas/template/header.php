<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<!-- ícone -->
	<link rel="icon" href="<?php echo ASSETS; ?>imagens/icone.ico" type="image/x-icon" />

	<!-- links -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/styleError.css">

	<title>Rede social</title>

	<!-- meta-tags -->

	<!-- responsivo -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">

	<!-- SEO -->
	<meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
	<meta name="author" content="autor do site">

	<!-- SMO -->
	<meta property="og:title" content="título do seu site">
	<meta property="og:site_name" content="nome do seu site">
	<meta property="og:description" content="descrição do seu site">
	<meta property="og:url" content="url do seu site">
	<meta property="og:image" content="imagem/foto do seu site">
	<meta property="og:image:type" content="tipo da imagem/foto do seu site">
</head>
<body>
	<base base="<?php echo PATH; ?>" />

	<header>
		<div class="container">
			<a href="<?php echo PATH; ?>">
				<div class="logo">
					<img src="<?php echo ASSETS; ?>imagens/logo.png">
				</div><!-- logo -->
			</a>

			<nav class="menu-desktop">
				<ul>
					<?php
						if(isset($_SESSION['login'])){
					?>
					<li><a href="<?php echo PATH; ?>"><?php echo ucfirst($_SESSION['nome']); ?></a></li>
					<?php
						}else{
					?>
					<li><a href="<?php echo PATH; ?>">Home</a></li>
					<?php
						}
					?>

					<li><a href="<?php echo PATH; ?>sobre">Sobre</a></li>
					<li><a href="<?php echo PATH; ?>contato">Contato</a></li>

					<?php
						if(!isset($_SESSION['login'])){
					?>
					<li><a login>Entrar</a></li>
					<?php
						}
					?>
				</ul>
			</nav><!-- menu-desktop -->

			<nav class="menu-mobile">
				<h3><i class="fas fa-bars"></i></h3>

				<ul>
					<?php
						if(isset($_SESSION['login'])){
					?>
					<li><a href="<?php echo PATH; ?>"><?php echo ucfirst($_SESSION['nome']); ?></a></li>
					<?php
						}else{
					?>
					<li><a href="<?php echo PATH; ?>">Home</a></li>
					<?php
						}
					?>

					<li><a href="<?php echo PATH; ?>sobre">Sobre</a></li>
					<li><a href="<?php echo PATH; ?>contato">Contato</a></li>

					<?php
						if(!isset($_SESSION['login'])){
					?>
					<li><a login>Entrar</a></li>
					<?php
						}
					?>
				</ul>
			</nav><!-- menu-mobile -->
			
			<div class="clear"></div>
		</div><!-- container -->
	</header>