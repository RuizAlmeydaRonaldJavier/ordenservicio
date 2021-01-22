<?php
	class TipoFactura
	{
		private $id_tipoFactura;
		private $descripcion;
		private $porcentaje;
		private $fecha_registro;
		private $estado;

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