<?php
	class ProductoDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		//registrar ´producto
		public function Registrar_producto(Producto $producto)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_producto(?,?,?)");


			$tempCodigo 		= $producto->__GET('codigo');
			$tempDescripcion 	= $producto->__GET('descripcion');
			$tempUnidadM 		= $producto->__GET('id_unidadMedida');

			$statement->bindParam(1, $tempCodigo);
			$statement->bindParam(2, $tempDescripcion);
			$statement->bindParam(3, $tempUnidadM);

			$statement->execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


		// Listar productos
		public function listarProducto()
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_LISTAR_PRODUCTO()");
				$statement->execute();

				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$producto = new Producto();
					$producto->__SET('id_producto', $r->id_producto);
					$producto->__SET('codigo', $r->codigo);
					$producto->__SET('descripcion', $r->descripcion);
					$producto->__SET('fecha_registro', $r->fecha_registro);
					$producto->__SET('estado', $r->estado);
					$producto->__GET('id_unidadMedida')->__SET('descripcion', $r->unidad_medida);

					$result[] = $producto;
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