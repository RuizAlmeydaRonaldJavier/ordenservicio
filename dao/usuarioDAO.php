<?php
	class UsuarioDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		public function validarUsuario(Usuario $usuario)
		{
			try
			{
				$result = array();

				$statement = $this->pdo->prepare("CALL up_validar_usuario(?,?,?)");

				$tempUsuario = $usuario->__GET('usuario');
				$tempContrasenia = $usuario->__GET('contrasenia');
				$tempIdPerfil = $usuario->__GET('id_perfil');

				$statement->bindParam(1, $tempUsuario);
				$statement->bindParam(2, $tempContrasenia);
				$statement->bindParam(3, $tempIdPerfil);
				$statement->execute();

				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$usuario = new Usuario();
					$usuario->__SET('id_usuario', $r->id_usuario);
					$usuario->__SET('usuario', $r->usuario);
					//$usuario->__SET('contrasenia',  $r->contrasenia);
					$usuario->__SET('id_perfil', $r->id_perfil);
					//$usuario->__GET('id_perfil')->__SET('descripcion', $r->descripcion);

					$result[] = $usuario;
				}
				return $result;
			}
			catch (Exception $e)
			{
				die($e->getMessage());
			}
		}
	}
?>
