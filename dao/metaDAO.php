<?php
	class MetaDAO
	{
		private $pdo;

		public function __construct()
		{
			$dba = new DBAccess();
			$this->pdo = $dba->getConexion();
		}

		//regsitrar meta

		public function Registrar_meta(Meta $meta)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_meta (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$tempc1 		= $meta->__GET('c1');
			$tempc2 		= $meta->__GET('c2');
			$tempc3 		= $meta->__GET('c3');
			$tempc4			= $meta->__GET('c4');
			$tempc5 		= $meta->__GET('c5');
			$tempc6 		= $meta->__GET('c6');
			$tempc7 		= $meta->__GET('c7');
			$tempc8 		= $meta->__GET('c8');
			$tempc9 		= $meta->__GET('c9');
			$tempc10 		= $meta->__GET('c10');
			$tempdpto 		= $meta->__GET('dpto');
			$tempprov 		= $meta->__GET('prov');
			$tempdist 		= $meta->__GET('dist');
			$tempund_medida = $meta->__GET('und_medida');

			$statement->bindParam(1, $tempc1);
			$statement->bindParam(2, $tempc2);
			$statement->bindParam(3, $tempc3);
			$statement->bindParam(4, $tempc4);
			$statement->bindParam(5, $tempc5);
			$statement->bindParam(6, $tempc6);
			$statement->bindParam(7, $tempc7);
			$statement->bindParam(8, $tempc8);
			$statement->bindParam(9, $tempc9);
			$statement->bindParam(10, $tempc10);
			$statement->bindParam(11, $tempdpto);
			$statement->bindParam(12, $tempprov);
			$statement->bindParam(13, $tempdist);
			$statement->bindParam(14, $tempund_medida);

			$statement->execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
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

		public function Buscar_meta_ajax(Meta $meta){
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL up_buscar_meta_ajax(?)");
			
			$tempMeta = $meta->__GET('c1');

			$statement->bindParam(1, $tempMeta);

			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$meta = new Meta();

				$meta->__SET('id_meta',  $r->id_meta);
				$meta->__SET('c1',  $r->c1);
				$meta->__SET('c2',           $r->c2);
				$meta->__SET('c3',     $r->c3);
				$meta->__SET('c4',     $r->c4);
				$meta->__SET('c5',     $r->c5);
				$meta->__SET('c6',     $r->c6);
				$meta->__SET('c7',     $r->c7);
				$meta->__SET('c8',     $r->c8);
				$meta->__SET('c9',     $r->c9);
				$meta->__SET('c10',     $r->c10);
				$meta->__SET('fecha_registro',     $r->fecha_registro);
				$meta->__SET('estado',     $r->estado);

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