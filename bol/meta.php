<?php
	class Meta
	{
		private $id_meta;
		private $c1;
		private $c2;
		private $c3;
		private $c4;
		private $c5;
		private $c6;
		private $c7;
		private $c8;
		private $c9;
		private $c10;
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