<?php
	class ProveedorDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		// Listar proveedores
		public function listarProveedor()
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_LISTAR_PROVEEDOR()");
				$statement->execute();

				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$proveedor = new Proveedor();
					$proveedor->__SET('id_proveedor', $r->id_proveedor);
					$proveedor->__SET('razon_social', $r->razon_social);
					$proveedor->__SET('ruc', $r->ruc);
					$proveedor->__SET('dirección', $r->dirección);
					$proveedor->__SET('correo_electronico', $r->correo_electronico);
					$proveedor->__SET('telefono', $r->telefono);
					$proveedor->__SET('fecha_registro', $r->fecha_registro);
					$proveedor->__SET('estado', $r->estado);

					$result[] = $proveedor;
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