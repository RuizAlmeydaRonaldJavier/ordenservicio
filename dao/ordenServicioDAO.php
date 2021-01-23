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
					$ordenServicio->__SET('estado', $r->estado_orden);
					$ordenServicio->__GET('id_proveedor')->__SET('razon_social', $r->razon_social);
					$ordenServicio->__GET('id_meta')->__SET('id_meta', $r->id_meta);
					$ordenServicio->__GET('id_tipoFactura')->__SET('id_tipoFactura', $r->id_tipoFactura);
					
					$result[] = $ordenServicio;
				}
				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		// Listar ordenes de servicios
		public function buscarOrdenServicio(OrdenServicio $ordenServicio)
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_BUSCAR_ORDEN_SERVICIO(?)");

				$tempId_ordenServicio = $ordenServicio->__GET('id_ordenServicio');

				$statement->bindParam(1, $tempId_ordenServicio);

				$statement->execute();
				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$ordenServicio = new OrdenServicio();
					$ordenServicio->__SET('id_ordenServicio', $r->id_ordenServicio);
					$ordenServicio->__SET('numero_ordenServicio', $r->numero_ordenServicio);
					$ordenServicio->__SET('fecha', $r->fecha);
					$ordenServicio->__SET('requerimiento_referencia', $r->requerimiento_referencia);
					$ordenServicio->__SET('informe_referencia', $r->informe_referencia);
					$ordenServicio->__SET('descripcion', $r->descripcion_servicio);
					$ordenServicio->__SET('importe', $r->importe);
					$ordenServicio->__SET('sub_total', $r->sub_total);
					$ordenServicio->__SET('igv', $r->igv);
					$ordenServicio->__SET('importe_neto01', $r->importe_neto01);
					$ordenServicio->__SET('retencion', $r->retencion);
					$ordenServicio->__SET('importe_neto02', $r->importe_neto02);
					$ordenServicio->__SET('observacion', $r->observacion);
					$ordenServicio->__SET('fecha_registro', $r->fecha_registro);
					$ordenServicio->__SET('estado', $r->estado);
					$ordenServicio->__GET('id_proveedor')->__SET('id_proveedor', $r->id_proveedor);
					$ordenServicio->__GET('id_proveedor')->__SET('razon_social', $r->razon_social);
					$ordenServicio->__GET('id_proveedor')->__SET('ruc', $r->ruc);
					$ordenServicio->__GET('id_proveedor')->__SET('direccion', $r->direccion);
					$ordenServicio->__GET('id_meta')->__SET('id_meta', $r->id_meta);
					$ordenServicio->__GET('id_meta')->__SET('c1', $r->c1);
					$ordenServicio->__GET('id_meta')->__SET('c2', $r->c2);
					$ordenServicio->__GET('id_meta')->__SET('c3', $r->c3);
					$ordenServicio->__GET('id_meta')->__SET('c10', $r->c10);
					$ordenServicio->__GET('id_tipoFactura')->__SET('id_tipoFactura', $r->id_tipoFactura);
					$ordenServicio->__GET('id_tipoFactura')->__SET('descripcion', $r->descripcion_factura);
					$ordenServicio->__GET('id_tipoFactura')->__SET('porcentaje', $r->porcentaje);
					
					$result[] = $ordenServicio;
				}
				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		// Registrar ordenes de servicios
		public function registrarOrdenServicio(OrdenServicio $ordenServicio)
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_REGISTRAR_ORDEN_SERVICIO(?,?,?,?,?,?,?,?,?,?,?,?,?)");

				$tempRequerimiento_referencia = 	$ordenServicio->__GET('requerimiento_referencia');
				$tempInforme_referencia = 			$ordenServicio->__GET('informe_referencia');
				$tempDescripcion = 					$ordenServicio->__GET('descripcion');
				$tempImporte = 						$ordenServicio->__GET('importe');
				$tempSub_total = 	$ordenServicio->__GET('sub_total');
				$tempIgv =		$ordenServicio->__GET('igv');
				$tempImporte_neto01 = 	$ordenServicio->__GET('importe_neto01');
				$tempRetencion = 	$ordenServicio->__GET('retencion');
				$tempImporte_neto02 =	$ordenServicio->__GET('importe_neto02');
				$tempObservacion =	$ordenServicio->__GET('observacion');
				$tempId_proveedor = 	$ordenServicio->__GET('id_proveedor')->__GET('id_proveedor');
				$tempId_meta =	$ordenServicio->__GET('id_meta')->__GET('id_meta');
				$tempId_tipoFactura = $ordenServicio->__GET('id_tipoFactura')->__GET('id_tipoFactura');
				$tempId_tipoFactura = substr($tempId_tipoFactura, 0, 1);

				$statement->bindParam(1, $tempRequerimiento_referencia);
				$statement->bindParam(2, $tempInforme_referencia);
				$statement->bindParam(3, $tempDescripcion);
				$statement->bindParam(4, $tempImporte);
				$statement->bindParam(5, $tempSub_total);
				$statement->bindParam(6, $tempIgv);
				$statement->bindParam(7, $tempImporte_neto01);
				$statement->bindParam(8, $tempRetencion);
				$statement->bindParam(9, $tempImporte_neto02);
				$statement->bindParam(10, $tempObservacion);
				$statement->bindParam(11, $tempId_proveedor);
				$statement->bindParam(12, $tempId_meta);
				$statement->bindParam(13, $tempId_tipoFactura);

				$statement->execute();
				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		// Registrar ordenes de servicios
		public function modificarOrdenServicio(OrdenServicio $ordenServicio)
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_MODIFICAR_ORDEN_SERVICIO(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

				$tempRequerimiento_referencia = 	$ordenServicio->__GET('requerimiento_referencia');
				$tempInforme_referencia = 			$ordenServicio->__GET('informe_referencia');
				$tempDescripcion = 					$ordenServicio->__GET('descripcion');
				$tempImporte = 						$ordenServicio->__GET('importe');
				$tempSub_total = 	$ordenServicio->__GET('sub_total');
				$tempIgv =		$ordenServicio->__GET('igv');
				$tempImporte_neto01 = 	$ordenServicio->__GET('importe_neto01');
				$tempRetencion = 	$ordenServicio->__GET('retencion');
				$tempImporte_neto02 =	$ordenServicio->__GET('importe_neto02');
				$tempObservacion =	$ordenServicio->__GET('observacion');
				$tempId_proveedor = 	$ordenServicio->__GET('id_proveedor')->__GET('id_proveedor');
				$tempId_meta =	$ordenServicio->__GET('id_meta')->__GET('id_meta');
				$tempId_tipoFactura = $ordenServicio->__GET('id_tipoFactura')->__GET('id_tipoFactura');
				$tempId_tipoFactura = substr($tempId_tipoFactura, 0, 1);
				$tempIdOrdenServicio =		$ordenServicio->__GET('id_ordenServicio');

				$statement->bindParam(1, $tempRequerimiento_referencia);
				$statement->bindParam(2, $tempInforme_referencia);
				$statement->bindParam(3, $tempDescripcion);
				$statement->bindParam(4, $tempImporte);
				$statement->bindParam(5, $tempSub_total);
				$statement->bindParam(6, $tempIgv);
				$statement->bindParam(7, $tempImporte_neto01);
				$statement->bindParam(8, $tempRetencion);
				$statement->bindParam(9, $tempImporte_neto02);
				$statement->bindParam(10, $tempObservacion);
				$statement->bindParam(11, $tempId_proveedor);
				$statement->bindParam(12, $tempId_meta);
				$statement->bindParam(13, $tempId_tipoFactura);
				$statement->bindParam(14, $tempIdOrdenServicio);

				$statement->execute();
				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
	}
?>