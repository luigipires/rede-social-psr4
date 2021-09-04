<?php
	namespace Classes\Models;

	use Classes\MySql;
	use Classes\Metodos;

	class PostagensModel{

		public static function dataFriends(){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `amizades` WHERE (usuario_1 = ? AND status = ?) OR (usuario_2 = ? AND status = ?)");
			$sql->execute(array($_SESSION['id'],1,$_SESSION['id'],1));

			if($sql->rowCount() == 0){
				$array = array($_SESSION['id']);
			}else{
				$sql = $sql->fetchAll();
				$array = [];

				foreach ($sql as $key => $value){
					if($_SESSION['id'] == $value['usuario_1']){
						$array[] = $value['usuario_2'];
					}else{
						$array[] = $value['usuario_1'];
					}
				}
			}

			$array = array_merge($array,array($_SESSION['id']));

			return $array;
		}

		public static function getPosts($idUser){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `postagens` WHERE usuario_id = ? ORDER BY data_create DESC");
			$sql->execute(array($idUser));

			return $sql->fetchAll();
		}
		
		public static function getImages($image){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `imagens_postagens` WHERE postagem_id = ?");
			$sql->execute(array($image));

			if($sql->rowCount() == 0){
				return false;
			}

			return $sql->fetchAll();
		}

		public static function getArchives($archive){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `arquivos_postagens` WHERE postagem_id = ?");
			$sql->execute(array($archive));

			if($sql->rowCount() == 0){
				return false;
			}

			return $sql->fetchAll();
		}

		public static function getMimeType($type){
			$mimeType = explode('.',$type);

			return $mimeType;
		}

		public static function getDataUser($id){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
			$sql->execute(array($id));

			return $sql->fetch();
		}

		public static function getDataPost($id){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `postagens` WHERE id = ?");
			$sql->execute(array($id));

			return $sql->fetch();
		}

		public static function getDataImage($coluna,$id){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `imagens_postagens` WHERE $coluna = ?");
			$sql->execute(array($id));

			return $sql->fetch();
		}
		
		public static function getDataArchive($coluna,$id){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `arquivos_postagens` WHERE $coluna = ?");
			$sql->execute(array($id));

			return $sql->fetch();
		}

		public static function issetArchive($id){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `arquivos_postagens` WHERE postagem_id = ?");
			$sql->execute(array($id));

			if($sql->rowCount() == 0){
				return false;
			}else{
				return true;
			}
		}

		public static function issetImage($id){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `imagens_postagens` WHERE postagem_id = ?");
			$sql->execute(array($id));

			if($sql->rowCount() == 0){
				return false;
			}else{
				return true;
			}
		}

		//verificar classe mime types
		public static $mimeTypes = [
			'.pdf' => 'pdf',
			'.xls' => 'excel',
			'.mp3' => 'audio',
			'.mp4' => 'video',
			'.wav' => 'wav',
			'.txt' => 'texto',
			'.doc' => 'word'
		];

		public static function iconMimeType($mimeType){
			$icon = '';
			
			if($mimeType == 'pdf'){
				$icon = '<i class="fas fa-file-pdf"></i>';
			}else if($mimeType == 'excel'){
				$icon = '<i class="fas fa-file-excel"></i>';
			}else if($mimeType == 'audio'){
				$icon = '<i class="fas fa-volume-up"></i>';
			}else if($mimeType == 'video'){
				$icon = '<i class="fas fa-video"></i>';
			}else if($mimeType == 'wav'){
				$icon = '<i class="fas fa-file-audio"></i>';
			}else if($mimeType == 'texto'){
				$icon = '<i class="fas fa-file-alt"></i>';
			}else if($mimeType == 'word'){
				$icon = '<i class="fas fa-file-word"></i>';
			}

			return $icon;
		}

		public static function deletePost($id){
			$sql = MySql::conexaobd()->prepare("DELETE FROM `postagens` WHERE id = ?");
			$sql->execute(array($id));
		}

		public static function deleteImage($coluna,$id){
			$sql = MySql::conexaobd()->prepare("DELETE FROM `imagens_postagens` WHERE $coluna = ?");
			$sql->execute(array($id));
		}

		public static function deleteArchive($coluna,$id){
			$sql = MySql::conexaobd()->prepare("DELETE FROM `arquivos_postagens` WHERE $coluna = ?");
			$sql->execute(array($id));
		}
	}
?>