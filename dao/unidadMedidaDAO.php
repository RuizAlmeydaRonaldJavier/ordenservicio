<?php
	class UnidadMedidaDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		// Listar unidades de medidas
		public function listarUnidadMedida()
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_LISTAR_UNIDAD_MEDIDA()");
				$statement->execute();

				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$unidadMedida = new UnidadMedida();
					$unidadMedida->__SET('id_unidadMedida', $r->id_unidadMedida);
					$unidadMedida->__SET('descripcion', $r->descripcion);
					$unidadMedida->__SET('fecha_registro', $r->fecha_registro);
					$unidadMedida->__SET('estado', $r->estado);

					$result[] = $unidadMedida;
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