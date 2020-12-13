<?php
	class Producto
	{
		private $id_producto;
		private $codigo;
		private $descripcion;
		private $fecha_registro;
		private $estado;
		private $id_unidadMedida;

		public function __construct()
		{
			$this->id_unidadMedida = new UnidadMedida();
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