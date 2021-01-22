<?php
	class TipoFacturaDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		// Listar unidades de medidas
		public function listarTipoFactura()
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL up_listar_tipo_factura()");
				$statement->execute();

				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$tipoFactura = new TipoFactura();
					$tipoFactura->__SET('id_tipoFactura', $r->id_tipoFactura);
					$tipoFactura->__SET('descripcion', $r->descripcion);
					$tipoFactura->__SET('porcentaje', $r->porcentaje);
					$tipoFactura->__SET('fecha_registro', $r->fecha_registro);
					$tipoFactura->__SET('estado', $r->estado);

					$result[] = $tipoFactura;
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