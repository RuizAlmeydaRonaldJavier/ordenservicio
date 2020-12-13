<?php
	class Proveedor
	{
		private $id_proveedor;
		private $razon_social;
		private $ruc;
		private $dirección;
		private $correo_electronico;
		private $telefono;
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