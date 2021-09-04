<?php
	use Classes\Metodos;
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
						//mostra mensagens de feedback

						if(isset($data)){
							$tipo = $data['type'];
							$mensagem = $data['mensagem'];

							if($tipo == 'erro'){
								Metodos::mensagem($tipo,$mensagem);
							}else if($tipo == 'sucesso'){
								Metodos::mensagem($tipo,$mensagem);
							}
						}
					?>

					<div>
						<p>Nome</p>
						<input type="text" name="nome" value="<?php echo Metodos::recoverField('nome'); ?>">
					</div>
					<div>
						<p>Sobrenome</p>
						<input type="text" name="sobrenome" value="<?php echo Metodos::recoverField('sobrenome'); ?>">
					</div>
					<div>
						<p>E-mail</p>
						<input type="email" name="email-cadastro" value="<?php echo Metodos::recoverField('email-cadastro'); ?>">
					</div>
					<div class="senha">
						<div class="tooltip">
							<p>Senha</p>
							<h3><i class="fas fa-question-circle"></i></h3>

							<div class="text-tooltip">
								<div>
									<p>A senha deve conter, pelo menos, 1 letra maiúscula e 1 número</p>
								</div>
							</div><!-- text-tooltip -->
						</div><!-- tooltip -->
						
						<input type="password" name="senha-cadastro">

						<div class="mostrar-senha">
							<h3><i class="fas fa-eye"></i></h3>
						</div><!-- mostrar-senha -->
					</div><!-- senha -->
					<div>
						<p>Foto de perfil (opcional)</p>
						<label for="foto">Selecionar imagem</label>
						<input id="foto" type="file" name="foto">
					</div>
					<div>
						<input type="hidden" name="cadastro">
						<input type="submit" value="Cadastrar">
					</div>
				</form>
			</div><!-- form-cadastro -->
		</div><!-- container -->
	</div><!-- cadastro -->
</section>