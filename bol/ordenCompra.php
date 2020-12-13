<?php
	class OrdenCompra
	{
		private $id_ordenCompra;
		private $numero_ordenCompra;
		private $fecha;
		private $requerimiento_referencia;
		private $informe_referencia;
		private $sub_total;
		private $igv;
		private $total;
		private $observacion;
		private $fecha_registro;
		private $estado;
		private $id_proveedor;
		private $id_meta;

		public function __construct()
		{
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