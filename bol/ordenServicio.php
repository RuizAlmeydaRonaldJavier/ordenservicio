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
		private $retencion;
		private $importe_neto;
		private $observacion;
		private $fecha_registro;
		private $estado;
		private $id_proveedor;
		private $id_meta;

		public function __construct()
		{
			$this->id_proveedor = new Proveedor();
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