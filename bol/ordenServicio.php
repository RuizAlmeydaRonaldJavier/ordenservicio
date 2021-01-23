<?php
	class OrdenServicio
	{
		private $id_ordenServicio;
		private $numero_ordenServicio;
		private $fecha;
		private $requerimiento_referencia;
		private $informe_referencia;
		private $descripcion;
		private $importe;
		private $sub_total;
		private $igv;
		private $importe_neto01;
		private $retencion;
		private $importe_neto02;
		private $observacion;
		private $fecha_registro;
		private $estado;
		private $id_proveedor;
		private $id_meta;
		private $id_tipoFactura;

		public function __construct()
		{
			$this->id_proveedor = new Proveedor();
			/*$this->id_meta = new Meta();
			$this->id_tipoFactura = new TipoFactura();*/
		}

		public function __GET($x)
		{
		  return $this->$x;
		}

		public function __SET($x, $y)
		{
		  return $this->$x = $y;
		}
	}
?>