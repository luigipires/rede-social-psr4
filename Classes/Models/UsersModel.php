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
	}
?>