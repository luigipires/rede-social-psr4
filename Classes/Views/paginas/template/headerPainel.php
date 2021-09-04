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
	<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/stylePainel.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/styleError.css">

	<title>Painel - <?php echo ucfirst($_SESSION['nome']); ?></title>

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

	<section class="flex-section">

		<aside class="principal">
			<div class="container">
				<a title="Página inicial" href="<?php echo PATH; ?>">
					<div class="logo">
						<img src="<?php echo ASSETS; ?>imagens/name-logo.png"/>
					</div><!-- logo -->
				</a>

				<nav class="menu-aside">
					<h3>Menu</h3>

					<ul>
						<li>
							<a title="Perfil" href="<?php echo PATH; ?>perfil/<?php echo $_SESSION['id']; ?>">
								<h3><i class="fas fa-user"></i></h3>
								<p>Perfil</p>
							</a>
						</li>

						<li>
							<a title="Amigos" href="<?php echo PATH; ?>amigos">
								<h3><i class="fas fa-user-friends"></i></h3>
								<p>Amigos</p>
							</a>
						</li>

						<li>
							<a title="Comunidade" href="<?php echo PATH; ?>comunidade">
								<h3><i class="fas fa-users"></i></h3>
								<p>Comunidade</p>
							</a>
						</li>

						<li>
							<a title="Sair" href="<?php echo PATH; ?>?sair">
								<h3><i class="fas fa-sign-out-alt"></i></h3>
								<p>Sair</p>
							</a>
						</li>
					</ul>
				</nav><!-- menu-aside -->
			</div><!-- container -->
		</aside><!-- principal -->

		<aside class="responsivo">
			<div class="container">
				<a title="Página inicial" href="<?php echo PATH; ?>">
					<div class="logo">
						<img src="<?php echo ASSETS; ?>imagens/logo.png"/>
					</div><!-- logo -->
				</a>

				<nav class="menu-aside-responsivo">
					<ul>
						<li>
							<a title="Perfil" href="<?php echo PATH; ?>perfil/<?php echo $_SESSION['id']; ?>">
								<h3><i class="fas fa-user"></i></h3>
							</a>
						</li>

						<li>
							<a title="Amigos" href="<?php echo PATH; ?>amigos">
								<h3><i class="fas fa-user-friends"></i></h3>
							</a>
						</li>

						<li>
							<a title="Comunidade" href="<?php echo PATH; ?>comunidade">
								<h3><i class="fas fa-users"></i></h3>
							</a>
						</li>

						<li>
							<a title="Sair" href="<?php echo PATH; ?>?sair">
								<h3><i class="fas fa-sign-out-alt"></i></h3>
							</a>
						</li>
					</ul>
				</nav><!-- menu-aside-responsivo -->
			</div><!-- container -->
		</aside><!-- responsivo -->