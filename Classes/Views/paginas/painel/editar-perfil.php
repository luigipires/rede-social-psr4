<?php
	use Classes\Metodos;
?>	
	<div class="padding">
		<div class="editar-perfil auxiliar">
			<div class="title">
				<h3><i class="fas fa-user-edit"></i></h3>
				<h2>Editar perfil</h2>
			</div><!-- title -->

			<div class="editar-informacoes">
				<form method="post" enctype="multipart/form-data">

					<?php
						//mostra mensagens de feedback

						if(isset($data['type'])){
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
						<input type="text" name="nome-usuario" value="<?php echo $_SESSION['nome']; ?>">
					</div>

					<div>
						<p>Sobrenome</p>
						<input type="text" name="sobrenome-usuario" value="<?php echo $_SESSION['sobrenome']; ?>">
					</div>

					<div>
						<p>E-mail</p>
						<input type="email" name="email-usuario" value="<?php echo $_SESSION['email']; ?>">
					</div>

					<div class="senha">
						<div class="tooltip">
							<p>Nova senha</p>
							<h3><i class="fas fa-question-circle"></i></h3>

							<div class="text-tooltip">
								<div>
									<p>A senha deve conter, pelo menos, 1 letra maiúscula e 1 número</p>
								</div>
							</div><!-- text-tooltip -->
						</div><!-- tooltip -->
						
						<input type="password" name="senha-usuario">

						<div class="mostrar-senha">
							<h3><i class="fas fa-eye"></i></h3>
						</div><!-- mostrar-senha -->
					</div><!-- senha -->

					<?php
						if($_SESSION['foto'] != 0){
					?>
					<div class="usuario-imagem">
						<p>Foto de perfil atual</p>

						<div>
							<img src="<?php echo ASSETS; ?>/imagens/usuarios/<?php echo $data['nome_pasta']; ?>/<?php echo $_SESSION['foto']; ?>">
							<h3 excluirImagem title="Excluir imagem"><i target="<?php echo $_SESSION['id']; ?>" class="fas fa-trash-alt"></i></h3>
						</div>
					</div><!-- usuario-imagem -->
					<?php
						}
					?>

					<div>
						<?php
							if($_SESSION['foto'] != 0){
						?>
						<p>Selecionar nova foto de perfil</p>
						<?php
							}else{
						?>
						<p>Selecionar foto de perfil</p>
						<?php
							}
						?>
						<label for="foto">Selecionar imagem</label>
						<input type="file" id="foto" name="foto-usuario">
					</div>

					<div>
						<input type="hidden" name="editar-perfil">
						<input type="submit" value="Atualizar">
					</div>
				</form>
			</div><!-- editar-informacoes -->
		</div><!-- editar-perfil -->
	</div><!-- padding -->
</section>