<?php
	$metodos = new Classes\Metodos;
?>
<section>
	<div class="cadastro">
		<div class="container">
			<div class="form-cadastro">
				<div>
					<h2>Cadastre-se na plataforma</h2>
				</div>

				<form id="cadastro" method="post" enctype="multipart/form-data">

					<?php
						if(isset($_POST['erro'])){
							echo $_POST['erro'];
						}
					?>

					<div class="feedback">
						<p>Nome</p>
						<input type="text" name="nome" value="<?php echo $metodos->recoverField('nome'); ?>">
					</div>
					<div>
						<p>Sobrenome</p>
						<input type="text" name="sobrenome" value="<?php echo $metodos->recoverField('sobrenome'); ?>">
					</div>
					<div>
						<p>E-mail</p>
						<input type="email" name="email" value="<?php echo $metodos->recoverField('email'); ?>">
					</div>
					<div class="senha">
						<p>Senha</p>
						<input type="password" name="senha">

						<div class="mostrar-senha">
							<h3><i class="fas fa-eye"></i></h3>
						</div><!-- mostrar-senha -->
					</div>
					<div>
						<p>Foto de perfil (opcional)</p>
						<label for="foto">Selecionar imagem</label>
						<input id="foto" type="file" name="foto">
					</div>
					<div>
						<input type="hidden" name="cadastro">
						<input type="submit" name="acao" value="Cadastrar">
					</div>
				</form>
			</div><!-- form-cadastro -->
		</div><!-- container -->
	</div><!-- cadastro -->
</section>