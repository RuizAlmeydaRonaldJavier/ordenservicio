<?php
	class MetaDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		// Listar metas
		public function listarMeta()
		{
			try
			{
				$result = array();
				$statement = $this->pdo->prepare("CALL UP_LISTAR_META()");
				$statement->execute();

				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$meta = new Meta();
					$meta->__SET('id_meta', $r->id_meta);
					$meta->__SET('c1', $r->c1);
					$meta->__SET('c2', $r->c2);
					$meta->__SET('c3', $r->c3);
					$meta->__SET('c4', $r->c4);
					$meta->__SET('c5', $r->c5);
					$meta->__SET('c6', $r->c6);
					$meta->__SET('c7', $r->c7);
					$meta->__SET('c8', $r->c8);
					$meta->__SET('c9', $r->c9);
					$meta->__SET('c10', $r->c10);
					$meta->__SET('fecha_registro', $r->fecha_registro);
					$meta->__SET('estado', $r->estado);
					
					$result[] = $meta;
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