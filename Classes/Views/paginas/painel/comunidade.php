<?php
	use Classes\MySql;
?>
	<div class="padding">
		<div class="comunidade auxiliar">
			<div class="title">
				<h3><i class="fas fa-users"></i></h3>
				<h2>Comunidade</h2>
			</div><!-- title -->

			<div class="schema-comunidade">
				<?php
					//vendo se tem pessoas pra adicionar
					$contagem = [];

					foreach($data as $key => $value){
						$amizades = MySql::conexaobd()->prepare("SELECT * FROM `amizades` WHERE (usuario_1 = ? AND usuario_2 = ? AND status = ?) OR (usuario_1 = ? AND usuario_2 = ? AND status = ?)");
						$amizades->execute(array($value['id'],$_SESSION['id'],1,$_SESSION['id'],$value['id'],1));

						if($amizades->rowCount() == 1){
							continue;
						}

						if($value['id'] == $_SESSION['id']){
							continue;
						}

						$contagem[] = $value['id'];
				?>
				<div class="membros">
					<div class="membro-single">
						<div class="imagem-membro">
							<?php
								//vê se usuário tem foto
								if($value['foto'] == 0){
							?>
							<div>
								<h3><i class="fas fa-user"></i></h3>
							</div>
							<?php
								}else{
									$nomePasta = ucfirst($value['nome']).'_'.ucfirst($value['sobrenome']);
							?>
							<img src="<?php echo ASSETS; ?>imagens/usuarios/<?php echo $nomePasta; ?>/<?php echo $value['foto']; ?>">
							<?php
								}
							?>
						</div><!-- imagem-membro -->

						<div class="dados-membro">
							<h2><?php echo ucfirst($value['nome']); ?></h2>
							<h2> <?php echo ucfirst($value['sobrenome']); ?></h2>

							<div class="acoes">
								<div>
									<a title="Ver perfil" perfil href="<?php echo PATH; ?>perfil/<?php echo $value['id']; ?>">
										<p>Ver perfil</p>
									</a>

								<?php
									if(($anotherData['status'] == 0 && $value['id'] == $anotherData['usuario_1']) || ($anotherData['status'] == 0 && $value['id'] == $anotherData['usuario_2'])){

										//usuario 1 enviou pedido, então está pendente
										if($anotherData['usuario_1'] == $_SESSION['id']){
								?>
									<a pendente href="javascript:void(0);">
										<p>Pendente</p>
									</a>
								<?php
										//usuario 2 recebeu pedido, então ele aceita ou recusa
										}else if($anotherData['usuario_2'] == $_SESSION['id']){
								?>
									<a title="Aceitar convite" check href="<?php echo PATH; ?>comunidade?aceitar=<?php echo $value['id']; ?>">
										<h3><i class="fas fa-check-circle"></i></h3>
										<p>Aceitar</p>
									</a>

									<a title="Rejeitar convite" refuse href="<?php echo PATH; ?>comunidade?recusar=<?php echo $value['id']; ?>">
										<h3><i class="fas fa-times"></i></h3>
										<p>Recusar</p>
									</a>
								<?php
										}
									}else{
										//se não existe pedido, então tem opção pra add
								?>
									<a title="Adicionar" adicionar href="<?php echo PATH; ?>comunidade?adicionar=<?php echo $value['id']; ?>">
										<h3><i class="fas fa-user-plus"></i></h3>
										<p>Adicionar</p>
									</a>
								
								<?php
									}
								?>
								</div>
							</div><!-- acoes -->
						</div><!-- dados-membro -->
					</div><!-- membro-single -->
				</div><!-- membros -->
				<?php

					}

					$quantidade = $contagem;
					
					if(count($quantidade) == 0){
						//verá se terá usuários para poder add
				?>
				<div class="membros">
					<p>Não há usuários para mostrar</p>
				</div><!-- membros -->
				<?php
					}
				?>
			</div><!-- schema-comunidade -->

		</div><!-- comunidade -->
	</div><!-- padding -->
</section>