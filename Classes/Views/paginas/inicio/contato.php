<?php
	use Classes\Metodos;
?>
<section>
	<div class="contato">
		<div class="container">
			<h2>Entre em contato</h2>

			<form method="post">

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
					<input type="text" name="nome-contato" value="<?php echo Metodos::recoverField('nome-contato'); ?>">
				</div>

				<div>
					<p>E-mail</p>
					<input type="email" name="email-contato" value="<?php echo Metodos::recoverField('email-contato'); ?>">
				</div>

				<div>
					<p>Mensagem</p>
					<textarea name="mensagem-contato"></textarea>
				</div>

				<div>
					<input type="hidden" name="contato">
					<input type="submit" value="Enviar">
				</div>
			</form>

		</div><!-- container -->
	</div><!-- contato -->
</section>