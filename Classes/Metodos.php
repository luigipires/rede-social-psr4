<?php
	namespace Classes;

	class Metodos{

		public static function redirecionar($url){
			echo '<script>window.location.href="'.$url.'"</script>';
			die();
		}

		public static function mensagem($resposta,$mensagem){
			if($resposta == 'sucesso'){
				echo '<div class="sucesso-mensagem">
						<h3><i class="fas fa-check-circle"></i></h3>
						<h2>'.$mensagem.'</h2>
					</div><!-- sucesso-mensagem -->';
			}else if($resposta == 'erro'){
				echo '<div class="erro-mensagem">
						<h3><i class="fas fa-exclamation-triangle"></i></h3>
						<h2>'.$mensagem.'</h2>
					</div><!-- erro-mensagem -->';
			}
		}

		public static function validateImage($imagem){
			if($imagem['type'] == 'image/jpg' || $imagem['type'] == 'image/png' || $imagem['type'] == 'image/jpeg'){
				$tamanhoimagem = intval($imagem['size']/3056);

				if($tamanhoimagem < 700){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		public static function uploadImage($arquivo,$pasta){
			$formatoarquivo = explode('.',$arquivo['name']);
			$arquivonome = uniqid().'.'.$formatoarquivo[count($formatoarquivo) - 1];

			if(move_uploaded_file($arquivo['tmp_name'],IMAGENS.$pasta.'/'.$arquivonome)){
				return $arquivonome;
			}else{
				return false;
			}
		}

		public static function deleteImage($imagem,$pasta){
			@unlink(IMAGENS.$pasta.'/'.$imagem);
		}

		public static function recoverField($post){
			if(isset($_POST[$post])){
				echo $_POST[$post];
			}
		}
	}
?>

