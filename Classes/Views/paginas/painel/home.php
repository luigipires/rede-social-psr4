<?php
	use Classes\Models\PostagensModel;
?>
	<div class="padding">

		<div class="criar-postagem auxiliar">
			<form postagens method="post" enctype="multipart/form-data">
				<div class="feedback">
					<textarea name="conteudo" placeholder="Diga o que você pensando"></textarea>
				</div>
				<div>
					<label title="Adicionar imagem" for="fotos">
						<h3><i class="fas fa-file-image"></i></h3>
					</label>

					<label title="Adicionar arquivos" for="arquivos">
						<h3><i class="fas fa-file-alt"></i></h3>
					</label>

					<input id="fotos" multiple type="file" name="fotos[]">
					<input id="arquivos" multiple type="file" name="arquivos[]">
				</div>
				<div>
					<input type="hidden" name="post">
					<input type="submit" value="Postar">
				</div>
			</form>
		</div><!-- criar-postagem -->

		<div class="feed-postagens">
			<?php
				$feed = PostagensModel::dataFriends();

				foreach ($feed as $ids){
					$postagens = PostagensModel::getPosts($ids);

					foreach ($postagens as $key => $value){
						$dadosUsuario = PostagensModel::getDataUser($value['usuario_id']);
			?>
			<div class="schema-feed auxiliar">
				<div class="dados-usuario">
					<div class="imagem">
						<div class="foto-usuario">

							<?php
								if($dadosUsuario['foto'] == 0){
							?>	
								<a href="<?php echo PATH; ?>perfil/<?php echo $dadosUsuario['id']; ?>">
									<h3><i class="fas fa-user"></i></h3>
								</a>
							<?php
								}else{
									//montando caminho p/ renderizar foto do usuário
									$nomePasta = 'usuarios/'.ucfirst($dadosUsuario['nome']).'_'.ucfirst($dadosUsuario['sobrenome']);
							?>
								<a href="<?php echo PATH; ?>perfil/<?php echo $dadosUsuario['id']; ?>">
									<img src="<?php echo ASSETS; ?>imagens/<?php echo $nomePasta; ?>/<?php echo $dadosUsuario['foto']; ?>">
								</a>
							<?php
								}
							?>

						</div><!-- foto-usuario -->
					</div><!-- imagem -->
					
					<div class="id-usuario">
						<div class="credenciais">
							<h4><?php echo ucfirst($dadosUsuario['nome']); ?></h4>
							<h4> <?php echo ucfirst($dadosUsuario['sobrenome']); ?></h4>
						</div><!-- credenciais -->
					</div><!-- id-usuario -->

				</div><!-- dados-usuario -->

				<div class="conteudo-postagem">
					<div class="texto-postagem">
						<p><?php echo ucfirst($value['conteudo']); ?></p>
					</div><!-- texto-postagem -->

					<?php
						if($value['nome_pasta'] != ''){
							$imagem = PostagensModel::getImages($value['id']);
					?>
					<div class="imagens-postagem">
						<?php
							if($imagem != false){
								foreach ($imagem as $key2 => $value2){
									//ver aqui tbm
						?>
						<div>
							<img src="<?php echo ASSETS; ?>imagens/postagens/<?php echo $value['nome_pasta']; ?>/<?php echo $value2['nome_imagem']; ?>">

							<?php
								if($_SESSION['id'] == $value['usuario_id']){
							?>

							<div class="funcoes-usuario">
								<h3 excluirImagem title="Excluir imagem"><i target="<?php echo $value2['id']; ?>" class="fas fa-trash-alt"></i></h3>
							</div><!-- funcoes-usuario -->

							<?php
								}
							?>

						</div>
						<?php
								}
							}
						?>
					</div><!-- imagens-postagem -->
					<?php
						}
					?>

					<?php
						if($value['nome_pasta'] != ''){
							$arquivo = PostagensModel::getArchives($value['id']);
					?>
					<div class="anexos-postagem">
						<?php
							if($arquivo != false){
								foreach ($arquivo as $key3 => $value3){
									//pega a extensão do arquivo
									$mimeType = PostagensModel::getMimeType($value3['nome_arquivo']);
									$mimeType = '.'.$mimeType[1];

									foreach (PostagensModel::$mimeTypes as $keyMime => $valueMime){
										if($mimeType == $keyMime){
						?>
						<div>
							<a <?php echo $valueMime; ?> href="<?php echo ASSETS; ?>arquivos/postagens/<?php echo $value['nome_pasta']; ?>/<?php echo $value3['nome_arquivo']; ?>" download="<?php echo $value3['nome_arquivo']; ?>">
								<h3><?php echo PostagensModel::iconMimeType($valueMime); ?></h3>
								<p>Baixar</p>
							</a>
						</div>
						<?php
										}
									}
								}
							}
						?>
					</div><!-- anexos-postagem -->
					<?php
						}
					?>
				</div><!-- conteudo-postagem -->
				
				<?php
					if($_SESSION['id'] == $value['usuario_id']){
				?>

				<div class="funcoes-usuario">
					<h3 editar title="Editar"><i class="fas fa-edit"></i></h3>
					<h3 excluirPost title="Excluir postagem"><i target="<?php echo $value['id']; ?>" class="fas fa-trash-alt"></i></h3>
				</div><!-- funcoes-usuario -->

				<?php
					}
				?>

			</div><!-- schema-feed -->
			<?php
					}
				}
			?>
		</div><!-- feed-postagens -->
	</div><!-- padding -->
</section>