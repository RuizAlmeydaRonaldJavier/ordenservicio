<?php
	class ProveedorDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		//regsitrar proveedor

		public function Registrar_proveedor(Proveedor $proveedor)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_proveedor(?,?,?,?,?)");


			$tempRazonsocial 	= $proveedor->__GET('razon_social');
			$tempProveedor 		= $proveedor->__GET('ruc');
			$tempDireccion 		= $proveedor->__GET('dirección');
			$tempCorreo 		= $proveedor->__GET('correo_electronico');
			$tempTelefono 		= $proveedor->__GET('telefono');

			$statement->bindParam(1, $tempRazonsocial);
			$statement->bindParam(2, $tempProveedor);
			$statement->bindParam(3, $tempDireccion);
			$statement->bindParam(4, $tempCorreo);
			$statement->bindParam(5, $tempTelefono);
			$statement->execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
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

		public function Buscar_proveedor_ajax(Proveedor $proveedor){
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL up_buscar_ruc_ajax(?)");
			
			$tempRuc = $proveedor->__GET('ruc');

			$statement->bindParam(1,$tempRuc);

			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$ruc = new Proveedor();

				$ruc->__SET('id_proveedor',  $r->id_proveedor);
				$ruc->__SET('razon_social',  $r->razon_social);
				$ruc->__SET('ruc',           $r->ruc);
				$ruc->__SET('dirección',     $r->dirección);

				$result[] = $ruc;
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