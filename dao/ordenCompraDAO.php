<?php
	class OrdenCompraDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		// Listar ordenes de compras
		public function listarOrdenCompra()
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_LISTAR_ORDEN_COMPRA()");
				$statement->execute();

				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$ordenCompra = new OrdenCompra();
					$ordenCompra->__SET('id_ordenCompra', $r->id_ordenCompra);
					$ordenCompra->__SET('numero_ordenCompra', $r->numero_ordenCompra);
					$ordenCompra->__SET('fecha', $r->fecha);
					$ordenCompra->__SET('requerimiento_referencia', $r->requerimiento_referencia);
					$ordenCompra->__SET('informe_referencia', $r->informe_referencia);
					$ordenCompra->__SET('sub_total', $r->sub_total);
					$ordenCompra->__SET('igv', $r->igv);
					$ordenCompra->__SET('total', $r->total);
					$ordenCompra->__SET('observacion', $r->observacion);
					$ordenCompra->__SET('fecha_registro', $r->fecha_registro);
					$ordenCompra->__SET('estado', $r->estado);
					$ordenCompra->__SET('id_proveedor', $r->id_proveedor);
					$ordenCompra->__SET('id_meta', $r->id_meta);

					$result[] = $ordenCompra;
				}
				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
	}
?>