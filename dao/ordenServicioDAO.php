<?php
	class OrdenServicioDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		// Listar ordenes de servicios
		public function listarOrdenServicio()
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_LISTAR_ORDEN_SERVICIO()");
				$statement->execute();
				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$ordenServicio = new OrdenServicio();
					$ordenServicio->__SET('id_ordenServicio', $r->id_ordenServicio);
					$ordenServicio->__SET('numero_ordenServicio', $r->numero_ordenServicio);
					$ordenServicio->__SET('fecha', $r->fecha);
					$ordenServicio->__SET('requerimiento_referencia', $r->requerimiento_referencia);
					$ordenServicio->__SET('informe_referencia', $r->informe_referencia);
					$ordenServicio->__SET('descripcion', $r->descripcion);
					$ordenServicio->__SET('importe', $r->importe);
					$ordenServicio->__SET('sub_total', $r->sub_total);
					$ordenServicio->__SET('igv', $r->igv);
					$ordenServicio->__SET('importe_neto01', $r->importe_neto01);
					$ordenServicio->__SET('retencion', $r->retencion);
					$ordenServicio->__SET('importe_neto02', $r->importe_neto02);
					$ordenServicio->__SET('observacion', $r->observacion);
					$ordenServicio->__SET('fecha_registro', $r->fecha_registro);
					$ordenServicio->__SET('estado', $r->estado);
					$ordenServicio->__GET('id_proveedor')->__SET('razon_social', $r->razon_social);
					$ordenServicio->__SET('id_meta', $r->id_meta);
					$ordenServicio->__SET('id_tipoFactura', $r->id_tipoFactura);
					
					$result[] = $ordenServicio;
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