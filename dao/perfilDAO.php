<?php
	class PerfilDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		// Listar perfiles
		public function listarPerfil()
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_LISTAR_PERFIL()");
				$statement->execute();

				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$perfil = new Perfil();
					$perfil->__SET('id_perfil', $r->id_perfil);
					$perfil->__SET('descripcion', $r->descripcion);
					$perfil->__SET('fecha_registro', $r->fecha_registro);
					$perfil->__SET('estado', $r->estado);

					$result[] = $perfil;
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