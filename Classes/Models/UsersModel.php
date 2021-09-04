<?php
	namespace Classes\Models;

	use Classes\MySql;

	class UsersModel{

		public static function verifyUser($email){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE email = ?");
			$sql->execute(array($email));

			if($sql->rowCount() == 0){
				return true;
			}else{
				return false;
			}
		}

		public static function dataUser($email){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE email = ?");
			$sql->execute(array($email));

			return $sql->fetch();
		}

		public static function amigos($id){
			//se status é 1, então é amigo	
			$amigo = 1;
			
			$verificar = MySql::conexaobd()->prepare("SELECT * FROM `amizades` WHERE (usuario_1 = ? AND status = ?) OR (usuario_2 = ? AND status = ?)");
			$verificar->execute(array($id,$amigo,$id,$amigo));

			if($verificar->rowCount() == 0){
				return false;
			}
			
			$verificar = $verificar->fetchAll();
			$array = [];

			foreach ($verificar as $key => $value){
				if($value['usuario_1'] == $id){
					$array[] = $value['usuario_2'];
				}else{
					$array[] = $value['usuario_1'];
				}
			}
			
			return $array;
		}

		public static function comunidade(){
			$usuarios = MySql::conexaobd()->prepare("SELECT * FROM `usuarios`");
			$usuarios->execute();

			return $usuarios->fetchAll();
		}

		public static function solicitacoes($id){
			//se status é 0, então a solicitação não foi respondida
			$amigo = 0;

			$verificar = MySql::conexaobd()->prepare("SELECT * FROM `amizades` WHERE (usuario_1 = ? AND status = ?) OR (usuario_2 = ? AND status = ?)");
			$verificar->execute(array($id,$amigo,$id,$amigo));

			if($verificar->rowCount() == 0){
				return false;
			}

			$sql = MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE id != ?");
			$sql->execute(array($id));
			
			return $sql->fetchAll();
		}

		public static function adicionarAmigo($idUsuario,$idEnviado){
			$pendente = 0;

			$sql = MySql::conexaobd()->prepare("INSERT INTO `amizades` VALUES(null,?,?,?)");
			$sql->execute(array($idUsuario,$idEnviado,$pendente));
		}

		public static function aceitarAmigo($idUsuario,$idEnviado){
			$status = 1;

			$sql = MySql::conexaobd()->prepare("UPDATE `amizades` SET status = ? WHERE usuario_1 = ? AND usuario_2 = ?");
			$sql->execute(array($status,$idUsuario,$idEnviado));
		}

		public static function recusarAmigo($idUsuario,$idEnviado){
			$status = 0;

			$sql = MySql::conexaobd()->prepare("DELETE FROM `amizades` WHERE usuario_1 = ? AND usuario_2 = ? AND status = ?");
			$sql->execute(array($idUsuario,$idEnviado,$status));
		}

		public static function informacaoSolicitacoes($id){
			$status = 0;

			$verificar = MySql::conexaobd()->prepare("SELECT * FROM `amizades` WHERE (usuario_1 = ? OR usuario_2 = ?) AND status = ?");
			$verificar->execute(array($id,$id,$status));

			if($verificar->rowCount() == 0){
				return false;
			}

			return $verificar->fetch();
		}

		public static function getUserID($id){
			$sql = MySql::conexaobd()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
			$sql->execute(array($id));

			return $sql->fetch();
		}
	}
?>