<?php
	class Usuario
	{
		private $id_usuario;
		private $ususario;
		private $contrasenia;
		private $fecha_registro;
		private $estado;
		private $id_perfil;

		public function __construct()
		{
		  //$this->id_perfil = new Perfil();
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