<?php
	use Classes\Models\UsersModel;
?>
	<div class="padding">
		<div class="amizades auxiliar">
			<div class="title">
				<h3><i class="fas fa-user-friends"></i></h3>
				<h2>Amigos</h2>
			</div><!-- title -->

			<div class="schema-amigos">
				<?php
					if(!isset($data['resposta'])){
						foreach($data as $key => $value){
							$amigos = UsersModel::getUserID($value);
				?>
					<div class="amigos">
						<div class="amigo-single">
							<div class="imagem-amigo">
								<?php
									//vê se usuário tem foto
									if($amigos['foto'] == 0){
								?>
								<div>
									<h3><i class="fas fa-user"></i></h3>
								</div>
								<?php
									}else{
										$nomePasta = ucfirst($amigos['nome']).'_'.ucfirst($amigos['sobrenome']);
								?>
								<div>
									<img src="<?php echo ASSETS; ?>imagens/usuarios/<?php echo $nomePasta; ?>/<?php echo $amigos['foto']; ?>">
								</div>
								<?php
									}
								?>
							</div><!-- imagem-amigo -->

							<div class="dados-amigo">
								<h2><?php echo ucfirst($amigos['nome']); ?></h2>
								<h2><?php echo ucfirst($amigos['sobrenome']); ?></h2>

								<div class="acoes">
									<div>
										<a title="Ver perfil" perfil href="<?php echo PATH; ?>perfil/<?php echo $amigos['id']; ?>">
											<p>Ver perfil</p>
										</a>
									</div>
								</div><!-- acoes -->

							</div><!-- dados-amigo -->
						</div><!-- amigo-single -->
					</div><!-- amigos -->
				<?php
						}
					}else{
				?>
					<div class="amigos">
						<p><?php echo ucfirst($data['resposta']['dado']); ?></p>
					</div><!-- amigos -->
				<?php
					}
				?>
			</div><!-- schema-amigos -->

		</div><!-- amizades -->
	</div><!-- padding -->
</section>